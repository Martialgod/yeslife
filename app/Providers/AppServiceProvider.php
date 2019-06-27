<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use App\User;

use App\UserCart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //

        /*
            SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes 
        */
        Schema::defaultStringLength(191);

        //global variable on admin page header
        view()->composer('admin.layouts.header', function($view){

            $dfrom = date('Y-m-d').' 00:00:00';
            $dto = date('Y-m-d').' 23:59:59';

            //dd($dfrom.'x'.$dto);

            $newordercount = DB::select("SELECT udf_countOrdersByDate('$dfrom', '$dto') as newordercount ");

            $abandonedcartcount = DB::select("SELECT udf_countAbandonedCart() as abandonedcartcount ");

            //dd($newordercount);
            //dd($abandonedcartcount);

            $newordercount = $newordercount[0]->newordercount;
            $abandonedcartcount = $abandonedcartcount[0]->abandonedcartcount;
            //dd($abandonedcartcount);

            $view->with(compact('newordercount', 'abandonedcartcount'));

        });


        //select main_menu
        view()->composer('admin.layouts.sidebar', function($view){
           
            $uid = ( Auth::id() ) ? Auth::id() : -1; //-1 not authenticated
            
            $main_menu = User::getMainMenu($uid);
            //dd($main_menu);
            $view->with(compact('main_menu'));

        });


        //toastr order broadcast in master layout
        view()->composer('landingpage.layouts.master', function($view){

           
            $toastrbroadcast = \App\OrderMstr::where('fk_users', '<>', '1000')
                            ->inRandomOrder()
                            ->first();

            //dd($toastrbroadcast);
            
            $toastrbroadcastcount = 0;
            $toastrbroadcastmstr = null;
            $toastrbroadcastdtls = '';

            if( $toastrbroadcast ){
                
                //45 = free sample id on live db
                //32 = free sample id on training db
                $tempdtls = \App\OrderDtlView::where('fk_ordermstr', $toastrbroadcast->pk_ordermstr)
                            ->whereNotIn('fk_products', [45, 32])
                            ->get();

                if( count($tempdtls) > 0 ){

                    $toastrbroadcastcount = 1;

                    $toastrbroadcastmstr = $toastrbroadcast->billingfname.' '.ucfirst(substr($toastrbroadcast->billinglname, 0, 1)).' from '.ucfirst($toastrbroadcast->billingstate).' bought the following: <br> ';

                }

                foreach($tempdtls as $key => $v){

                    $toastrbroadcastdtls.= round($tempdtls[0]->qty).' bottle(s) of '.$tempdtls[0]->name.'<br>';

                }


            }
            
            $view->with(compact('toastrbroadcastcount', 'toastrbroadcastmstr', 'toastrbroadcastdtls'));

        });


        //header for landing page
        view()->composer('landingpage.layouts.header', function($view){
           
            $uid = ( Auth::id() ) ? Auth::id() : -1; //-1 not authenticated
            
            $cookie = request()->cookie();

            //dd($cookie);

            $yeslifecartcount = 0;

            foreach($cookie as $key => $v){

                if( strpos($key, 'yeslifecart_') !== false ){

                    $yeslifecartcount++; //increment default cart cookie count

                    $productid =  str_replace("yeslifecart_","", $key);

                    //check for logged in users
                    if( $uid != -1 ){

                        // Retrieve UserCart by fk_users and fk_products, or create it if it doesn't exist...
                        $cart = UserCart::firstOrCreate(
                            [
                                'fk_users' => $uid, 
                                'fk_products'=> $productid
                            ],
                            [
                                'qty'=> 1
                            ]
                        );

                    }//END $uid != -1


                }//END strpos($key, 'yeslifecart_') !== false

            }//END foreach($cookie as $key => $v)


            //check for logged in users
            if( $uid != -1 ){

                //count the cart in the database
                //$usercart = UserCart::where('fk_users', $uid)->pluck('fk_products');
                
                //check for admin login-as virtual user
                if( session('yeslife_virtual_user_id') ){
                    $uid = session('yeslife_virtual_user_id');
                }
                
                /*$usercart = DB::SELECT("
                    SELECT ROUND(sum(a.qty))  as qty
                    FROM userscart a 
                    INNER JOIN products b 
                    ON a.fk_products = b.pk_products 
                    WHERE b.stat = 1 AND a.fk_users = '$uid'
                ");

                if( count($usercart) > 0 ){
                    $yeslifecartcount = $usercart[0]->qty;
                } */

                //count the cart in the database
                $accountcart = DB::SELECT("
                    SELECT ROUND(coalesce(sum(a.qty), 0)) as totalqty
                    FROM userscart a 
                    INNER JOIN products b 
                    ON a.fk_products = b.pk_products 
                    WHERE b.stat = 1 AND a.fk_users = '$uid'
                ");

                if( count($accountcart) > 0 ){

                    $yeslifecartcount = $accountcart[0]->totalqty;
                
                }

                /*$usercart = DB::SELECT("
                    SELECT a.fk_products 
                    FROM userscart a 
                    INNER JOIN products b 
                    ON a.fk_products = b.pk_products 
                    WHERE b.stat = 1 AND a.fk_users = '$uid'
                ");
                
                $yeslifecartcount = count($usercart); */

            }//END $uid != -1


            //dd($yeslifecartcount);

            $view->with(compact('yeslifecartcount'));

        });


        //share in all view *
        //retrieve affiliate referrer url
        view()->composer('*', function($view) {

            //refno = optional referal token; use in affiliate
            $refno = isset(request()->refno) ? request()->refno : null;

            //refno = optional referal token; use in affiliate
            $referrer = User::getReferrer(request());



            $refnourl = '';
            if( isset($referrer) ){

                //declare global session referrer_id. to be used in Social Login
                session()->put('yeslife_referrer_id', $referrer->id);


                $refnourl = '?refno='.$referrer->affiliate_token;

            }else{

                //declare global session referrer_id. to be used in Social Login
                //session()->put('yeslife_referrer_id', null);

            }

            //dd(session('yeslife_referrer_id'));

            //dd($referrer);

            //dd(session('yeslife_referrer_id'));
            
            //declare global curent logged in id
            //check for admin login-as virtual user
            $isloggedin = 'no';
            $virtualuser;
            if( session('yeslife_virtual_user_id') ){
                
                $isloggedin = session('yeslife_virtual_user_id');

                $virtualuser = User::findOrFail(session('yeslife_virtual_user_id'));

            }else{
                //check for normal logged in user; no virtual session
                $isloggedin = (Auth::check()) ? Auth::id() : 'no';
            }
            
            $view->with(compact('referrer', 'refnourl', 'isloggedin', 'virtualuser'));

        });


    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
