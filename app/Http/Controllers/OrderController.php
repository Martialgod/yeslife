<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use App\Product;
use App\ProductComposition;
use App\Country;

use App\OrderMstr;
use App\OrderDtl;
use App\OrderComposition;

use App\OrderRecurring;

use App\OrderCoupon;

use App\OrderCouponMstrView;

use App\OrderMstrView;
use App\OrderDtlView;

use App\User;

use App\UserReward;

use App\RewardAction;

use App\UserCCInfo;

use App\UserRallypay;

use App\State;

use App\UserCart;

use App\RecordStatus;

use Carbon\Carbon;

use App\OrderBroadcast;

use App\MyHelperClass;

use Mail;

use App\Mail\BroadCastNewOrders;

use App\Mail\SendOrderConfirmation;

use App\Mail\BroadCastPurchaseReward;

use Illuminate\Support\Facades\Crypt;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;


class OrderController extends Controller
{
    
    public $menu_group = 'orders.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['create', 'store']);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Orders');
        session()->flash('child_tab', $this->menu_group);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(2001)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $orders = OrderMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        $datefrom = ( request()->datefrom ) ? request()->datefrom : date('Y-m-d');

        $dateto = ( request()->dateto ) ? request()->dateto : date('Y-m-d');

        $paymentstatus = ( request()->paymentstatus ) ? request()->paymentstatus : 'Authorized';

        $type = ( request()->type ) ? request()->type : null;

        if( $search ){

            $orders->where(function ($query) use ($search) {
                $query->where('billingfname', 'like', "%$search%")
                ->orWhere('billinglname', 'like', "%$search%")
                ->orWhere('trxno', 'like', "%$search%");
            });

        }


        if( $paymentstatus != 'All' ){
            $orders->where('paymentstatus', '=', $paymentstatus);
        }
    

        //new orders for today
        if( $type && $type == 'new' ){
            $d1 = date('Y-m-d');
            $d2 = date('Y-m-d');
            $orders->whereBetween('created_at', ["$d1 00:00:00", "$d2 23:59:59"] );
        }


        $orders->whereBetween('created_at', ["$datefrom 00:00:00", "$dateto 23:59:59"] );


        $orders = $orders->orderBy('created_at', 'DESC')->paginate(10);

        //dd($orders);

        $mscpaymentstatus = RecordStatus::getRecordStatusByType('Payment');

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        
        return view('admin.orders.index', compact('sub_menu', 'orders', 'paymentstatus', 'mscpaymentstatus', 'search', 'datefrom', 'dateto'));


    }//END index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return redirect('/admin/orders');
    
    }//END create


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    
        if( count($request->cart) == 0 ){
            return response()->json('cart not found');
        }

        //request sent via ajax using serializeArray()
        //need to convert array into valid laravel request object
        foreach($request->address as $v){
            $request[ $v['name'] ] = $v['value'];
        }

        //return env('MAIL_USERNAME');

        //return $request->all();
         
        //return $request->paymentapi['user']['id'];

        //begin transaction
        $transaction = DB::transaction(function() use($request) {

      
            /*
                format state
                we have two kind of states, statesdropdown and statescustom
                1. statesdropdown are stored in the db 
                2. statescustom are manual encode if ever the user state can't be found in the db
            */
            $request = State::formatState($request);

            //return $request;
       
            //shipping and billing address the same
            if( !$request->shiptodifferentaddress  ){

                $request['shippingfname'] = $request->billingfname;
                $request['shippinglname'] = $request->billinglname;
                $request['shippingphone'] = $request->billingphone;
                $request['shippingaddress1'] = $request->billingaddress1;
                $request['shippingaddress2'] = $request->billingaddress2;
                $request['shippingcity'] = $request->billingcity;
                $request['shippingstate'] = $request->billingstate;
                $request['shippingzip'] = $request->billingzip;
                $request['shippingcountry'] = $request->billingcountry;

            }
            
            //return $request->all();
            //
            
            //test for new account
            //$request['billingemail'] = 'test@gmail.com';
            //$request['isnewaccount'] = 'on';
            
            //check if user already exists
            $users = User::where('email', $request->billingemail)->first();

            //if not exists create new one
            if( !$users ){

                //create new one

                $request['fk_usertype'] = '1008'; //Default Normal User,
                $request['uname'] = $request->billingemail; //Default 
                $request['password'] ='test'; //Default
                $request['password_confirmation'] = 'test'; //Default
                $request['fname'] = $request->billingfname;
                $request['lname'] = $request->billinglname;
                $request['fullname'] = $request->billingfname.' '.$request->billinglname;
                $request['email'] = $request->billingemail;
                $request['phone'] = $request->billingphone;
                $request['address1'] = $request->billingaddress1;
                $request['address2'] = $request->billingaddress2;
                $request['city'] = $request->billingcity;
                $request['statesdropdown'] = $request->billingstate;
                $request['state'] = $request->billingstate;
                $request['zip'] = $request->billingzip;
                $request['fk_country'] = $request->billingcountry;
                $request['stat'] = 0;

                //check referral token
                $request['fk_referredby'] = null;
                if( isset($request->referrer_token) &&  $request->referrer_token != null || $request->referrer_token != '' ){

                    $refno = User::where('affiliate_token', $request->referrer_token)->pluck('id')->first();
                    $request['fk_referredby'] = $refno;

                }//END $request->referrer_token
                

                $validator = User::custom_validation($request, 'store');

                if( $validator === true ){

                    $users = User::create($request->all());

                    $users->update([
                        'affiliate_token'=> MyHelperClass::generateRandomString(10).''.$users->id
                    ]);


                }else{

                    return response()->json($validator->errors(), 422);

                }//END $validator === true

            }else{

                //existing user 
                

            }//!$users 

            //return $request->all();
            

            //insert usersccinfo. all details here are correct since order will only be stored to db if and only if the rallypay api succesfully validated the card info
            /*$usersccinfo = UserCCInfo::where('fk_users', $users->id)
                        ->where('cardno',  $request->paymentapi['cardno'])
                        ->first();
            if( !$usersccinfo ){

                $usersccinfo = UserCCInfo::create([
                    'fk_users'=>  $users->id,
                    'cardno'=>  $request->paymentapi['cardno'],
                    'cvc'=>  $request->paymentapi['cvc'],
                    'exmonth'=>  $request->paymentapi['exmonth'],
                    'exyear'=>  $request->paymentapi['exyear'],
                    'isdefault'=> 0,
                    'stat'=> 1
                ]);

            }else{

                //update details
                $usersccinfo->update([
                    'cvc'=> $request->paymentapi['cvc'],
                    'exmonth'=>  $request->paymentapi['exmonth'],
                    'exyear'=>  $request->paymentapi['exyear'],
                ]);

            }//END !$usersccinfo
            */
           

            /*
                amount: 100,
                currency: 'usd',
                email: 'test@gmail.com',
                id: '3213sdf',
                payment_token: '5dfgfd',
                transaction_number: '12312312dfsd',
                user: {
                    email: 'test@gmail.com',
                    id: '1ftrt2'
                }

            */


            //customer agreed to create new account; update user details
            //this will only be applicable for the non logged in users
            //and also applicable for subscribed users only. no actual user info so we need to update the following.... 
            if( ( $request->isnewaccount && $request->isnewaccount == 'on' )  || ( $users->lname == null || $users->lname == '' )  ){

                $users->update([
                    'password'=> bcrypt($request->billingpassword),
                    'fname'=> $request->billingfname,
                    'lname'=> $request->billinglname,
                    'fullname'=> $request->billingfname.' '.$request->billinglname,
                    'phone'=> $request->billingphone,
                    'activation_token' => null,
                    'address1'=> $request->billingaddress1,
                    'address2'=> $request->billingaddress2,
                    'city'=> $request->billingcity,
                    'state'=> $request->billingstate,
                    'zip'=> $request->billingzip,
                    'fk_country'=> $request->billingcountry,
                    'shippingfname'=>$request->shippingfname,
                    'shippinglname'=> $request->shippinglname,
                    'shippingphone'=> $request->shippingphone,
                    'shippingaddress1'=> $request->shippingaddress1,
                    'shippingaddress2'=> $request->shippingaddress2,
                    'shippingcity'=> $request->shippingcity,
                    'shippingstate'=> $request->shippingstate,
                    'shippingzip'=> $request->shippingzip,
                    'shippingcountry'=> $request->shippingcountry,
                    'stat'=> 1
                ]);

            }//END if isnewaccount

            //set required fields for the orders
            //fields like billing and shipping details are already initialized in the top of this function
            $request['fk_users'] = $users->id;
            //$request['fk_usersccinfo'] = $usersccinfo->pk_usersccinfo;
            $request['rallypayid'] = null;
            $request['totalitem'] = count($request->cart);
            $request['totalamount'] = $request->total['totalamount'];
            $request['totalcoupon'] = $request->total['totalcoupondiscount'];
            $request['totaltax'] = $request->total['totaltax'];
            $request['totalshipcost'] = $request->total['totalshipcost'];
            $request['netamount'] = $request->total['totalnetamount'];
            $request['stat'] = 1;
          
            $validator = OrderMstr::custom_validation($request, 'store');

            if( $validator === true ){

                //check if recurring checkout transaction (approve recurring) or new transaction
                $recurringtrxno = ( $request->recurringtrxno ) ? $request->recurringtrxno : null;

                $isUnApproveRecurring = OrderMstr::isUnApproveRecurring($recurringtrxno, $users->id);

                if( $recurringtrxno && $isUnApproveRecurring ){
                    
                    //return 'recurring';
                   
                    //update ordermstr
                    $request['isapproved'] = 1;
                    $ordermstr = OrderMstr::find($isUnApproveRecurring->pk_ordermstr)->update($request->all());

                    //remove orderdtls
                    OrderDtl::where('fk_ordermstr', $isUnApproveRecurring->pk_ordermstr)->delete();

                    $ordermstr =  OrderMstr::find($isUnApproveRecurring->pk_ordermstr);
                   
                }else{

                    //return $request->all();

                    //create will return the newly created object
                    $ordermstr = OrderMstr::create($request->all()); //insert all $request

                    //update trxno
                    $ordermstr->update([
                        'trxno'=> MyHelperClass::generateRandomString(10).''.$ordermstr->pk_ordermstr
                    ]);

                }//END $recurringtrxno

                //return $request->all();

            }else{

                return response()->json($validator->errors(), 422);

            }//END $validator === true

            $indexno = 0;

            foreach( $request->cart as $key => $v ){

                OrderDtl::create([
                    'fk_ordermstr'=> $ordermstr->pk_ordermstr,
                    'fk_products'=> $v['productid'],
                    'qty'=> $v['selectedqty'],
                    'uom'=> $v['uom'],
                    'origprice'=> $v['cartprice'],
                    'unitprice'=> $v['cartdiscountedprice'],
                    'totalamount'=> $v['totalamount'],
                    'coupondisc'=> $v['coupondiscount'],
                    'taxamount'=>  $v['taxamount'],
                    'shipamount'=>  $v['shipamount'],
                    'netamount'=> $v['netamount'],
                    'fk_recordstatus'=> 1011, //In Progress
                    'indexno'=> $indexno++
                ]);



                //remove old ordercomposition
                OrderComposition::where('fk_products',  $v['productid'])->where('fk_ordermstr', $ordermstr->pk_ordermstr)->delete();

                //store and update ordercomposition
                $compositions = ProductComposition::getItemCompositions($v['productid']);

                foreach($compositions as $ckey => $cv){

                    OrderComposition::create([

                        'fk_ordermstr'=> $ordermstr->pk_ordermstr,
                        'fk_products'=> $v['productid'],
                        'fk_compositions'=> $cv->fk_compositions,
                        'qty'=>  floatval($v['selectedqty']) * floatval($cv->qty),
                        'uom'=> $cv->uom,
                        //'unitcost'=> $cv->cost

                    ]);

                }//END foreach $compositions


            }//END foreach


            //insert userrallypay. store all rallypay response data to separate database for audit purpose
            $rallypay = $request->paymentapi;
            $rallyuid  = isset( $rallypay['user']['id'] ) ?  $rallypay['user']['id'] : '';
            $rallyemail  = isset( $rallypay['user']['email'] ) ?  $rallypay['user']['email'] : '';
            $rallytrxamount  = isset( $rallypay['amount'] ) ?  $rallypay['amount'] : 0;
            $rallytrxcurrency  = isset( $rallypay['currency'] ) ?  $rallypay['currency'] : '';
            $rallytrxemail  = isset( $rallypay['email'] ) ?  $rallypay['email'] : '';
            $rallytrxid  = isset( $rallypay['id'] ) ?  $rallypay['id'] : '';
            $rallytrxpaytoken  = isset( $rallypay['payment_token'] ) ?  $rallypay['payment_token'] : '';
            $rallytrxnumber  = isset( $rallypay['transaction_number'] ) ?  $rallypay['transaction_number'] : '';

            $usersrallypay = UserRallypay::create([
                'fk_users'=> $users->id,
                'rallyuid'=> $rallyuid,
                'rallyemail'=> $rallyemail,
                'rallytrxamount'=> $rallytrxamount,
                'rallytrxcurrency'=> $rallytrxcurrency,
                'rallytrxemail'=> $rallytrxemail,
                'rallytrxid'=> $rallytrxid,
                'rallytrxpaytoken'=> $rallytrxpaytoken,
                'rallytrxnumber'=> $rallytrxnumber

            ]);

            //update ordermstr rallypayid reference
            $ordermstr->update(['rallypayid'=> $usersrallypay->rallypayid]);

            //record coupons if applicable
            foreach( $request->coupons as $key => $v ){

                $coupons = OrderCoupon::create([
                    'fk_ordermstr'=> $ordermstr->pk_ordermstr,
                    'fk_users'=> $users->id,
                    'fk_coupons'=> $v['pk_coupons'],
                    'type'=> $v['type'],
                    'amount'=> $v['amount']
                ]);

            }//END foreach

            //record recurring if applicable
            if( $request->isrecurring && $request->isrecurring == 'on' ){
        
               $startdate =  date('Y-m-d',  strtotime($ordermstr->created_at. '+'.$request->intervalno.' '.$request->intervalunit) );

               OrderRecurring::create([
                    'fk_users'=> $users->id,
                    'fk_ordermstr'=> $ordermstr->pk_ordermstr,
                    'startdate'=> $startdate,
                    'enddate'=> $request->enddate,
                    'intervalno'=> $request->intervalno,
                    'intervalunit'=> $request->intervalunit,
                    'fk_createdby'=> $users->id,
                    'stat'=> 1
               ]);
               

            }//END isset($address['isrecurring'])

            //insert reward points
            //UserReward::insertSinglePurchaseRewards($ordermstr);
            
            //remove cart from db
            UserCart::where('fk_users', $users->id)->delete();

            //email notification
            $ordermstr = OrderMstrView::findOrFail($ordermstr->pk_ordermstr);
            $orderdtls = OrderDtlView::where('fk_ordermstr', $ordermstr->pk_ordermstr)->orderBy('indexno', 'ASC')->get();

            
            //email to the customer
            $when = Carbon::now()->addMinutes(1);
            Mail::to($users['email'], $users['fullname'])->later($when, new SendOrderConfirmation($ordermstr, $orderdtls, $users));


            //cc to admin emails for notification
            $orderemails = explode(",",env('ORDER_EMAILS'));
            $when = Carbon::now()->addMinutes(2);
            Mail::to(env('MAIL_USERNAME'))
                ->cc($orderemails)
                ->later($when, new SendOrderConfirmation($ordermstr, $orderdtls, $users));

            

            /*$totalpoints = UserReward::countTotalRewardPointsPerUser($users['id']);
            $actions = RewardAction::find(1004);
            $when = Carbon::now()->addMinutes(3);
            Mail::to($users['email'], $users['fullname'])->later($when, new BroadCastPurchaseReward($users, $ordermstr, $totalpoints, $actions)); */

         
            //Mail::to($users['email'], $users['fullname'])->queue(new SendOrderConfirmation($ordermstr, $orderdtls, $users));
            

            /*$data = array('users'=>$users, 'ordermstr'=>$ordermstr, 'orderdtls'=>$orderdtls);

            $mail = Mail::send('landingpage.success-email-template', $data, function($message) use ($users)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($users['email'], $users['fullname'])
                ->subject('Thank you for your purchase!');
            });*/


            return response()->json(['status'=>'success', 'trxno'=>$ordermstr->trxno]);


        });//END transaction

        return $transaction;

       
    }//END store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/admin/orders');

        /*$ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $ordermstr->pk_ordermstr)
                    ->orderBy('indexno', 'ASC')
                    ->get();
        //update isopen
        OrderMstr::find($id)->update(['isopen'=>1]);
        return view('admin.orders.show', compact('ordermstr', 'orderdtls'));*/

    }//END show



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(2002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();

        $coupons = OrderCouponMstrView::where('fk_ordermstr', $ordermstr->pk_ordermstr)->get();

        $mscorderstatus = RecordStatus::getRecordStatusByType('Order');

        return view('admin.orders.edit', compact('ordermstr', 'orderdtls', 'coupons', 'mscorderstatus'));
 
    }//END edit


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(2002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);

        //dd($request->all());

        //begin transaction
        $transaction = DB::transaction(function() use($request, $ordermstr, $id) {

            //check if order has products
            $products = [];

            if( isset($request->fk_products) ){
                
                //update product detail status
                //@order.edit.blade.php select name="fk_products[{{$a->fk_products}}]
                //$key = productid
                //$v = recordstatus
                foreach($request->fk_products as $key => $v){

                   OrderDtl::where('fk_ordermstr', $id)
                            ->where('fk_products', $key)
                            ->update([
                                'fk_recordstatus'=> $v,
                                'fk_updatedby'=> Auth::id()
                           ]);

                }//END foreach

            }//END isset($request->fk_products)
            

            //dd($products);

            session()->flash('success', "order has been updated!");
            
            return redirect()->back();


        });//END transaction

        return $transaction;


    }//END update




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
   
    }//END destroy



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_broadcast($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(2003)){
            return redirect('/admin/404');
        }


        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();

        $unbroadcastusers = OrderBroadcast::getUnbroadcastUsersPerOrder($ordermstr);
        //$unbroadcastusers = [];

        return view('admin.orders.broadcast', compact('ordermstr', 'orderdtls', 'unbroadcastusers'));
 
    }//END create_broadcast



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_broadcast(Request $request, $id)
    {
        //
        //return $request->all();
        //no checking of access. store_broadcast will only be triggerd in ajax request
        
        //begin transaction
        $transaction = DB::transaction(function() use($request, $id) {

            $ordermstr = OrderMstrView::findOrFail($id);
            $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();

            $customers = $request->customers;

            $when = Carbon::now()->addMinutes(1);

            Mail::to($customers['email'], $customers['fullname'])->later($when, new BroadCastNewOrders($ordermstr, $orderdtls, $customers));

            //Mail::to($customers['email'], $customers['fullname'])->queue(new BroadCastNewOrders($ordermstr, $orderdtls, $customers));

            /*$data = array('customers'=>$customers, 'ordermstr'=>$ordermstr, 'orderdtls'=>$orderdtls);

            $mail = Mail::send('admin.orders.broadcast-template', $data, function($message) use ($customers)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($customers['email'], $customers['fullname'])
                ->subject('New Orders!');
            });*/

            $fk_createdby = Auth::id();

            $broadcast = OrderBroadcast::create([
                'fk_users'=> $customers['userid'],
                'fk_ordermstr'=> $id,
                'fk_createdby'=> $fk_createdby,
                'fk_updatedby'=> $fk_createdby
            ]);



            return $broadcast;

        });//END transaction

        return $transaction;

       
    
    }//END store_broadcast


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sample_broadcast($id)
    {
        //

        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();
        
        $customers = [
            'email'=> "opic.billsmonitoring@gmail.com",
            'fullname'=> "Jane Doe",
            'userid'=> "1015",
        ];

        $when = Carbon::now()->addMinutes(1);

        Mail::to($customers['email'], $customers['fullname'])->later($when, new BroadCastNewOrders($ordermstr, $orderdtls, $customers));

        //Mail::to($customers['email'], $customers['fullname'])->queue(new BroadCastNewOrders($ordermstr, $orderdtls, $customers));

        return new BroadCastNewOrders($ordermstr, $orderdtls, $customers);

        /*

        $data = array('customers'=>$customers, 'ordermstr'=>$ordermstr, 'orderdtls'=>$orderdtls);

        $mail = Mail::send('admin.orders.broadcast-template', $data, function($message) use ($customers)
        {   
            $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            //$message->from('no.reply.termlimitsnow@gmail.com', 'YesLife');
            $message->to($customers['email'], $customers['fullname'])
            //$message->to('opic.billsmonitoring@gmail.com', 'OIPIC')
            ->subject('New Orders!');
        });

  
        return view('admin.orders.broadcast-template', compact('ordermstr', 'orderdtls', 'customers'));*/
 
    }//END sample_broadcast




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sample_succes_order($id)
    {
        //

        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();

        $users = User::findOrFail($ordermstr->fk_users); 
        
        //return view('landingpage.success-email-template', compact('users', 'ordermstr', 'orderdtls'));

        $data = array('users'=>$users, 'ordermstr'=>$ordermstr, 'orderdtls'=>$orderdtls);

        /*$mail = Mail::send('landingpage.success-email-template', $data, function($message) use ($users)
        {   
            $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            $message->to($users['email'], $users['fullname'])
            ->subject('Thank you for your purchase!');
        });*/

  
        return view('landingpage.success-email-template', compact('ordermstr', 'orderdtls', 'users'));
 
    }//END sample_succes_order



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sample_recurring($id)
    {
        //

        $this->setActiveTab();
        $ordermstr = OrderMstrView::findOrFail($id);
        $orderdtls = OrderDtlView::where('fk_ordermstr', $id)->orderBy('indexno', 'ASC')->get();

        $users = User::findOrFail($ordermstr->fk_users); 

        return view('admin.orders.broadcast-recurring', compact('ordermstr', 'orderdtls', 'users'));

    }//END sample_recurring


}//END class

