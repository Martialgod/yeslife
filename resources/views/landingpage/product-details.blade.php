@extends('landingpage.layouts.master')

@section('title',$products->name.' | Yes.Life')

@section('meta')

    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{$products->metadata}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')

	
    <script src="/customjs/ProductDetailsController.js?v={{time()}}" type="text/javascript"></script>

@endsection

	
@section('content-body')

	
    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Product Details', 
      'bannerurl'=> '/shop',
      'bannerback'=> 'Shop',
      'bannercontent'=> 'Product Details'
    ])
  

    <!-- Page Banner Section Start -->
    {{--<div class="page-banner-section section banner100px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h2 style="color:#3295c3; font-size: 42px;"> Product Details </h2>
                        <ul class="page-breadcrumb">
                            <li style="color:#3295c3;">
                                <a href="/{{$refnourl}}">Home</a>
                            </li>
                            <li style="color:#3295c3;"><b> Product Details </b></li>
                        </ul>
                    </div><!--END page-banner-->
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!--END page-banner-section section--> --}}


    <!-- Product Section Start -->
    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div" ng-app="app" ng-controller="ProductDetailsController as vm" >
        
        <div class="container" ng-cloak>
            
            <div class="row">

                <input type="hidden" id="productid" name="productid" value="{{$products->pk_products}}">
                <input type="hidden" id="productgroup" name="productgroup" value="{{$products->fk_productgroup}}">


                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-sm-50 mb-xs-50">

                	@include('admin.layouts.alert')

                    <div class="product-details mb-50">


                        <!-- Image -->
                        {{--product-image mb-xs-20--}}
                        <div class="product-image bottom-thumbnail mb-xs-20">
                            <!-- Image -->
                            {{--product-slider single-product-slider--}}
                            <div class="product-slider single-product-slider-syn">

                                {{--<div class="item">
                                	<img style="" ng-src="{{asset('/storagelink')}}/@{{vm.currentproduct.pictxa}}" alt="">
                                </div>--}}

                                @foreach($gallery as $v)
                                    <div class="item">
                                        <img style="" ng-src="{{asset('/storagelink/'.$v)}}" alt="">
                                    </div>
                                @endforeach


                            </div><!--END product-slider-->

                            @if(count($gallery)>1)

                                <div class="product-slider single-product-thumb-slider-syn ">

                                        @foreach($gallery as $v)

                                            <div class="item" style="height: 110px;">
                                                <img style="" height="100%" width="100%" ng-src="{{asset('/storagelink/'.$v)}}" alt="">
                                            </div>

                                        @endforeach

                                        <div class="item"></div>

                                </div><!--END product-slider-->

                            @endif

                          

                        </div><!--END product-image mb-xs-20-->

                        <!-- Content -->
                        <div class="product-content">
                            
                            <div class="product-content-inner">
                                
                                <div class="head">

                                    <!-- Title-->
                                    <div class="top">  
                                        {{--business shop case of 12--}}
                                        @if( $products->fk_productgroup == 1 )
                                            <h1 class="title">@{{vm.currentproduct.name}} </h1>
                                        @else
                                            <h1 class="title">@{{vm.currentproduct.groupname}}</h1>
                                        @endif
                                        
                                    </div>


                                       
                                    <!-- Price & Ratting -->
                                    <div class="bottom" >
                                        
                                        <!--<span class="ratting">
                                            <span ng-bind-html="vm.currentproduct.stars_string"> </span>
                                            
                                            {{--totalreviews--}}
                                            <span ng-if="vm.mscreviews.length > 0"> 
                                                &nbsp; (@{{vm.mscreviews.length}} Reviews)
                                            </span> 

                                            <span ng-if="vm.mscreviews.length == 0"> (Be the first to review this product) </span> 
                                        </span> -->

                                    </div><!--END bottom-->

                                    <div class="bottom">

                                        <span class="price">
                                            <b>
                                                $@{{vm.currentproduct.cartdiscountedprice}}
                                                <span ng-if="vm.currentproduct.cartdiscountedprice < vm.currentproduct.cartprice" class="old">$@{{vm.currentproduct.cartprice}}</span> 
                                            </b>
                                        </span>

                                    </div>

                                </div>

                                <div class="body">

                                    <hr style="border-color:#fbb055; border-width: 3px;">

                                    {{--business shop case of 12--}}
                                    @if( $products->fk_productgroup == 1 )
                                        <div ng-bind-html="vm.currentproduct.description"></div>
                                    @else
                                        <div ng-bind-html="vm.currentproduct.groupdesc"></div>
                                        <div ng-bind-html="vm.currentproduct.groupdesc2"></div>
                                    @endif

                                    <hr style="border-color:#fbb055; border-width: 3px;">

                                    @if( count($flavors) > 0 )

                                        <div class="product-short">
                                            <b>Flavor </b> &nbsp;&nbsp;
                                            <select id="shop_flavor" class="form-control col-md-6" ng-model="vm.selectedflavor" ng-change="vm.ShowProduct(vm.selectedflavor)"  >
                                                <option value="" disabled="" selected >
                                                    Select Flavor
                                                </option>
                                                <option ng-repeat="vf in vm.mscflavors" value="@{{vf.pk_products}}" >
                                                    @{{vf.flavor}}
                                                </option>
                                            </select>
                                        </div><!--END product-short-->
                                        

                                    @endif

         
                                    <br>
                                    <!-- Product Action -->
                                    <div class="product-action " ng-if="vm.currentproduct.qty > 0">
                                        
                                        <button type="submit" id="" style="background-color:#feeeda;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-click="vm.AddToCart(vm.currentproduct)" ng-disabled="vm.selectedflavor == null" > 
                                            ADD TO CART

                                        </button>


                                        <button type="button" ng-click="vm.GlobalBuyNow(vm.currentproduct)" style="background-color:#feeeda;color:#222222; margin-bottom: 10px;" class="btn btn-default" ng-disabled="vm.selectedflavor == null" > 
                                            BUY NOW
                                        </button>
                                       


                                    </div>

                                    <div class="product-action"  ng-if="vm.currentproduct.qty <=0">
                                        <span class="badge badge-danger">Out of stock</span>
                                    </div>


                                </div><!--END body-->

                            </div><!--END product-content-inner-->

                        </div><!--END product-content-->

                    </div><!--END product-details mb-50-->
                    
                    <ul class="product-details-tab-list nav">
                        
                        <li>
                        	<a class="active" data-toggle="tab" href="#description">
                        		<strong> Product Description </strong>
                        	</a>
                        </li>


                        <!--<li>
                        	<a data-toggle="tab" href="#reviews">
                        		{{--Reviews (<span id="totalreviewcount">@{{vm.totalreviews}}</span>)--}}
                                Reviews (<span id="totalreviewcount">@{{vm.mscreviews.length}})

                        	</a>
                        </li> -->

                    </ul><!--END product-details-tab-list nav-->

                    <div class="product-details-tab-content tab-content">
                        
                        <div class="tab-pane active" id="description">

                            {{--business shop case of 12--}}
                            @if( $products->fk_productgroup == 1 )
                                <div ng-bind-html="vm.currentproduct.description"></div>
                            @else
                                <div ng-bind-html="vm.currentproduct.groupdesc3"></div>
                            @endif

                        
                        </div><!--END description-->


                        {{--<div class="tab-pane " id="reviews">
                            
                            <div class="review-list" ng-repeat="list in vm.mscreviews">

                  
                            		<div class="review">
	                                    <h4 class="name"> 
	                                    	@{{list.fullname}}
	                                    	<span> 
	                                    		@{{list.created_at_formatted}}

	                                    	</span>
	                                    </h4>
	                                    <div class="ratting">
	                                    	<span ng-bind-html="list.stars_string"></span>
	                                    </div>
	                                    <div class="desc">
	                                        <span ng-bind-html="list.comments"></span>
	                                    </div>
	                                </div>



                              
                            </div><!--END review-list-->


                        	<div class="row mt-20" style="" ng-if="vm.mscreviews.length>0">
                
				                <div class="col">

				                    <ul class="page-pagination">
				                        
				                        <li>
				                            <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.prev" ng-click="vm.LoadReviews(vm.navlinks.prev)">
				                                <i class="fa fa-angle-left"></i>
				                                Back
				                            </button>
				                        </li>

				                        <li>..</li>

				                        <li>
				                            <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.next" ng-click="vm.LoadReviews(vm.navlinks.next)">
				                                <i class="fa fa-angle-right"></i>
				                                Next
				                            </button>
				                        </li>

				                    </ul><!--END page-pagination-->

				                </div><!--END col-->

				            </div><!--END row mt-20-->

						    <br><br>

                            <div class="review-form">

					        	@if(Auth::check())

					        		<h3>Give your Review:</h3>

									<form method="POST" id="form-reviews" ng-submit="vm.PostReviews($event)" class="jqvalidate-form">

									    {{method_field('POST')}}
								        {{ csrf_field() }}


	                                    <div class="row row-10">
	                                        
	                                        <div class="col-md-6 col-12 mb-20">
	                                        	<input type="text" id="fullname" name="fullname"  placeholder="Name" value="{{Auth::user()->fullname}}" readonly="" required="">
	                                        </div>

	                                        <div class="col-md-6 col-12 mb-20">
	                                        	<input type="email" id="email" name="emai" placeholder="Email" value="{{Auth::user()->email}}" readonly="" required="">
	                                        </div>

	                                        <div class="col-12 mb-20">
	                                        	<textarea placeholder="Review" id="comments" name="comments" required=""></textarea>
	                                        </div>

	                                        <div class="col-md-6 col-12 mb-20">
	                                        	<select name="star" id="star" class="form-control" required="">
											    	<option value="5"> 5 Stars </option>
											    	<option value="4"> 4 Stars </option>
											    	<option value="3"> 3 Stars </option>
											    	<option value="2"> 2 Stars </option>
											    	<option value="1"> 1 Star </option>
											    </select>
	                                        </div>

	                                        <div class="col-md-6 col-12 mb-20 " style="float-right">
	                                        	<div class="ratting" id="reviewstars">
			                                        <i class="fa fa-star-o"></i>
			                                        <i class="fa fa-star-o"></i>
			                                        <i class="fa fa-star-o"></i>
			                                        <i class="fa fa-star-o"></i>
			                                        <i class="fa fa-star-o"></i>
			                                    </div>
	                                        </div>

	                                        <div class="col-md-6 col-12 mb-20 " style="float-right">
	                                        	<input type="submit" value="Submit">
	                                        </div>



	                                    </div><!--END row row-10-->
	                                    

							    	</form>


					        	@endif

                            </div><!--END review-form-->
                            
                        </div><!--END tab-pane--> --}}

                    </div><!--END product-details-tab-content tab-content-->

                    
                </div>
                <!--END col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-sm-50 mb-xs-50-->
 

                <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">

                    <div class="sidebar">
                        
                        <div class="sidebar-search">
                        
                            <input type="text" placeholder="Search Product" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}">
                            <input type="submit" ng-click="vm.SearchProducts()" value="search">

                            <br><br>

                            <h4 class="sidebar-title">Search Results</h4>

                            <table class="table">

                                {{--hidden when angular search is activated--}}
                                <tbody id="searchresultbody">

                                    @foreach( $defaultproducts as $key => $v )
                                        <tr>
                                            <td>

                                                {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

                                                <a href="{{url('/shop/'.$v->slug)}}{{$refnourl}}" title="">

                                                    {{--$v->name--}}
                                                    {{$v->groupname}}

                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    
                                </tbody>
                            	

                            	<tbody >

                            		<tr ng-repeat="list in vm.mscproducts">
                            			<td>
                                            {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
                            				<a href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}" title="">
                            					
                                                {{--@{{list.name}}--}}

                                                @{{list.groupname}}

                            				</a>
                            			</td>
                            		</tr>

                            	</tbody>

                            </table>
                            
                        </div>
                    </div>


                </div><!--END col-xl-3 col-lg-4 col-12 order-2-->

            </div><!--END row-->

        </div><!--END container-->

    </div><!-- Product Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">


		$(document).on('change','#star',function(){
		  
		 	let stars = $(this).val(); 
		 	let temp = '';
		 	for(var i =1; i<=stars; i++){
		 		temp= temp + '<i class="fa fa-star-o"></i>';
		 	}

		 	$('#reviewstars').html(temp); 



		});//END #billingcantfindstate on change
		
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


	


				    