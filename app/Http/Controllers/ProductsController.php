<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use App\AppStorage;

use Carbon\Carbon;

use App\Product;
use App\ProductMstrView;
use App\ProductQty;
use App\ProductPix;
use App\Http\Resources\ProductResource;

use App\ProductPriceListMstrView;

use App\Category;

use App\User;

class ProductsController extends Controller
{
    
    public $menu_group = 'products.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['apiproducts']);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Products');
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
        if(!User::isUserHasAccess(1011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $products = ProductMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $products->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%");
            });

        }

        $products->where('isdeleted', 0);

        $products = $products->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        //
        if( count($products) == 0 ){
            return view('admin.products.index', compact('sub_menu', 'products', 'search'));
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        return view('admin.products.index', compact('sub_menu', 'products', 'search'));
    
    }//END index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        //check if user has access
        if(!User::isUserHasAccess(1012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $category = Category::getActiveCategory();
        return view('admin.products.create', compact('category'));
    
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
        //check if user has access
        if(!User::isUserHasAccess(1012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = Product::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();
                $request['stat'] = 1;
         
                //create will return the newly created object
                $products = Product::create($request->all()); //insert all $request

                //dd($products);
                $productqty = ProductQty::create([
                    'fk_products'=> $products->pk_products,
                    'qty'=> $request->qty,
                    'oldqty'=> 0,
                    'fk_updatedby'=> Auth::id()
                ]);

                //if request uploaded products logo
                if( $request->pictxa ){

                    //update DB for correct filename @pictx
                    $products->update([
                        'pictxa'=> AppStorage::store('products', $request->pictxa)
                    ]);

                }//END check if request has uploaded a file



                //loop photo gallery
                if( $request->gallery ){

                    foreach($request->gallery as $v){

                        ProductPix::create([
                            'fk_products'=> $products->pk_products,
                            'pictx'=> AppStorage::store('products', $v)
                        ]);
                    }
                    //end loop photo gallery
                }//END if  $request->gallery
               

                
                session()->flash('success', "$request->name has been created!");
                return redirect()->back();



            });//END transaction

            return $transaction;
          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }

        //dd($request->all());
    
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
        return redirect('/admin/products');
    
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
        if(!User::isUserHasAccess(1013)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $products = ProductMstrView::findOrFail($id);
        $category = Category::getActiveCategory();
        $gallery = ProductPix::where('fk_products', $id)->get();
        return view('admin.products.edit', compact('products', 'category', 'gallery'));
    
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
        if(!User::isUserHasAccess(1013)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
    
        //dd($request->all());
        
        $products = Product::findOrFail($id);

        $request['fk_updatedby'] = Auth::id();
        $request['pk_products'] = $products->pk_products;

        $validator = Product::custom_validation($request, 'update');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $products) {

                $pview = ProductMstrView::find($products->pk_products);

                //to be remove from storage
                $oldfilename = $products->pictxa; 

                //dd($request->all());
         
                $products->update($request->all());

                $productqty = ProductQty::create([
                    'fk_products'=> $products->pk_products,
                    'qty'=> $request->qty,
                    'oldqty'=> 0,
                    'fk_updatedby'=> Auth::id()
                ]);

                //check if user removed the logo
                if( $request->removepictxa && $request->removepictxa == 'on' ){
                                       
                    AppStorage::remove($oldfilename);

                    //update DB for correct filename @pictx
                    $products->update([
                        'pictxa'=> null
                    ]);

                }//END check if user removed the logo


                //if request uploaded products logo
                if( $request->pictxa ){

                    AppStorage::remove($oldfilename);
                    
                    //update DB for correct filename @pictx
                    $products->update([
                        'pictxa'=> AppStorage::store('products', $request->pictxa)
                    ]);

                }//END check if request has uploaded a file


                //loop photo gallery
                if( $request->gallery ){

                    foreach($request->gallery as $v){

                        ProductPix::create([
                            'fk_products'=> $products->pk_products,
                            'pictx'=> AppStorage::store('products', $v)
                        ]);
                    }
                    //end loop photo gallery
                }//END if  $request->gallery
               
                
                //remove gallery
                if( $request->removegallery ){

                    foreach($request->removegallery as $key => $v){
                        
                        ProductPix::where('pictx', $key)->delete();
                        AppStorage::remove($key);

                    }

                }//END remove gallery


                
                session()->flash('success', "$request->name has been updated!");
                return redirect()->back();


            });//END transaction

            return $transaction;

          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);

        }

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
        //check if user has access
        if(!User::isUserHasAccess(1014)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $products = Product::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($products, $id) {

                $name = $products->name;

                $oldpictxa = $products->pictxa;

                ProductQty::where('fk_products', $id)->delete();


                //remove gallery
                $gallery = ProductPix::where('fk_products', $id)->get();
               
                ProductPix::where('fk_products', $id)->delete();


                $products->delete(); //delete products
                AppStorage::remove($oldpictxa);


                //delete gallery on the last part of the transaction
                //this will prevent accidental deletion when transaction fails
                foreach($gallery as $key => $v){
                    AppStorage::remove($v->pictx);
                }

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try
        
    }//END destroy


   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softdelete($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(1016)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $products = Product::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($products, $id) {

                $name = $products->name;

                $products->update([
                    'isdeleted'=> 1,
                    'fk_deletedby'=> Auth::id(),
                    'deleted_at'=> Carbon::now(),
                    'stat'=> 0
                ]);

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try
        
    }//END softdelete



}//END class
