<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\MyHelperClass;

use Carbon\Carbon;

use App\User;

use App\Country;

use App\PasswordReset;

use Mail;

class RegisterController extends Controller
{
    //
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        if(Auth::check()){
            return redirect('/');
        }

        return view('landingpage.login-register');


    }//END create


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        //

        if( $request->logtype == 'register' ){

            $request['fk_usertype'] = 1008; //Normal User. Default User Access
            $request['activation_token'] = null; //email is now automatically activated
            $request['fk_country'] = 229; //USA default
            $request['shippingcountry'] = 229; //USA default
            $request['statesdropdown'] = 'Alabama'; //default state from db; converted to $request['states'] in User::custom_validation
            $request['city'] = 'Alabama';
            $request['fk_referredby'] = session('yeslife_referrer_id'); //initialize @App/Providers/AppServiceProvider.php

            //check for existing email. need to know if email is just a subscriber
            //if just a subscriber update the user
            $users = User::where('email', $request->email)
                    ->where('fname', null)
                    ->where('lname', null)
                    ->first();

            //update email subscriber
            if( $users ){

                //subscribing user needs to register
                return $this->registerSubscriber($request, $users); //@the bottom

            }//END $users



            //check for existing email with in-active status
            //applicable to the users who ordered something but did not agree to create an account
            $users = User::where('email', $request->email)
                    ->where('stat', 0)
                    ->first();

            //update existing user with in-active status
            if( $users ){

                //existing user with in-active status
                return $this->registerSubscriber($request, $users); //@the bottom

            }//END $users


            //new user
            return $this->registerNewUser($request); //@the bottom

        }//END if request->logtype == 'register'

        else{

            //login
            
            if( Auth::attempt([
                //'utype'=> 'Admin',
                'uname'  => $request->uname, 
                'password'  => $request->password,
                'stat'      => 1
            ])){

                //intended to return last visited site before the session expired
                return redirect()->intended('/');

            }

            
            return view('landingpage.login-register', ['is_login' => 'error', 'uname'  => $request->uname]);

        }//END  else $request->logtype == 'register'

    	


    }//END store


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        Auth::logout();

        session()->flush();

        return redirect('/');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpassword()
    {
        //
        return view('landingpage.password-reset.forgotpassword');

    }//END create


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendemailreset(Request $request)
    {
        //only active account is allowed to reset the password
        //possible in-active accounts, unverified subscription, checkout without creating an account
        $users = User::where('email', $request->email)
                ->where('stat', 1)
                ->first();

        //dd($users);

        if( $users ){

            $token = str_random(60).$users->id;
            $passwordreset = PasswordReset::create([
                'email'=> $users->email,
                'token'=> $token,
                'created_at'=> Carbon::now()
            ]);

            $data = array('passwordreset'=>$passwordreset);

            $mail = Mail::send('landingpage.password-reset.reset-email-template', $data, function($message) use ($passwordreset)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($passwordreset->email, $passwordreset->email)
                ->subject('Password Reset!');
            });

  
        }

        else{


            session()->flash('error', "Opps! Email not found...");
            return redirect()->back();

        }

        return view('landingpage.password-reset.emailsent');

    }//END sendemailreset
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resetpassword($token)
    {
        //
   
        $passwordreset = PasswordReset::where('token', $token)->first();

        if( !$passwordreset ){
            return view('landingpage.password-reset.invalid-token');
        }


        return view('landingpage.password-reset.resetform', compact('passwordreset'));

    }//END resetpassword
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(Request $request, $token)
    {
        //
        
        //begin transaction
        $transaction = DB::transaction(function() use($request, $token) {

            $passwordreset = PasswordReset::where('token', $token)->first();

            if( !$passwordreset ){
                return view('landingpage.password-reset.invalid-token');
            }
       
            $users = User::where('email', $passwordreset->email)->first();

            if( !$users ){
                return view('landingpage.password-reset.invalid-token');
            }

            if( $request->password != $request->password_confirmation ){
                return redirect()->back()->withErrors(['password did not match']);

            }

            PasswordReset::where('email', $passwordreset->email)->update(['token'=> '']);

            $users->update([
                'password'=> bcrypt($request->password),
                'stat'=> 1
            ]);

            if( Auth::attempt([
                'uname'  => $users->uname, 
                'password'  => $request->password,
                'stat'      => 1
            ])){

                //return to homepage
                return redirect('/');

            }

            return view('landingpage.password-reset.invalid-token');


        });//END transaction

        return $transaction;

      
    }//END updatepassword


    //need to call User::validation since no email is found
    public function registerNewUser($request){
        
        //dd($request->all());

        //new user
        $validator = User::custom_validation($request, 'store');
        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                //check for referrals
                /*if($request->refno){

                    $refno = User::where('affiliate_token', $request->refno)->pluck('id')->first();
                    $request['fk_referredby'] = $refno;

                }*/

                $request['password'] = bcrypt($request->password);
                $request['fullname'] = $request->fname.' '.$request->lname;
                $request['stat'] = 1;  //default stat
                
                //dd($request->all());

                $users = User::create($request->all()); //insert all $request

                $users->update([
                    'affiliate_token'=> MyHelperClass::generateRandomString(10).''.$users->id
                ]);
                
                session()->flash('success', "Registration completed!");
                return redirect()->back();



            });//END transaction

            return $transaction;


        }
        else{

            //return redirect()->route('users.create')->withInput()->withErrors($validator);
            return redirect()->back()->withInput()->withErrors($validator);

        }//END $validator === true


    }//END registerNewUser
        


    //don't need to call User::validator
    //also email should not be updated here.
    //needs manual validation since email already exist due to user subscription before
    public function registerSubscriber($request, $users){

        //subscriber register

        //begin transaction
        $transaction = DB::transaction(function() use($request, $users) {

            //check for referrals
            /*if($request->refno){

                $refno = User::where('affiliate_token', $request->refno)->pluck('id')->first();
                $request['fk_referredby'] = $refno;

            }*/

            if( User::where('uname', $request->uname)->first() ){
                return redirect()->back()->withInput()->withErrors(['Username already exists']);

            }
           
            if( $request->password != $request->password_confirmation ){
                return redirect()->back()->withInput()->withErrors(['password did not match']);

            }

            $request['password'] = bcrypt($request->password);
            $request['fullname'] = $request->fname.' '.$request->lname;
            $request['stat'] = 1;  //default stat

            $users->update([
                'uname'=> $request->uname,
                'password'=> $request->password,
                'fname'=> $request->fname,
                'lname'=> $request->lname,
                'fullname'=> $request->fullname,
                //'fk_referredby'=> $request->fk_referredby,
                'stat'=> 1

            ]);

            //check if user is not currently referred by someone to avoid referral overwriting
            //if not then update new referral if applicable
            if( !$users->fk_referredby ){
                $users->update([
                    'fk_referredby'=> $request->fk_referredby,
                ]);
            }


            session()->flash('success', "Registration completed!");
            return redirect()->back();



        });//END transaction

        return $transaction;




    }//END registerSubscriber
    


}//END class
