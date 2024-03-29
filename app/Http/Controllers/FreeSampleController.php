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

use App\Http\Resources\ProductResource;
use App\ProductPriceListMstrView;

use App\OrderMstrView;
use App\OrderDtlView;

use App\User;

use App\Country;
use App\State;

class FreeSampleController extends Controller
{
    //
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
 	      
        //trigger where the success page came from
        session()->put('yeslife_order_from', 'Free-Sample');

 		//10 = Free Sample!
        $products = ProductMstrView::where('fk_productgroup', 10)->first();

        if(!$products){
        	return redirect('/404');
        }


        //default values
        $country = Country::getActiveCountry();

        $states = State::getStateByCountry(229); //default USA

        return view('landingpage.free-sample', compact('products', 'country', 'states'));
    
    }//END index



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apishowproduct($id)
    {
        //
    
        //10 = Free Sample!
        $products = ProductMstrView::where('fk_productgroup', 10)
                    ->where('pk_products', $id)
                    ->get();

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        $products = ProductResource::collection($products);

        return $products;

    
    }//END apishowproduct




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isfirsttimer($email, $productid)
    {
        //
        $result =  OrderMstrView::isfirsttimer_freesample($email, $productid);

        return response()->json($result);
    
    }//END isfirsttimer

    

    


}//END class

