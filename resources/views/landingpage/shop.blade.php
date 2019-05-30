@extends('landingpage.layouts.master')

@section('title', 'Buy CBD Oil Online | CBD Store | Yes.Life')

@section('meta')

    <meta name="robots" content="index, follow" />
    <meta name="description" content="Buy cbd oil online at Yes.Life's cbd store and be confident that you're getting the highest quality and most absorbable hemp cbd products on the market. Experience the Yes.Life difference in your health & healing today!">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
    <script src="/customjs/ShopController.js?v={{time()}}" type="text/javascript"></script>
    

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Yes.Life CBD Store', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Shop'
    ])


    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div" ng-app="app" ng-controller="ShopController as vm" >
        
        <div class="container" ng-cloak> {{-- ng-cloak = hides angularjs initial template load --}}

            <div class="row">


                <div class="col-xl-9 col-lg-8 col-12 order-2 order-lg-2 mb-sm-50 mb-xs-50">

                    <div ng-bind-html="vm.categorydescription" style="font-size: 18px;"> </div>
                    <hr>

                    <!-- Shop Toolbar Start -->
                    <div class="row" id="div-toolbar" >
                        <div class="col">
                            <div class="shop-toolbar">
                                <div class="product-view-mode">
                                    <button id="btn-view-mode-grid" class="grid active" data-mode="grid"><span>grid</span></button>
                                    <button id="btn-view-mode-list" class="list" data-mode="list"><span>list</span></button>
                                </div>
                                <div class="product-showing mr-auto" ng-if="vm.mscproducts.length > 0" >
                                    <p>Showing @{{vm.meta.current_page}} of @{{vm.meta.last_page}}</p>
                                </div>

                                <div class="product-short">
                                    <p>Sort by</p>
                                    <select id="sortby" class="nice-select" ng-model="vm.sortby" ng-change="vm.LoadProducts()">
                                        <option value="default">Default</option>
                                        <option value="bestsellers">Best sellers</option>
                                        <option value="bestrated">Best rated</option>
                                        <option value="priceasc">Price: low to high</option>
                                        <option value="pricedesc">Price: high to low</option>
                                    </select>
                                </div><!--END product-short-->
                            

                            </div><!--END shop-toolbar-->
                        </div><!--END col-->
                    
                    </div><!-- Shop Toolbar End -->

                    
                    {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}


                    <div class="shop-product-wrap grid row" id="div-products" >

                        <!-- Product Item Start -->
                        <div class="col-xl-4 col-lg-4 col-sm-6 col-12 mb-30"  ng-repeat="list in vm.mscproducts">
                            
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
                                        
                                        {{--<button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                            <span class="fa fa-shopping-cart" ></span> 

                                        </button> --}}

                                        <a href="{{url('/shop')}}/@{{list.slug}}{{$refnourl}}" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  title="">
                                            <span class="fa fa-shopping-cart" ></span> 
                                        </a>

                                    </div>

                                    <div class="product-action" ng-if="list.qty <=0">
                                        <div class="product-action" lass="btn btn-default" >
                                            <span class="badge badge-danger">Out of stock</span>
                                        </div>
                                    </div>

                 
                                </div><!--END product-image-->

                                <!-- Content -->
                                <div class="product-content">
                                    
                                    <div class="head" >
                                        <!-- Title-->
                                        <div class="top" style="height: 60px;">
                                            <h4 class="title">
                                                <a href="{{url('/shop')}}/@{{list.slug}}{{$refnourl}}"> 

                                                    {{--@{{list.name}}--}}
                                                    @{{list.groupname}} 

                                                </a>
                                            </h4>
                                        </div>
                                        
                                        <!-- Price & Ratting -->
                                        <div class="bottom" >
                                            
                                            <span class="price">

                                                $@{{list.cartdiscountedprice}}

                                                <span ng-if="list.cartdiscountedprice < list.cartprice" class="old">$@{{list.cartprice}}</span> 


                                            </span>

                                            <span class="ratting">
                                                <br>
                                                <span ng-bind-html="list.stars_string"></span>
                                            </span>

                                        </div><!--END bottom-->


                                       
                                        <!-- Product Action -->
                                        <div class="product-action text-center" ng-if="list.qty > 0">
                                            <br>

                                            {{--
                                            <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                                Add To Cart

                                            </button> --}}

                                            <a href="{{url('/shop')}}/@{{list.slug}}{{$refnourl}}" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  title="">
                                                Add To Cart
                                            </a>



                                            {{--<button type="button" ng-click="vm.GlobalBuyNow(list)" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  > 
                                                Buy Now
                                            </button> --}}

                                        </div>

                                        <div class="product-action"  ng-if="list.qty <=0">
                                            <span class="badge badge-danger">Out of stock</span>
                                        </div>


                                    </div><!--END head-->

                                    <div class="body">
                                       
                                        <div ng-bind-html="list.description"></div>

                                        <br>

                                        {{--
                                        <!-- Product Action -->
                                        <div class="product-action">
                                            <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(list)" > 
                                                <span class="fa fa-shopping-cart" ></span> 

                                            </button>
                                        </div><!--END product-action--> --}}

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
                    
                </div><!--end col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-sm-50 mb-xs-50-->



                <div class="col-xl-3 col-lg-4 col-12 order-1 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">


                    <div class="sidebar" style="margin-bottom: -30px;">
                        
                        <div class="sidebar-search"> 
                            
                            <input type="text" placeholder="Search Product" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}">
                            <input type="submit" ng-click="vm.SearchProducts()" value="search">
                            
                            {{--
                            <div class="row" >

                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="search here..."  ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}" >
                                  <div class="input-group-append">
                                    <button class="btn btn-default" style="background-color: #faaf54;" type="button"  ng-click="vm.SearchProducts()" >
                                        Search
                                    </button>
                                  </div>
                                </div>

                                
                            </div> --}}
                            <br><br>
                            <h4 class="sidebar-title">Categories</h4>
                            <br>

                        </div>

                    </div>

                    

                    <table style="" class="table"> 

                        <tbody>

                            <tr>
                                <td>
                                    <span class="col-md-12">

                                        <input style="cursor: pointer;" id="cat_all" type="radio" name="category" ng-model="vm.category" value="All"  ng-change="vm.SearchProducts()"  >
                                        
                                        <label style="cursor: pointer;" for="cat_all"> 
                                            ALL
                                        </label> 

                                    </span>
 
                                </td>
                            </tr>

                        
                            <tr ng-repeat="list in vm.msccategories">
                                <td>
                                    <span class="col-md-12" >

                                        <input style="cursor: pointer;" id="cat_@{{$index}}" type="radio" name="category" ng-model="vm.category" value="@{{list.pk_category}}"  ng-change="vm.SearchProducts()"  >
                                        
                                        <label style="cursor: pointer;" for="cat_@{{$index}}"> 
                                            @{{list.description}} 
                                        </label> 

                                    </span>
 
                                </td>
                            </tr>

                          

                        </tbody>


                    </table>

                </div><!--end col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15-->
                
   
            </div><!--END row-->

            


        </div><!--END container-->

    </div><!--END product-section -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">

        //obApi('track', 'Training Shop Page');

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



	


				    