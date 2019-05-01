@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop Business Partners')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
    <script src="/customjs/ShopBusinessPartnersController.js?v={{time()}}" type="text/javascript"></script>
    

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Shop', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Shop For Business'
    ])


    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div" ng-app="app" ng-controller="ShopBusinessPartnersController as vm" >
        
        <div class="container" ng-cloak> {{-- ng-cloak = hides angularjs initial template load --}}

            <div class="row">

                <div class="col-xl-9 col-lg-8 col-12 order-2 order-lg-2 mb-sm-50 mb-xs-50">

                    <!-- Shop Toolbar Start -->
                    <div class="row" id="div-toolbar" >
                        <div class="col">
                            <div class="shop-toolbar">

                                <div class="product-showing mr-auto" ng-if="vm.mscproducts.length > 0" >
                                    <p>
                                        Showing @{{vm.meta.current_page}} of @{{vm.meta.last_page}}
                                    </p>
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


                        <div class="cart-table table-responsive mb-30" >
        
                            <table class="table">

                                <thead class="">

                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        {{--<th></th>--}}
                                        <th></th>
                                    </tr>

                                </thead>

                   

                                <tbody> 

                                    <tr ng-repeat="list in vm.mscproducts">

                                        <td class="pro-thumbnail">

                                            <a ng-href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}"> 
                                                <img style="width:75px;height: 70px;"  ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="">
                                            </a>
                                           
                                        </td>
                                        
                                        <td>

                                            <a ng-href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}"> 
                                                @{{list.name}}
                                            </a>
                                           
                                        </td>

                                        <td>
                                            $@{{list.cartdiscountedprice}}
                                        </td>


                                        <td class="pro-quantity" >

                                            <div class="input-group mb-3">
                                                
                                                <div class="input-group-prepend" ng-click="vm.UpdateCart('minus', list)" style="cursor: pointer;">
                                                    <img src="{{asset('/landingpage/assets/images/minus.png')}}" alt="">
                                                </div>
                                                
                                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" ame="qty" ng-model="list.selectedqty" string-to-number ng-change="vm.UpdateCart('', list)" ng-model-options="{debounce: 500}">
                                                
                                                <div class="input-group-append" ng-click="vm.UpdateCart('plus', list)" style="cursor: pointer;"> 
                                                    <img src="{{asset('/landingpage/assets/images/plus.png')}}" alt="">
                                                </div>

                                            </div>

                                            
                                        </td>

                                        <td>
                                            $@{{list.netamount}}
                                        </td>


                                        {{--<td>

                                            <button id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default btn-sm" ng-click="vm.AddToCart(list)" ng-disabled="list.selectedqty == 0" > 

                                                Add

                                            </button> 

                                        </td> --}}


                                        <td>

                                            
                                            <button id="" style="background-color: #ffffff;color:#af2424; margin-bottom: 10px;" class="btn btn-danger btn-sm" ng-click="vm.RemoveFromCart(list)" ng-disabled="list.netamount == 0" > 

                                                Remove

                                            </button> 



                                        </td>


                                    </tr>

                                    <tr>
                                        
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td>
                                            <b>$@{{vm.totalnetamount}}</b>
                                        </td>
                                        {{--<td></td>--}}
                                        <td>
                                            <button id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default btn" ng-click="vm.BulkUpdate()" > 

                                                Update Cart

                                            </button> 
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div><!--END cart-table table-responsive mb-30-->

                        

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



	


				    