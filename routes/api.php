<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//retrieve apiproducts
//Route::get('/products', 'ProductsController@apiproducts');

//retrieve cookie cart
//in api.php, all api call from ajax removes the authentication. this needs to manually send isloggedin variable
Route::post('/cart', 'CartController@apiindex');

Route::post('/add-cart', 'CartController@store'); //api call. removes authentication
Route::delete('/remove-cart', 'CartController@destroy'); //api call. removes authentication

//save to db and payments
Route::post('/save-order', 'OrderController@store');

Route::get('getstatebycountry/{id}', 'StatesController@apigetstatebycountry');

Route::post('/searchcoupon', 'CouponsController@apisearchcoupon');

Route::post('/contact-us', 'LandingPageController@apistorecontactus');
Route::post('/subscribe', 'LandingPageController@apistoresubscription');
