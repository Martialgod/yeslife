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

use App\UserCart;

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




    /**
     * Display a listi
     * ng of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop_business_partners()
    {
        //

        //admin or businespartner
        if( Auth::check() && (Auth::user()->fk_usertype == '1000' || Auth::user()->fk_usertype == '1010') ){

            $this->setActiveTab();
            //products will be fetched through ajax request
            return view('landingpage.shop-business-partners');

        }

        return redirect('/shop');

    
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

        $shoptype = ( $request->shoptype ) ? $request->shoptype : null;

        $category = ( $request->category ) ? $request->category : 'All';

        $sortby = ( $request->sortby ) ? $request->sortby : 'default'; //default

        $products = ProductMstrView::select();

        if( $search){
            $products->where('name', 'like', "%$search%");
        }

        if( $category != 'All' ){
            $products->where('fk_category', $category);
        }


        $products->where('stat', 1);


        if( $shoptype == 'businesspartners' ){

            $products->where('fk_productgroup', 1);

        }else{

            $products->where('fk_productgroup', '<>', 1);

        }

       
        if( $sortby == 'bestsellers' ){
            $products->orderBy('totalsalesqty', 'DESC');
        }


        if( $sortby == 'bestrated' ){
            $products->orderBy('ratings', 'DESC');
        }

        if( $shoptype != 'businesspartners' ){

            //display by group
            $products->groupBy('fk_productgroup');

        }
       

        $products->orderBy('indexno', 'ASC')->orderBy('name', 'DESC'); //default

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

   
        if( $shoptype == 'businesspartners' ){

            //retrieve current cart
            $finalcart = UserCart::where('fk_users', Auth::id() )->get()->toArray();

            //initialize selectedqty 
            foreach($products as $k1=> $v1){

                $v1->selectedqty = 0;

                foreach($finalcart as $k2=>$v2){

                    if( $v1->pk_products == $v2['fk_products'] ){

                        $v1->selectedqty = $v2['qty'];

                    }

                }

            }//END foreach

            

        }//END if $shoptype == 'businesspartners'
       
 
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
        
        //redirect old slug. already been indexed in google
        if($slug == '250mg_Broad_Spectrum_Mixed_Berry_30ml'){
            return redirect('/shop/250mg-broad-spectrum-mixed-berry-30ml');
        }else if($slug == '1000mg_Broad_Spectrum_Mixed_Berry_30ml'){
            return redirect('/shop/1000mg-broad-spectrum-mixed-berry-30ml');
        }else if($slug == '300mg_4oz_Pain_Gel'){
            return redirect('/shop/300mg-4oz-pain-gel');
        }else if($slug == '150mg_2oz_Pain_Gel'){
            return redirect('/shop/150mg-2oz-pain-gel');
        }else if($slug == '500mg_Broad_Spectrum_Mixed_Berry_30ml'){
            return redirect('/shop/500mg-broad-spectrum-mixed-berry-30ml');
        }else if($slug == '500mg_Nano'){
            return redirect('/shop');
        }

        //active tab
        $products = ProductMstrView::where('slug', $slug)->where('stat', 1)->first();

        if( !$products ){
            return redirect('/404');
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        $flavors = ProductMstrView::where('fk_productgroup', $products->fk_productgroup)
                    ->whereNotNull('fk_flavors')
                    ->where('fk_productgroup', '<>', 1) // do not include business bulk products
                    ->orderBy('indexno', 'ASC')
                    ->orderBy('name', 'DESC')
                    ->get();

        //dd($flavors);

        $gallery = ProductPix::where('fk_products', $products->pk_products)->get();

        $reviews = ProductReviewMstrView::where('fk_products', $products->pk_products)
        			->orderBy('created_at', 'DESC')->paginate(1);

        $defaultproducts = ProductMstrView::where('stat', 1)
            ->where('pk_products', '<>', $products->pk_products )
            ->where('fk_productgroup', '<>', 1) // do not include business bulk products
            ->groupBy('fk_productgroup')
            ->orderBy('indexno', 'ASC')
            ->orderBy('name', 'DESC')
            ->paginate(5);

        
        return view('landingpage.product-details', compact('products', 'flavors', 'defaultproducts', 'gallery', 'reviews'));

    
    }//END show_product



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apishowproduct($id)
    {
        //
        
        //active tab
        $products = ProductMstrView::where('pk_products', $id)->where('stat', 1)->first();
        //return $products;
        if( !$products ){
            return response()->json('not found');
        }

        $pricelist = ProductPriceListMstrView::getProductPriceList($products->pluck('pk_products'));

        $products = ProductPriceListMstrView::mapProductPriceList($products, $pricelist);

        $flavors = ProductMstrView::where('fk_productgroup', $products->fk_productgroup)
                    ->whereNotNull('fk_flavors')
                    ->orderBy('indexno', 'ASC')
                    ->orderBy('name', 'DESC')
                   ->where('stat', 1)
                    ->get();

        //dd($flavors);
        

        $totalreviews = ProductReviewMstrView::countTotalReviews($products);

        $gallery = ProductPix::where('fk_products', $products->pk_products)->get();

        return ['products'=> $products, 'flavors'=> $flavors, 'gallery'=> $gallery, 'totalreviews'=> $totalreviews];

    
    }//END apishowproduct



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
