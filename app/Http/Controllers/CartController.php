<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Product;
use App\ProductMstrView;
use App\ProductQty;
use App\Http\Resources\ProductResource;

use App\ProductPriceListMstrView;

use App\OrderMstr;
use App\OrderDtl;

use App\User;
use App\UserCart;
use App\UserMstrView;

use App\UserCCInfo;

use App\Country;
use App\State;


class CartController extends Controller
{
    
    public function __construct(){

    }

    public function setActiveTab(){
        session()->flash('active_tab', 'Cart');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd( $_COOKIE['cart_13'] );
        
        //default
        $users = [
            'fname'=> '', 
            'lname'=> '',
            'email'=> '',
            'phone'=> '',
            'address1'=> '',
            'address2'=> '',
            'city'=> '',
            'state'=> '',
            'zip'=> '',
            'fk_country'=> '229',

            'shippingfname'=> '',
            'shippinglname'=> '',
            'shippingphone'=> '',
            'shippingaddress1'=> '',
            'shippingaddress2'=> '',
            'shippingcity'=> '',
            'shippingstate'=> '',
            'shippingzip'=> '',
            'shippingcountry'=> '229',

            'countryname'=> 'United States',

            'cardno'=> '',
            'expdate'=> '',
            'cvc'=> '',

        ];


        //default values
        $country = Country::getActiveCountry();

        $states = State::getStateByCountry(229); //default USA
        $iscustomstate = false;

        //determine if user is approving recurring order through checkout
        //recurring = order trxno
        $recurring = ( request()->recurring ) ? request()->recurring : null; 


        //check if user is logged in
        if( session('yeslife_virtual_user_id') || Auth::check() ){

            //check for admin login-as virtual user 
            //Generated @AppServiceProvider.php
            if( session('yeslife_virtual_user_id') ){
                //use credentials for virtual user
                $dbusers = UserMstrView::findOrFail(session('yeslife_virtual_user_id'));
            }else{
                //use default logged in user
                $dbusers = UserMstrView::findOrFail(Auth::id());
            }

            $states = State::getStateByCountry($dbusers->fk_country);
            $iscustomstate = State::isCustomState($dbusers->state);

            //format user to display in checkout page
            //
            $users['fname'] = $dbusers->fname;
            $users['lname'] = $dbusers->lname;
            $users['email'] = $dbusers->email;
            $users['phone'] = $dbusers->phone;
            $users['address1'] = $dbusers->address1;
            $users['address2'] = $dbusers->address2;
            $users['city'] = $dbusers->city;
            $users['state'] = $dbusers->state;
            $users['zip'] = $dbusers->zip;
            $users['fk_country'] = $dbusers->fk_country;
            $users['countryname'] = $dbusers->countryname;

            $users['shippingfname'] = $dbusers->shippingfname;
            $users['shippinglname'] = $dbusers->shippinglname;
            $users['shippingphone'] = $dbusers->shippingphone;
            $users['shippingaddress1'] = $dbusers->shippingaddress1;
            $users['shippingaddress2'] = $dbusers->shippingaddress2;
            $users['shippingcity'] = $dbusers->shippingcity;
            $users['shippingstate'] = $dbusers->shippingstate;
            $users['shippingzip'] = $dbusers->shippingzip;
            $users['shippingcountry'] = $dbusers->shippingcountry;
            $users['shippingcountryname'] = $dbusers->shippingcountryname;

            
            /*$users = [
                'fname'=> $dbusers->fname, 
                'lname'=> $dbusers->lname,
                'email'=> $dbusers->email,
                'phone'=> $dbusers->phone,
                'address1'=> $dbusers->address1,
                'address2'=> $dbusers->address2,
                'city'=> $dbusers->city,
                'state'=> $dbusers->state,
                'zip'=> $dbusers->zip,
                'fk_country'=> $dbusers->fk_country,
                'countryname'=> $dbusers->countryname,

                'shippingfname'=> $dbusers->shippingfname, 
                'shippinglname'=> $dbusers->shippinglname,
                'shippingphone'=> $dbusers->shippingphone,
                'shippingaddress1'=> $dbusers->shippingaddress1,
                'shippingaddress2'=> $dbusers->shippingaddress2,
                'shippingcity'=> $dbusers->shippingcity,
                'shippingstate'=> $dbusers->shippingstate,
                'shippingzip'=> $dbusers->shippingzip,
                'shippingcountry'=> $dbusers->shippingcountry,
                'shippingcountryname'=> $dbusers->shippingcountryname

            ];*/


            //retrieve default UserCCInfo
            $usersccinfo = UserCCInfo::getDefaultCCInfo($dbusers->id);
        
            if( $usersccinfo ){
                //set default values
                $users['cardno'] = $usersccinfo->cardno;
                $users['expdate'] = $usersccinfo->exmonth.'/'.$usersccinfo->exyear;
                $users['cvc'] = $usersccinfo->cvc;
            }

            //dd($users);

            /*$recurring = OrderMstr::where('trxno', $recurring)
                ->where('isapproved', 0)
                ->where('stat', 1)
                ->where('fk_users', Auth::id())
                ->first();*/

            $recurring = OrderMstr::isUnApproveRecurring($recurring, Auth::id());


        }//END Auth::check()

        //dd($users);
        
        //dd($recurring);
        

        //trigger where the success page came from
        session()->put('yeslife_order_from', 'Cart-Checkout');

        return view('landingpage.cart', compact('users', 'country', 'states', 'iscustomstate', 'recurring'));
    
    }//END index



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiindex(Request $request)
    {
        //

        $cart = ( $request->cart ) ? $request->cart : []; //cookiecart
        $isloggedin = ($request->isloggedin) ? $request->isloggedin : Auth::id(); //if loggedin, value is equals the the user id

        //determine if user is approving recurring order through checkout
        //recurring = order trxno
        $recurringtrxno = ($request->recurringtrxno) ? $request->recurringtrxno : null; 

        //retrieve the recurring order for approval
        if( (  $isloggedin != 'no' || Auth::check() ) && $recurringtrxno != null ){

            $ordermstr = OrderMstr::where('trxno', $recurringtrxno)
                        ->where('isapproved', 0)
                        ->where('stat', 1)
                        ->where('fk_users', $isloggedin)
                        ->first();

            //check if the order is still not approved
            if( $ordermstr ){

                $orderdtls = OrderDtl::where('fk_ordermstr', $ordermstr->pk_ordermstr)
                            ->get();
                $pid = $orderdtls->pluck('fk_products');
                
                $products = ProductMstrView::whereIn('pk_products',  $pid)
                    ->where('stat', 1)
                    ->orderBy('name', 'ASC')
                    ->get();

                //set selected qty
                foreach($products as $key => $v){

                    $v['selectedqty'] = 1;

                    foreach($orderdtls as $f){
            
                        if( $v->pk_products == $f['fk_products'] ){
                            $v['selectedqty'] = $f->qty;
                            break;
                        }
                        
                    }//END foreach $finalcart

                }//END foreach $products 

                $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

                //jsusertype = manual setting of usertype since ajax request invalidate Auth::check()
                $jsusertype = Auth::user()->fk_usertype;
                $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist, $jsusertype);

                $products = ProductResource::collection($products);

                return $products;

                //return '1';

            }//END count($ordermstr) > 0

        }//END $recurringtrxno != null


        $finalcart = []; //combined cookiecart and dbcart

        $jsusertype = ''; //manual setting of usertype since ajax request invalidate Auth::check()

        //return $cart;

        if( $isloggedin != 'no' || Auth::check() ){

            //retrieve usertype of the loggedin user;
            $jsusertype = User::where('id', $isloggedin)->first();
            $jsusertype = ($jsusertype) ? $jsusertype->fk_usertype : '';
            //return $jsusertype;

            //update or insert cart to db
            foreach($cart as $v){


                $tempcart = UserCart::where('fk_users', $isloggedin )
                            ->where('fk_products', $v['productid'])
                            ->get();

                //return $tempcart;

                //existing product by the customer
                if( count($tempcart) > 0 ){

                    //update
                    UserCart::where('fk_users', $isloggedin )
                        ->where('fk_products', $v['productid'])
                        ->update([
                            'qty'=> ( $v['qty'] != 'null' ) ? $v['qty'] : 1 //default 1
                        ]);

                }else{

                    //create
                    //possible kung ang user bg o ra nag login pero naka add cart na sya na naka store sa cookies
                    UserCart::create([
                        'fk_users'=> $isloggedin,
                        'fk_products'=> $v['productid'],
                        'qty'=> ( $v['qty'] != 'null' ) ? $v['qty'] : 1 //default 1
                    ]);

                }


            }//END foreach

            $finalcart = UserCart::where('fk_users', $isloggedin )->get()->toArray();

        }//END isloggedin

        //not loggedin
        if( $isloggedin == 'no' ){

            //initialize final cart equals to the cookiecart
            foreach($cart as $c){
                $finalcart[]=[
                    'fk_products'=> $c['productid'],
                    'qty'=> ( $c['qty'] != 'null' ) ? $c['qty'] : 1 //default 1
                ];
            }

        }

        //return $request->all();

        //$cart = [];
        
        //return $cart;

        //return $finalcart;

        $pid = array_map(function($v){
            return $v['fk_products'];
        }, $finalcart);



        if( count($finalcart) == 0 ){
            return response()->json('empty');
        }
        
        //return $pid;

        //return $finalcart;

        //return $request->all();

        $products = ProductMstrView::whereIn('pk_products',  $pid)
                    ->where('stat', 1)
                    ->orderBy('name', 'ASC')
                    ->get();

    
        //set selected qty
        foreach($products as $key => $v){

            $v['selectedqty'] = 1;

            foreach($finalcart as $f){
    
                if( $v->pk_products == $f['fk_products'] ){
                    $v['selectedqty'] = ( $f['qty'] != 'null' ) ? $f['qty'] : 1; //default 1
                    break;
                }
                
            }//END foreach $finalcart

        }//END foreach $products 

            
        if( count($products) == 0 ){
            return response()->json('empty');
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        //jsusertype = manual setting of usertype since ajax request invalidate Auth::check()
        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist, $jsusertype);

        $products = ProductResource::collection($products);


        $mscstates = State::getStateByCountry(229); //default USA

        return ['cart'=>$products, 'mscstates'=> $mscstates];
    
    }//END apiindex





    //called via api
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //return $request->all();

        //dd($request->all());
        $validator = UserCart::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $cart = UserCart::where('fk_users',$request->fk_users )->where('fk_products', $request->fk_products)->get();

                //existing product by the customer
                if( count($cart) > 0 ){

                    //update
                    $cart = UserCart::where('fk_users',$request->fk_users )
                            ->where('fk_products', $request->fk_products)
                            ->update([
                                'qty'=>$request->qty 
                            ]);

                }else{

                    //create
                    $cart = UserCart::create($request->all());

                }
        
                return 'success';


            });//END transaction

            return $transaction;

          
        }
        else{

            return $validator;
        }

    }//END store



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $cart = UserCart::where('fk_users', $request->fk_users)
                        ->where('fk_products', $request->fk_products)
                        ->delete();
                
                return 'success';


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            return PDOErr::checkException($e->errorInfo);

        }//END try

    }//END destroy



}//END class
