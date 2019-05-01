<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Product;
use App\ProductComposition;

use App\User;


class ProductCompositionsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

        //default active sidebar
        $this->setActiveTab();

      
        if( request()->ajax() ){

        	return ['compositions'=> ProductComposition::getItemCompositions($id), 'searchitems'=> $this->search(request(), $id)];

        }

        $products = Product::findOrFail($id);

        return view('admin.products.compositions-create', compact('products'));

    }//END create



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $id)
    {
        //

        if( request()->ajax() ){

	
			$search = ( $request->search ) ?  '%'.$request->search.'%' : '%%';     	

        	$products = Product::where('name', 'like', $search)
        				->where('pk_products', '<>', $id)
        				->where('stat', 1)
        				->orderBy('name', 'ASC')
        				->limit(20)
        				->get();

        	return $products;

        }


    }//END search


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $products = Product::find($id);

        if(!$products){
        	return 'not found!';
        }

    	//begin transaction
        $transaction = DB::transaction(function() use($request, $id) {

            $request['fk_createdby'] = Auth::id();


            //remove all compositions
            ProductComposition::where('fk_products', $id)->delete();

            foreach($request->compositions as $key => $v){

            	ProductComposition::create([

            		'fk_products'=> $id,
            		'fk_compositions'=> $v['fk_compositions'],
            		'qty'=> $v['qty'],
            		'fk_createdby'=> $request->fk_createdby

            	]);

            }

            return 'success';


        });//END transaction

        return $transaction;
    

    }//END update




}//END class
