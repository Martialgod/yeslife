<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Aloha\Twilio\Manager;
use Aloha\Twilio\TwilioInterface;


Route::get('/twilio', function(){
    //+639331655515
    //+639152693481
    return Twilio::message('+639331655515', 'Test Message');
   
});


Route::get('/curl', function(){

    $curl = curl_init();
    
    //curl_setopt($curl, CURLOPT_URL, 'https://api.leaddyno.com/v1/purchases?key=4e4aa7fc362a674eec1a9780884d24f3799edc09');

    curl_setopt($curl, CURLOPT_URL, 'https://api.leaddyno.com/v1/visitors?key=4e4aa7fc362a674eec1a9780884d24f3799edc09');

    $result = curl_exec($curl);

    curl_close($curl);

    dd($result);

});


//sample
Route::get('/encrypt', function(){
    
    $enc =  Crypt::encryptString('Hello world');
    $dec = Crypt::decryptString($enc);

    dd(bcrypt('EZJLtAGyGy1017'));

    return [ $enc, $dec ];
});


//sample
Route::get('/encryptable', 'UsersCCInfoController@index');


Route::get('/phpinfo-opic', function(){
    
    dd(phpinfo());
  
});


Route::get('/artisan-clear', function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'config,cache,view and route all cleared';
});


Route::get('/artisan-command', function(){

    /*$linkName = '/home4/gutbrai2/public_html/nutritiontrust/storagelink';

    $target = '/home4/gutbrai2/public_html/nutritiontrust/storage/app/public';

    symlink($target, $linkName);*/
    //dd(phpinfo());
    //
    //dd(Carbon::now());
});


Route::get('/404', function(){
    return view('landingpage.404');
});

Route::get('/apisearchusers', 'UsersController@apisearchusers');


// ?refno=33213 -- optional for refferal 
Route::get('/', 'LandingPageController@index'); 
// ?refno=33213 -- optional for refferal 
Route::get('/about-us', 'LandingPageController@about_us');
// ?refno=33213 -- optional for refferal 
Route::get('/contact-us', 'LandingPageController@contact_us');
// ?refno=33213 -- optional for refferal 
Route::get('/terms-conditions', 'LandingPageController@terms_conditions');
// ?refno=33213 -- optional for refferal 
Route::get('/privacy-policy', 'LandingPageController@privacy_policy');

//cartcheckout?recurring=33213  -- optional for recurring checkout
//?refno=33213 -- optional for refferal 
Route::get('/cartcheckout', 'CartController@index');

//retrieve cookie cart; the same function in api.php
//in api.php, all api call from ajax removes the authentication. this needs to manually send isloggedin variable
// ?refno=33213 -- optional for refferal 
Route::post('/cart', 'CartController@apiindex');

// ?refno=33213 -- optional for refferal 
Route::get('/shop', 'ShopController@index');
//search through post, since it will contain lots of params
Route::post('/shop-search', 'ShopController@apisearch'); 

Route::get('/shop-categories', 'ShopController@apishowcategories'); 

// ?refid=33213 -- optional for refferal 
Route::get('/shop/{slug}', 'ShopController@show_product');
Route::get('/apishowproduct/{id}', 'ShopController@apishowproduct');
Route::get('/shop/{id}/reviews', 'ShopController@apireviews');
Route::post('/shop/{id}/reviews', 'ShopController@post_reviews')->middleware(['auth']);


// ?refno=33213 -- optional for refferal 
Route::get('/blog', 'PublicBlogController@index');
Route::get('/blog/{slug}', 'PublicBlogController@show');

Route::get('/blog/{id}/reviews', 'PostCommentsController@apireviews');
Route::post('/blog/{id}/reviews', 'PostCommentsController@post_reviews');


//sample email template for testing
Route::get('/sample-subscription-email-template/{id}', 'LandingPageController@sample_subscription_template');

Route::get('/activate/subscription/{token}', 'LandingPageController@activate_subscription');
Route::get('/activate/sample-subscription/user/{token}', 'LandingPageController@sample_subscription');

// ?refno=33213 -- optional for refferal 
Route::get('/order/success/{trxno}', 'LandingPageController@order_success');
Route::get('/sample-succes-order/{id}', 'OrderController@sample_succes_order');


Route::get('/myaccount/forgotpassword', 'RegisterController@createpassword');
Route::post('/myaccount/forgotpassword', 'RegisterController@sendemailreset');
Route::get('/myaccount/resetpassword/{token}', 'RegisterController@resetpassword');
Route::post('/myaccount/resetpassword/{token}', 'RegisterController@updatepassword');


Route::get('/myaccount/unsubscribe', 'MyAccountController@unsubscribe');
Route::get('/myaccount/resubscribe', 'MyAccountController@resubscribe');

// ?refno=33213 -- optional for refferal 
Route::get('/myaccount', 'RegisterController@create');
Route::post('/myaccount', 'RegisterController@store'); //login or register. base on logtype


Route::get('/myaccount/home', 'MyAccountController@index');
Route::get('/myaccount/orders', 'MyAccountController@orders');
Route::get('/myaccount/orders', 'MyAccountController@orders');
Route::get('/myaccount/orders/{trxno}', 'MyAccountController@editorders');
Route::put('/myaccount/orders/{trxno}', 'MyAccountController@updateorders');
Route::get('/myaccount/recurring', 'MyAccountController@recurring');
Route::get('/myaccount/recurring/{trxno}', 'MyAccountController@editrecurring');
Route::put('/myaccount/recurring/{trxno}', 'MyAccountController@updaterecurring');
Route::get('/myaccount/paymentmethod', 'MyAccountController@paymentmethod');
Route::get('/myaccount/paymentmethod/{id}', 'MyAccountController@editpaymentmethod');
Route::put('/myaccount/paymentmethod/{id}', 'MyAccountController@updatepaymentmethod');
Route::get('/myaccount/reviews', 'MyAccountController@reviews');
Route::get('/myaccount/address', 'MyAccountController@address');
Route::put('/myaccount/address', 'MyAccountController@updateaddress');
Route::get('/myaccount/details', 'MyAccountController@details');
Route::put('/myaccount/details', 'MyAccountController@updatedetails');
//Route::get('/myaccount/affiliate', 'MyAccountController@affiliate');


Route::post('/logout', 'RegisterController@destroy');
Route::get('/logout', 'RegisterController@destroy');


// authenticated page
Route::get('admin/home', 'HomeController@index')->name('admin.home');


Route::get('admin/404', function(){
    return view('admin.404');
})->middleware(['auth']);


//admin login page
Route::get('/admin/login', function(){

    if(Auth::check()){
        return redirect('/admin/home');
    }
	return view('admin.login');

})->name('login');



//admin session control
Route::post('/admin/login', 'SessionsController@store');
Route::post('/admin/logout', 'SessionsController@destroy');
Route::get('/admin/logout', 'SessionsController@destroy');

Route::get('/admin/profile', 'UsersController@profile');
Route::put('/admin/profile', 'UsersController@updateprofile');


Route::resource('/admin/users', 'UsersController');
Route::get('/admin/users/{id}/downline', 'UsersController@downline')->name('users.downline');
Route::get('/admin/users/{id}/login-as', 'UsersController@virtual')->name('users.virtual');


Route::resource('/admin/usertype', 'UserTypeController');

Route::get('/admin/usertype/{id}/modules', 'UserTypeController@show_modules')->name('usertype.modules');

Route::post('/admin/usertype/{id}/modules', 'UserTypeController@update_modules')->name('usertype.modules');


Route::resource('/admin/rewards', 'UserRewardsController');


Route::resource('/admin/orders', 'OrderController');

Route::get('/admin/orders-export', 'OrderController@export');


Route::get('/admin/orders/{id}/broadcast', 'OrderController@create_broadcast')->name('orders.broadcast');

Route::post('/admin/orders/{id}/broadcast', 'OrderController@store_broadcast')->name('orders.broadcast');

Route::get('/admin/orders/{id}/broadcast/sample', 'OrderController@sample_broadcast');

Route::get('/admin/recurring/broadcast/sample/{id}', 'OrderController@sample_recurring');

Route::resource('/admin/abandonedcart', 'AbandonedCartController');

Route::post('/admin/abandonedcart/broadcast', 'AbandonedCartController@store_broadcast')->name('abandonedcart.broadcast');

Route::get('/admin/abandonedcart/broadcast/sample/{id}', 'AbandonedCartController@sample_broadcast');


Route::resource('admin/products', 'ProductsController');
Route::delete('/admin/products/{id}/softdelete', 'ProductsController@softdelete')->name('products.softdelete');

Route::get('/admin/products/{id}/pricelist', 'ProductPriceListController@create')->name('products.pricelist');
Route::post('/admin/products/{id}/pricelist', 'ProductPriceListController@store')->name('products.pricelist');


Route::resource('admin/blogs', 'BlogsController');

Route::resource('/admin/category', 'CategoryController');

Route::resource('/admin/coupons', 'CouponsController');

Route::resource('/admin/flavors', 'FlavorsController');

Route::resource('/admin/productgroup', 'ProductGroupController');

Route::resource('/admin/country', 'CountryController');

Route::resource('/admin/states', 'StatesController');

Route::resource('/admin/actions', 'RewardActionsController');

Route::resource('admin/tags', 'TagsController');


Route::get('/admin/reports', 'ReportsController@index')->name('reports.index');
Route::get('/admin/reports/{id}', 'ReportsController@generate');


//social login
Route::get('/redirectfb', 'SocialAuthFacebookController@redirect');
Route::get('/callbackfb', 'SocialAuthFacebookController@callback');

Route::get('/redirectgoogle', 'SocialAuthGoogleController@redirect');
Route::get('/callbackgoogle', 'SocialAuthGoogleController@callback');

Route::get('/redirectlinkedin', 'SocialAuthLinkedinController@redirect');
Route::get('/callbacklinkedin', 'SocialAuthLinkedinController@callback');

Route::get('/redirecttwitter', 'SocialAuthTwitterController@redirect');
Route::get('/callbacktwitter', 'SocialAuthTwitterController@callback');
