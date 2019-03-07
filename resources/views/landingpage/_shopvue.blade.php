@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Shop', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Shop'
    ])


    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div" >
        
        <div class="container">
            
            {{--
            <div class="row">

                <div class="form-group col-md-12">

                    <input type="text" placeholder="search here..." class="form-control" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}"  >
                  
                </div>
                
            </div>--}}


            <div class="search">
                <form class="search-form" v-on:submit.prevent="SearchProducts()">
                    <input type="text" placeholder="search here..." class="" v-model="search"  >
                    <input type="submit" value="Search">
                </form>
            </div><br/>

    

            <!-- Shop Toolbar Start -->
            <div class="row">
                <div class="col">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <button class="grid active" data-mode="grid"><span>grid</span></button>
                            <button class="list" data-mode="list"><span>list</span></button>
                        </div>
                        <div class="product-showing mr-auto" v-if="mscproducts.length > 0" >
                            <p>Showing @{{meta.current_page}} of @{{meta.last_page}}</p>
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


            <div class="shop-product-wrap grid row">

                <!-- Product Item Start -->
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-30"  v-for="list in mscproducts">
                    
                    <div class="product-item">
                        
                        <!-- Image -->
                        <div class="product-image">
                            <!-- Image -->
                            <a v-bind:href="/shop/+list.slug"> 
                                <img style="" v-bind:src="/storagelink/ + list.pictxa" alt="">
                            </a>


                            <input type="hidden" name="productid" v-model="list.productid">
                            <input type="hidden" name="productname" v-model="list.name">
                            <input type="hidden" name="qty" v-model="list.selectedqty" >


                            <!-- Product Action -->
                            <div class="product-action" v-if="list.qty > 0">
                                <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" v-on:click="AddToCart(list)" > 
                                    <span class="fa fa-shopping-cart" ></span> 

                                </button>
                            </div>

                            <div class="product-action" v-if="list.qty <=0">
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
                                        <a v-bind:href="/shop/+list.slug"> 
                                            @{{list.name}} 
                                        </a>
                                    </h4>
                                </div>
                                
                                <!-- Price & Ratting -->
                                <div class="bottom">
                                    
                                    <span class="price">
                                        @{{list.cartdiscountedprice}}
                                        <span v-if="list.cartdiscountedprice < list.cartprice" class="old">@{{list.cartprice}}</span>
                                    </span>


                                    
                                    <span class="ratting">
                                        <span v-html="list.stars_string"></span>
                                    </span>

                                </div><!--END bottom-->

                            </div><!--END head-->

                            <div class="body">
                               
                                <div v-html="list.description"></div>

                                <br>

                                <!-- Product Action -->
                                <div class="product-action">
                                    <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default" v-on:click="AddToCart(list)" > 
                                        <span class="fa fa-shopping-cart" ></span> 

                                    </button>
                                </div><!--END product-action-->

                            </div><!--END body-->

                        </div><!--END product-content-->
                    
                    </div><!--END product-item-->
                
                </div><!-- col-xl-3 col-lg-4 col-sm-6 col-12 mb-30 -->


            </div><!--END shop-product-wrap grid row-->


            <div class="row mt-20" style="" v-if="mscproducts.length>0">
                
                <div class="col">

                    <ul class="page-pagination">
                        
                        <li>
                            <button class="btn btn-default btn-sm custom-default-btn" v-bind:disabled="!navlinks.prev" v-on:click="LoadProducts(navlinks.prev)">
                                <i class="fa fa-angle-left"></i>
                                Back
                            </button>
                        </li>

                        <li>..</li>

                        <li>
                            <button class="btn btn-default btn-sm custom-default-btn" v-bind:disabled="!navlinks.next" v-on:click="LoadProducts(navlinks.next)">
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

	
    <script src="/vuejs/vue.min.js" type="text/javascript"></script>
    <script src="/vuejs/lodash.min.js" type="text/javascript"></script>
    <script src="/vuejs/axios.min.js" type="text/javascript"></script>


    <script type="text/javascript">      
        
        //laravel token session
        window.csrf_token = "{{ csrf_token() }}"

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': window.csrf_token
        };

    </script>


    <script src="/customjs/_ShopVue.js?v={{time()}}" type="text/javascript"></script>


@endsection



	


				    