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
use App\ProductPriceList;
use App\ProductPriceListMstrView;

use App\User;

class ProductPriceListController extends Controller
{
    //
    
    public $menu_group = 'products.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Products');
        session()->flash('child_tab', $this->menu_group);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(1015)){
            return redirect('/admin/404');
        }


        $this->setActiveTab();
        $products = ProductMstrView::findOrFail($id);
        $pricelist = DB::SELECT("CALL usp_getAllUserTypeWithPriceList($id) ");

        return view('admin.products.pricelist', compact('products', 'pricelist'));
 
    }//END create


    /**
     * Store the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(1015)){
            return redirect('/admin/404');
        }

        //dd($request->all());

        $this->setActiveTab();
        $products = ProductMstrView::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $products, $id) {
        	

            if( $request->fk_usertype && $request->price && $request->discount ){

            	//delete older pricelist
            	ProductPriceList::where('fk_products', $id)->delete();
                
                //insert new set of pricelist
                //price list are in array. they are in correct index order with fk_usertype, price, discount

                $request['fk_createdby'] = Auth::id();
  
                for($i=0; $i<count($request->fk_usertype); $i++){

                	ProductPriceList::create([
                		'fk_products'=> $id,
                		'fk_usertype'=> $request->fk_usertype[$i],
                		'price'=> $request->price[$i],
                		'discount'=> $request->discount[$i],
                		'fk_createdby'=> $request->fk_createdby
                	]);

                }//END for loop

            }//END isset($request->fk_products)

            session()->flash('success', "product price list has been updated!");
            
            return redirect()->back();


        });//END transaction

        return $transaction;

    }//END create_broadcast


}
