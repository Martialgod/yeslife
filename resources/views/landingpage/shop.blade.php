@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
    <script src="/customjs/ShopController.js?v={{time()}}" type="text/javascript"></script>
    

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Shop', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Shop'
    ])


    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div" ng-app="app" ng-controller="ShopController as vm" >
        
        <div class="container">
            
            {{--
            <div class="row">

                <div class="form-group col-md-12">

                    <input type="text" placeholder="search here..." class="form-control" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}"  >
                  
                </div>
                
            </div>--}}


            {{--<div class="search">
               
               <div class="">
                    <form class="search-form" ng-submit="vm.SearchProducts()">
                        <input type="text" placeholder="search here..." class="" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}"  >
                        <input type="submit" value="Search">
                    </form>
                </div>

              
            </div> --}}

            <div class="row pull-right" >

                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="search here..."  ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}" >
                  <div class="input-group-append">
                    <button class="btn btn-default" style="background-color: #286700;" type="button"  ng-click="vm.SearchProducts()" >
                        Search
                    </button>
                  </div>
                </div>

                
            </div>
            <br/> <br><br>

          

    

            <!-- Shop Toolbar Start -->
            <div class="row" id="div-toolbar" hidden>
                <div class="col">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <button class="grid active" data-mode="grid"><span>grid</span></button>
                            <button class="list" data-mode="list"><span>list</span></button>
                        </div>
                        <div class="product-showing mr-auto" ng-if="vm.mscproducts.length > 0" >
                            <p>Showing @{{vm.meta.current_page}} of @{{vm.meta.last_page}}</p>
                        </div>

                        {{--
                        <div class="product-short">
                            <p>Short by</p>
                            <select class="nice-select">
                                <option value="trending">Trending items</option>
                                <option value="sales">Best sellers</option>
                                <option value="rating">Best rated</option>
                                <option value="date">Newest items</option>
                                <option value="price-asc">Price: low to high</option>
                                <option value="price-desc">Price: high to low</option>
                            </select>
                        </div><!--END product-short-->
                        --}}

                    </div><!--END shop-toolbar-->
                </div><!--END col-->
            
            </div><!-- Shop Toolbar End -->


            
            {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}


            <div class="shop-product-wrap grid row" id="div-products" hidden>

                <!-- Product Item Start -->
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-30"  ng-repeat="list in vm.mscproducts">
                    
                    <div class="product-item">
                        
                        <!-- Image -->
                        <div class="product-image">
                            <!-- Image -->
                            <a ng-href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}"> 
                                <img style="" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="">
                            </a>


                            <input type="hidden" name="productid" value="@{{list.productid}}">
                            <input type="hidden" name="productname" value="@{{list.name}}">
                            <input type="hidden" name="qty" value="@{{list.selectedqty}}" >


                            <!-- Product Action -->
                            <div class="product-action" ng-if="list.qty > 0">
                                <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                    <span class="fa fa-shopping-cart" ></span> 

                                </button>
                            </div>

                            <div class="product-action" ng-if="list.qty <=0">
                                <div class="product-action" lass="btn btn-default" >
                                    <span class="badge badge-danger">Out of stock</span>
                                </div>
                            </div>

         
                        </div><!--END product-image-->

                        <!-- Content -->
                        <div class="product-content">
                            
                            <div class="head">
                                <!-- Title-->
                                <div class="top">
                                    <h4 class="title">
                                        <a href="{{url('/shop')}}/@{{list.slug}}{{$refnourl}}"> 
                                            @{{list.name}} 
                                        </a>
                                    </h4>
                                </div>
                                
                                <!-- Price & Ratting -->
                                <div class="bottom">
                                    
                                    <span class="price">
                                        $@{{list.cartdiscountedprice}}
                                        <span ng-if="list.cartdiscountedprice < list.cartprice" class="old">$@{{list.cartprice}}</span>
                                    </span>


                                    
                                    <span class="ratting">
                                        <span ng-bind-html="list.stars_string"></span>
                                    </span>

                                </div><!--END bottom-->


                               
                                <!-- Product Action -->
                                <div class="product-action text-center" ng-if="list.qty > 0">
                                    <br>
                                    <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                        Add To Cart

                                    </button>


                                    <button type="button" ng-click="vm.GlobalBuyNow(list)" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  > 
                                        Buy Now
                                    </button>

                                </div>

                                <div class="product-action"  ng-if="list.qty <=0">
                                    <span class="badge badge-danger">Out of stock</span>
                                </div>


                            </div><!--END head-->

                            <div class="body">
                               
                                <div ng-bind-html="list.description"></div>

                                <br>

                                <!-- Product Action -->
                                <div class="product-action">
                                    <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                        <span class="fa fa-shopping-cart" ></span> 

                                    </button>
                                </div><!--END product-action-->

                            </div><!--END body-->

                        </div><!--END product-content-->
                    
                    </div><!--END product-item-->
                
                </div><!-- col-xl-3 col-lg-4 col-sm-6 col-12 mb-30 -->


            </div><!--END shop-product-wrap grid row-->


            <div class="row mt-20" style="" ng-if="vm.mscproducts.length>0">
                
                <div class="col">

                    <ul class="page-pagination">
                        
                        <li>
                            <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.prev" ng-click="vm.LoadProducts(vm.navlinks.prev)">
                                <i class="fa fa-angle-left"></i>
                                Back
                            </button>
                        </li>

                        <li>..</li>

                        <li>
                            <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.next" ng-click="vm.LoadProducts(vm.navlinks.next)">
                                <i class="fa fa-angle-right"></i>
                                Next
                            </button>
                        </li>

                    </ul><!--END page-pagination-->

                </div><!--END col-->

            </div><!--END row mt-20-->
        
        </div><!--END container-->

    </div><!--END product-section -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

    
    <script type="text/javascript">
        //broadcast toastr
        $(document).ready(function(){

            if( $('#toastrbroadcastcount').html() == 1 ){

                setTimeout(function(){

                    toastr.clear();

                    var temptitle = $('#toastrbroadcasttitle').html();
                    var tempmessage = $('#toastrbroadcastmessage').html();

                    toastr.success(tempmessage, temptitle, {
                        'iconClass': 'toast-broadcast'
                    }).css("width","100%");

                }, 1000);

            }
           

        });


    </script>
    


@endsection



	


				    