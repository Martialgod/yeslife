<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\Product;
use App\ProductMstrView;
use App\ProductPix;

use App\ProductPriceListMstrView;

use App\OrderMstrView;
use App\OrderDtlView;

use App\CertificationMstrView;
use App\CertificationDtl;

use App\Faq;

use App\User;

use Mail;

use App\Mail\SendSubsConfirmation;

use App\Mail\SendSubsActivated;

use Carbon\Carbon;

use App\GlobalMessage;

use App\MyHelperClass;

class LandingPageController extends Controller
{
    //
    
    public function setActiveTab(){
        session()->flash('active_tab', 'Home');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
       	$this->setActiveTab();

       	/*$products = ProductMstrView::where('stat', 1)
       				->inRandomOrder()
       				->paginate(4); */

       
        if(strpos(url()->current(), 'training.yes.life') !== false){


            //default
            $products = ProductMstrView::where('stat', 1)
                ->where('fk_productgroup', '<>', 1) //do not include business bulk orders
                ->orderBy('totalsalesqty', 'DESC')
                ->paginate(4);


        }elseif(strpos(url()->current(), 'yes.life') !== false){


            //applicable for live site only. display popular products on this order
            /*
                1) Broad 500 Mixed Berry = 19
                2) Full 500 Mixed Berry = 24
                3) Relieve Gel = 27
                4) Pawsterity 100 = 22

            */
            $products = ProductMstrView::where('stat', 1)
                ->whereIn('pk_products', [19,24,27,22]) 
                ->orderBy('indexno')
                ->paginate(4);


        }else{

            //default
            $products = ProductMstrView::where('stat', 1)
                ->where('fk_productgroup', '<>', 1) //do not include business bulk orders
                ->orderBy('totalsalesqty', 'DESC')
                ->paginate(4);

        }

       

        if( count($products) == 0 ){
            return view('landingpage.index', compact('products'));
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        //dd($products);

       	return view('landingpage.index', compact('products'));

    
    }//END index


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_success($trxno)
    {
        //

        $this->setActiveTab();

        $orders = OrderMstrView::where('trxno', $trxno)
                    ->where('stat', 1)
                    ->first();

        if( !$orders ){
            return redirect('/404');
        }

        $orderdtls = OrderDtlView::where('fk_ordermstr', $orders->pk_ordermstr)->get();

        return view('landingpage.success', compact('orders', 'orderdtls'));

    
    }//END index

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about_us()
    {
        //

        $this->setActiveTab();

        return view('landingpage.about-us');

    
    }//END about_us



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact_us()
    {
        //

        $this->setActiveTab();


        $subject = ( request()->subject ) ? request()->subject : 'Customer Inquiry';

        $contacttype = 'Default';
        $header = 'GET IN TOUCH';

        if($subject == 'Distributor Inquiry'){
            $contacttype = 'Distributor';
            $header = 'BECOME A DISTRIBUTOR';
        }


        return view('landingpage.contact-us', compact('contacttype', 'subject', 'header'));

    
    }//END contact_us


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms_conditions()
    {
        //

        $this->setActiveTab();

        $globalmessage = GlobalMessage::findOrFail(5000);

        return view('landingpage.terms-conditions', compact('globalmessage'));

    
    }//END terms_conditions


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy_policy()
    {
        //

        $this->setActiveTab();

        $globalmessage = GlobalMessage::findOrFail(4000);
   
        return view('landingpage.privacy-policy', compact('globalmessage'));

    
    }//END privacy_policy



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function certifications()
    {
        //

        $this->setActiveTab();

        $certifications = CertificationMstrView::where('stat', 1)->orderBy('productname', 'ASC')->get();

        $gallery = CertificationDtl::getCertificatesGallery($certifications->pluck('pk_certificatemstr'));

        $certifications = CertificationDtl::mapCertificateGallery($certifications, $gallery);

        $globalmessage = GlobalMessage::findOrFail(2000);

        return view('landingpage.certifications', compact('certifications', 'globalmessage'));

    
    }//END certifications
        


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function certifications_show($id, $lotcode=null)
    {
        //

        $this->setActiveTab();

        $certifications = CertificationMstrView::where('pk_certificatemstr', $id)
                            ->where('stat', 1)
                            ->first();

        if( !$certifications ){

            return redirect('/404');

        }

        if( !$lotcode ){

           $gallery = CertificationDtl::where('fk_certificatemstr', $id)->get();

        }else{

            $gallery = CertificationDtl::where('lotcode', $lotcode)->limit(1)->get();

        }

        if( count($gallery) == 0 ){

            return redirect('/404');

        }


        return view('landingpage.certifications-show', compact('certifications', 'gallery'));

    
    }//END certifications_show
    

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqs()
    {
        //

        $this->setActiveTab();

        $faqs = Faq::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $faqs->where(function ($query) use ($search) {
                $query->where('question', 'like', "%$search%");
            });

        }

        $faqs->where('stat', 1);

        $faqs = $faqs->orderBy('indexno', 'ASC')->get();

        $faqreferences = GlobalMessage::findOrFail(3000);

        return view('landingpage.faqs', compact('faqs', 'faqreferences', 'search'));

    
    }//END faq
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apistorecontactus(Request $request)
    {
        //

        //request sent via ajax using serializeArray()
        //need to convert array into valid laravel request object
        foreach($request->data as $v){
            $request[ $v['name'] ] = $v['value'];
        }


        $contactemails = explode(",",env('CONTACT_EMAILS'));

        $msg = "Name: $request->fullname \nEmail: $request->email \nPhone: $request->phone";

        if( $request->contacttype == 'Distributor' ){

            $msg = $msg . "\nEIN/SSN: $request->ein \nBusiness Name: $request->businessname";

        }

        $msg = $msg . "\nRequesting Url: $request->requesturl \n\n\nSubject: $request->subject \nMessage: $request->message";

        //using mail
        Mail::raw($msg, function ($message) use ($request, $contactemails) {
            //$message->to(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            $message->to($contactemails)
            ->subject('Customer Inquiry');
            $message->from($request->email, $request->fullname);
        });



        if( Mail::failures() ){
            return response()->json('error');
        }

        return response()->json('success');

    
    }//END apistorecontactus


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sample_subscription_template($id)
    {
        //

        $users = User::findOrFail($id);

        $user = $users;
        
        return view('landingpage.layouts.registration-coupon-template', compact('user'));


        return view('landingpage.layouts.subscription-email-template', compact('users'));
        

    }//END apistoresubscribe




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apistoresubscription(Request $request)
    {
        //

        //request sent via ajax using serializeArray()
        //need to convert array into valid laravel request object
        foreach($request->data as $v){
            $request[ $v['name'] ] = $v['value'];
        }

        $request['email'] = $request->subemail;

        if( User::where('email', $request->email)->first() ){
            return 'success';
        }


        //begin transaction
        $transaction = DB::transaction(function() use($request) {

            $request['fk_usertype'] = 1008; //Normal User. Default User Access
            $request['uname'] = $request->subemail;
            $request['password'] = 'test';
            $request['activation_token'] = str_random(60);
            $request['fk_country'] = 229; //USA
            $request['shippingcountry'] = 229; //USA default
            $request['state'] = 'Alabama'; //default state from db
            $request['city'] = 'Alabama';
            $request['address1'] = 'Alabama';
            $request['fk_referredby'] = $request->refno_subs;
            $request['stat'] = 0;

            $users =  User::create($request->all());

            $users->update([
                'affiliate_token'=> MyHelperClass::generateRandomString(10).''.$users->id
            ]);

            /*$data = array('users'=>$users);
            $mail = Mail::send('landingpage.layouts.subscription-email-template', $data, function($message) use ($users)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($users->email, $users->email)
                ->subject('Activate Subscription!');
            }); */

            //email to the customer
            $when = Carbon::now()->addMinutes(1);
            Mail::to($users->email, $users->email)->later($when, new SendSubsConfirmation($users));

            //Mail::to($users->email, $users->email)->send(new SendSubsConfirmation($users));
         
            return 'success';



        });//END $transaction


        return $transaction;
    
    }//END apistoresubscribe

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate_subscription($token)
    {
        //
        
        $user = User::where('activation_token', $token)->first();
        if (!$user) {

            return view('landingpage.layouts.subscription-invalid-template');

        }

        //begin transaction
        $transaction = DB::transaction(function() use($user) {


            $user->activation_token = '';
            $user->email_verified = Carbon::now();
            $user->password = bcrypt($user->affiliate_token);
            $user->stat = 1;
            $user->save();

            //return view('landingpage.layouts.subscription-coupon-template', compact('user'));

            /*$data = array('user'=>$user);
            $mail = Mail::send('landingpage.layouts.subscription-coupon-template', $data, function($message) use ($user)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($user->email, $user->email)
                ->subject('20% Subscription Discount!');
            }); */

            //email to the customer
            $when = Carbon::now()->addMinutes(1);
            Mail::to($user->email, $user->email)->later($when, new SendSubsActivated($user));


            //login automatically
            Auth::attempt([
                //'utype'=> 'Admin',
                'uname'  => $user->uname, 
                'password'  => $user->affiliate_token,
                'stat'      => 1
            ]);

            return view('landingpage.layouts.subscription-success-template');
            



        });//END $transaction


        return $transaction;

        

    }//END activate_subscription


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sample_subscription($token)
    {
        //

        $users = User::where('activation_token', $token)->first();

        if( !$users ){
            return view('landingpage.layouts.subscription-invalid-template');
        }

        //$user = $users;
        
        //return view('landingpage.layouts.subscription-coupon-template', compact('user'));

        return view('landingpage.layouts.subscription-email-template', compact('users'));
        
       

    }//END apistoresubscribe


    

}//END class
