<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\Product;
use App\ProductMstrView;
use App\ProductPix;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductReviewsResource;

use App\ProductPriceListMstrView;

use App\ProductReview;
use App\ProductReviewMstrView;


use App\Category;

use App\User;

class ShopController extends Controller
{
    //
    
    public function setActiveTab(){
        session()->flash('active_tab', 'Shop');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $this->setActiveTab();


        //products will be fetched through ajax request
        return view('landingpage.shop');

    
    }//END index



    //call through api
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apisearch(Request $request)
    {
        //
        //return $request->all();
        $search = ( $request->search ) ? $request->search : null;

        $category = ( $request->category ) ? $request->category : 'All';

        $sortby = ( $request->sortby ) ? $request->sortby : 'bestsellers';

        $products = ProductMstrView::select();

        if( $search){
            $products->where('name', 'like', "%$search%");
        }

        if( $category != 'All' ){
            $products->where('fk_category', $category);
        }

   
        $products->where('stat', 1);

       
        if( $sortby == 'bestsellers' ){
            $products->orderBy('totalsalesqty', 'DESC');
        }


        if( $sortby == 'bestrated' ){
            $products->orderBy('ratings', 'DESC');
        }

        $products->orderBy('indexno', 'ASC')->orderBy('name', 'DESC');

        $products = $products->paginate(20);
        
        if( count($products) == 0 ){
            return ProductResource::collection($products);
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);


        if( $sortby == 'priceasc' ){

            $products = ProductPriceListMstrView::sortProductByPrice($products, 'asc');

        }   

        if( $sortby == 'pricedesc' ){

            $products = ProductPriceListMstrView::sortProductByPrice($products, 'desc');

        }

       
 
        return ProductResource::collection($products);
   
    }//END apisearch



    //call through api
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apishowcategories(Request $request)
    {
        //
        $mscategory = Category::where('stat', 1)->orderBy('indexno', 'ASC')->get();

        return $mscategory;
   
    }//END apishowcategoreis


    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_product($slug)
    {
        //
        
        //active tab
        $products = ProductMstrView::where('slug', $slug)->where('stat', 1)->first();

        if( !$products ){
            return redirect('/404');
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        //dd($products);

        $gallery = ProductPix::where('fk_products', $products->pk_products)->get();

        $reviews = ProductReviewMstrView::where('fk_products', $products->pk_products)
        			->orderBy('created_at', 'DESC')->paginate(1);

        $totalreviews = ProductReviewMstrView::countTotalReviews($products);


        $defaultproducts = ProductMstrView::where('stat', 1)
            ->orderBy('name', 'ASC')
            ->paginate(5);

        
        return view('landingpage.product-details', compact('products', 'defaultproducts', 'gallery', 'reviews', 'totalreviews'));

    
    }//END show_product


    //call through api
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apireviews(Request $request, $id)
    {
        //

        //active tab
        $products = ProductMstrView::findOrFail($id);

        $reviews = ProductReviewMstrView::where('fk_products', $products->pk_products)
                    ->orderBy('created_at', 'DESC')->paginate(10);

        return ProductReviewsResource::collection($reviews);

   
    }//END apisearch



    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post_reviews(Request $request, $id)
    {
        //
        //return $request->all();
    	$products = ProductMstrView::findOrFail($id);

        //request sent via ajax using serializeArray()
        //need to convert array into valid laravel request object
        foreach($request->all() as $v){
            $request[ $v['name'] ] = $v['value'];
        }

        $request['fk_users'] = Auth::id();
        $request['fk_products'] = $id;

        //dd($request->all());
        $validator = ProductReview::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $id) {

                $request['fk_createdby'] = $request['fk_users'];
                $request['fk_uptadeteby'] = $request['fk_users'];

                //delete existing product review by the current user
                $reviews = ProductReview::where('fk_users', $request->fk_users)
                			->where('fk_products', $request->fk_products)
                			->delete();

                //insert new review
                $reviews = ProductReview::create($request->all());

                //return latest reviews
                /*$reviews = ProductReviewMstrView::where('fk_products', $id)
                    ->orderBy('created_at', 'DESC')->paginate(10);

                return ProductReviewsResource::collection($reviews);*/

                return $this->apireviews($request, $id);



            });//END transaction

            return $transaction;

          
        }
        else{

            return response()->json($validator->errors(), 404);
        }

    }//END post_reviews



}//END class
