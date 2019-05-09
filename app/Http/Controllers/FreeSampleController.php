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




}//END class

