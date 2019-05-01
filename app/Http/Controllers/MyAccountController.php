<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\AppStorage;

use Carbon\Carbon;

use App\OrderMstr;
use App\OrderMstrView;
use App\OrderDtlView;

use App\ProductReviewMstrView;

use App\OrderRecurring;
use App\OrderRecurringMstrView;

use App\OrderCouponMstrView;

use App\User;
use App\UserMstrView;
use App\UserDownlineView;

use App\UserReward;

use App\UserCCInfo;

use Hash;

use App\Country;
use App\State;


class MyAccountController extends Controller
{
    //

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session()->flash('myaccount_tab', 'Dashboard');

        return view('landingpage.myaccount.index');
   
    }//END index



    /**
     * Auth::id
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(){

        if( !Auth::check() ){
            return redirect('/404');
        }

        //only be accessible for logged in users
        $users = User::findOrFail(Auth::id())->update(['issubscribed'=> 0]);

        return view('landingpage.myaccount.unsubscribe-success');

    }//END unsubscribe


    /**
     * Auth::id
     *
     * @return \Illuminate\Http\Response
     */
    public function resubscribe(){

        if( !Auth::check() ){
            return redirect('/404');
        }

        //only be accessible for logged in users
        $users = User::findOrFail(Auth::id())->update(['issubscribed'=> 1]);

        return view('landingpage.myaccount.resubscribe-success');

    }//END unsubscribe

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        //

    	session()->flash('myaccount_tab', 'Orders');

        $orders = OrderMstrView::select();

        $orders->where('fk_users', Auth::id());

        $orders = $orders->orderBy('created_at', 'DESC')->paginate(10);

        return view('landingpage.myaccount.orders', compact('orders'));


    }//END orders


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editorders($trxno)
    {
        //
        
        //active tab
        $orders = OrderMstrView::where('trxno', $trxno)->where('fk_users', Auth::id())->first();

        if( !$orders ){
            return redirect('/404');
        }

        $orderdtls = OrderDtlView::where('fk_ordermstr', $orders->pk_ordermstr)->orderBy('indexno', 'ASC')->get();

        $coupons = OrderCouponMstrView::where('fk_ordermstr', $orders->pk_ordermstr)->get();

        session()->flash('myaccount_tab', 'Orders');

        return view('landingpage.myaccount.orders-edit', compact('orders', 'orderdtls', 'coupons'));


    }//END editrecurring


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateorders(Request $request, $trxno)
    {
        //
        
        //active tab
        $orders = OrderMstrView::where('trxno', $trxno)->where('fk_users', Auth::id())->first();

        if( !$orders ){
            return redirect('/404');
        }

    
        session()->flash('myaccount_tab', 'Orders');

        //begin transaction
        $transaction = DB::transaction(function() use($request, $orders) {

            //dd($request->all());

            OrderMstr::find($orders->pk_ordermstr)
                ->update([
                    'isdeclined'=> 1,
                    'declined_at'=> Carbon::now(),
                    'stat'=> 0
                ]);


            session()->flash('success', "your order has been declined!");
            return redirect()->back();


        });//END transaction

        return $transaction;



    }//END updateorders


    



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews()
    {
        //

        session()->flash('myaccount_tab', 'Reviews');

        $reviews = ProductReviewMstrView::select();

        $reviews->where('fk_users', Auth::id());

        $reviews = $reviews->orderBy('created_at', 'DESC')->paginate(10);

        return view('landingpage.myaccount.reviews', compact('reviews'));


    }//END reviews

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recurring()
    {
        //

        session()->flash('myaccount_tab', 'Recurring');

        $orders = OrderRecurringMstrView::select();

        $orders->where('fk_users', Auth::id());

        $orders = $orders->orderBy('created_at', 'DESC')->paginate(10);

        return view('landingpage.myaccount.recurring', compact('orders'));


    }//END orders


    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editrecurring($trxno)
    {
        //
        
        //active tab
        $orders = OrderRecurringMstrView::where('trxno', $trxno)->where('fk_users', Auth::id())->first();

        if( !$orders ){
            return redirect('/404');
        }

        session()->flash('myaccount_tab', 'Recurring');

        $orderdtls = OrderDtlView::where('fk_ordermstr', $orders->fk_ordermstr)->orderBy('indexno', 'ASC')->get();

        $history = OrderMstrView::where('fk_recurring', $orders->pk_orderrecurring)
                    ->orderBy('created_at', 'DESC')->paginate(10);

        return view('landingpage.myaccount.recurring-edit', compact('orders', 'orderdtls', 'history'));


    }//END editrecurring


    /**
     * Update a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updaterecurring(Request $request, $trxno)
    {
        //
        
        $orders = OrderRecurringMstrView::where('trxno', $trxno)->where('fk_users', Auth::id())->first();

        if( !$orders ){
            return redirect('/404');
        }

        session()->flash('myaccount_tab', 'Recurring');

        $request['fk_ordermstr'] = $orders->fk_ordermstr;
        $request['fk_users'] = $orders->fk_users;

        $validator = OrderRecurring::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $orders) {

                //dd($request->all());

                $request['fk_createdby'] = Auth::id();
         
                //update will return the newly created object
                OrderRecurring::find($orders->pk_orderrecurring)->update($request->all());

                session()->flash('success', "changes has been saved!");
                return redirect()->back();


            });//END transaction

            return $transaction;

          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }


    }//END editrecurring


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentmethod()
    {

        session()->flash('myaccount_tab', 'Payment');

        $usersccinfo = UserCCInfo::where('fk_users', Auth::id())->paginate(10);

        return view('landingpage.myaccount.payment', compact('usersccinfo'));
   
    }//END paymentmethod


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editpaymentmethod($id)
    {
        //
        
        //active tab
        $usersccinfo = UserCCInfo::where('fk_users', Auth::id())
                        ->where('pk_usersccinfo', $id)
                        ->first();

        if( !$usersccinfo ){
            return redirect('/404');
        }

        session()->flash('myaccount_tab', 'Payment');

        return view('landingpage.myaccount.payment-edit', compact('usersccinfo'));


    }//END editpaymentmethod


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatepaymentmethod(Request $request, $id)
    {
        //
        //dd($request->all());
        //active tab
        $usersccinfo = UserCCInfo::where('fk_users', Auth::id())
                        ->where('pk_usersccinfo', $id)
                        ->first();

        if( !$usersccinfo ){
            return redirect('/404');
        }

        session()->flash('myaccount_tab', 'Payment');


        //begin transaction
        $transaction = DB::transaction(function() use($request, $usersccinfo, $id) {

            //dd($request->all());
            //set as default payment
            if( $request->isdefault == '1' ){

                //set all isdefault = 0 except for the current record
                UserCCInfo::where('fk_users', $usersccinfo->fk_users)
                            ->where('pk_usersccinfo', '<>', $id)
                            ->update(['isdefault'=> 0]);

                //current record is the only default method
                $usersccinfo->update([
                    'isdefault'=> 1,
                    'stat'=> $request->stat
                ]);

            }else{

                //only update the status
                $usersccinfo->update([
                    'isdefault'=> 0,
                    'stat'=> $request->stat
                ]);

            }//END $request->isdefault == 1

            session()->flash('success', "your payment method has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;


    }//END updatepaymentmethod




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function address()
    {

        session()->flash('myaccount_tab', 'Address');

        $users = User::findOrFail(Auth::id());
        $country = Country::getActiveCountry();
        $states = State::getStateByCountry($users->fk_country);
        $iscustomstate = State::isCustomState($users->state);

        return view('landingpage.myaccount.address', compact('users', 'country', 'states', 'iscustomstate'));
   
    }//END paymentmethod


    /**
     * Update the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateaddress(Request $request)
    {
        //
        //dd($request->all());

        session()->flash('myaccount_tab', 'Address');

        $users = User::findOrFail(Auth::id());

        //setup required fields in User Validation
        $request['fk_usertype'] = $users->fk_usertype; //avoid validation error
        $request['uname'] = $users->uname;
        $request['fname'] = $users->fname;
        $request['lname'] = $users->lname;
        $request['email'] = $users->email;
        $request['fk_country'] = $request->billingcountry;
        $request['city'] = $request->billingcity;
        $request['zip'] = $request->billingzip;
        $request['address1'] = $request->billingaddress1;
        $request['address2'] = $request->billingaddress2;

        $request = State::formatState($request);
        $request['statesdropdown'] = $request->billingstatesdropdown; //required in User Validation
        $request['cantfindstate'] = $request->billingcantfindstate; //required in User Validation
        $request['statescustom'] = $request->billingstatescustom; //required in User Validation

        //dd($request->all());

        $validator = User::custom_validation($request, 'profile');

       
        //check if $validator is true && record is found
        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $users) {

                //dd($request->all());

                $request['fk_updated'] = Auth::id();
   
                $users->update($request->all()); 


                //update billing and shipping address for all orders with status of 'For Approval' and 'Pending'
                $orders = OrderMstr::where('fk_users', Auth::id())
                            ->where('isapproved', 0)
                            ->where('stat', 1)
                            ->update([
                                'billingfname'=> $users->fname,
                                'billinglname'=> $users->lname,
                                'billingphone'=> $users->phone,
                                'billingaddress1'=> $users->address1,
                                'billingaddress2'=> $users->address2,
                                'billingcity'=> $users->city,
                                'billingstate'=> $users->state,
                                'billingzip'=> $users->zip,
                                'billingcountry'=> $users->fk_country,
                                'shippingfname'=> $users->shippingfname,
                                'shippinglname'=> $users->shippinglname,
                                'shippingphone'=> $users->shippingphone,
                                'shippingaddress1'=> $users->shippingaddress1,
                                'shippingaddress2'=> $users->shippingaddress2,
                                'shippingcity'=> $users->shippingcity,
                                'shippingstate'=> $users->shippingstate,
                                'shippingzip'=> $users->shippingzip,
                                'shippingcountry'=> $users->shippingcountry,

                            ]);
                //dd($orders);

                session()->flash('success', "your address has been updated!");
                return redirect()->back();


            });//END transaction

            return $transaction;


        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);

        }

        //dd($request->all());


    }//END updateaddress


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {

        session()->flash('myaccount_tab', 'Details');

        $users = User::findOrFail(Auth::id());
        $socialpw = null; //default social password login...

        //check for default password for social login
        if (Hash::check($users->affiliate_token, $users->password))
        {
            $socialpw = $users->affiliate_token;
        }


        return view('landingpage.myaccount.account-details', compact('users', 'socialpw'));
   
    }//END details



    /**
     * Update the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatedetails(Request $request)
    {
        //
        //dd($request->all());

        session()->flash('myaccount_tab', 'Details');

        $users = User::findOrFail(Auth::id());

        //check for current password
        if (!Hash::check($request->currentpw, $users->password))
        {
            session()->flash('error', "invalid current password");
            return redirect()->back()->withInput();
        }

        //setup required fields in User Validation
        $request['fk_usertype'] = $users->fk_usertype; //avoid validation error
        $request['email'] = $users->email;
        $request['fk_country'] = $users->fk_country;
        $request['city'] = $users->city;
        $request['statesdropdown'] = $users->state; //required in User Validation
        //dd($request->all());

        $validator = User::custom_validation($request, 'profile');

    
        //check if $validator is true && record is found
        if( $validator === true ){

            //dd($request->all());

            //begin transaction
            $transaction = DB::transaction(function() use($request, $users) {

                //to be remove from storage
                $oldfilename = $users->pictx; 
        
                $newpword = $request->password; //temporary storage for empty password checking
                $oldpword = $users->password; //retrieve old password for security
                
                $request['fullname'] = $request->fname.' '.$request->lname;
                $request['fk_updated'] = Auth::id();
                $request['password'] = bcrypt($request->password); //might contain empty password

                $users->update($request->all()); //mass update. empty password will still be updated

                //check if user removed the logo
                if( $request->removepictx && $request->removepictx == 'on' ){
                                       
                    AppStorage::remove($oldfilename);

                    //update DB for correct filename @pictx
                    $users->update([
                        'pictx'=> null
                    ]);

                }//END check if user removed the logo

                //if request uploaded logo
                if( $request->pictx ){

                    AppStorage::remove($oldfilename);
                    
                    //update DB for correct filename @pictx
                    $users->update([
                        'pictx'=> AppStorage::store('avatar', $request->pictx)
                    ]);

                }//END check if request uploaded logo

                //check if new password is empty. rollback password
                if( !$newpword  ){
                    $users->update(['password'=> $oldpword ]);
                }

                session()->flash('success', "your account has been updated!");
                return redirect()->back();



            });//END transaction

            return $transaction;


        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);

        }

        //dd($request->all());


    }//END updatedetails


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function affiliate()
    {
        //
        //
        $id = Auth::id();

        session()->flash('myaccount_tab', 'Affiliate');

        $downline = UserDownlineView::select();

        $downline = $downline->where('fk_referredby', $id)->paginate(10);

        $totalpoints = UserReward::countTotalRewardPointsPerUser($id);
        
        //dd($totalpoints);
        //$downline = [];
        return view('landingpage.myaccount.affiliate', compact('downline', 'totalpoints'));


    }//END affiliate




}//END class
