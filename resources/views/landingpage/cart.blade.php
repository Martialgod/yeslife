@extends('landingpage.layouts.master')

@section('title', 'YesLife Cart&Checkout')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@endsection

@section('optional_styles')
    
    <script src="/cleavejs/cleave.min.js" type="text/javascript"></script>

    <script src="/customjs/CartCheckoutController.js?v={{time()}}" type="text/javascript"></script>

    {{--<script type="text/javascript" src="https://rallypay.com/v1/rallypay.js"></script>--}}

@endsection

    
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Checkout', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Checkout'
    ])



    <!-- Cart Section Start -->
    <div class="cart-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
       
        {{-- ng-cloak = hides angularjs initial template load --}}
        <div class="container" id="main-div" ng-app="app" ng-controller="CartCheckoutController as vm" ng-cloak>
           
            {{--
                determine if user is approving recurring order through checkout
                    //recurring = order trxno
            --}}
            @if( $recurring )

                <div class="alert alert-danger" ng-if="vm.mscproducts.length > 0" style="font-size: 12px; margin-top: -20px;">
                    This is a recurring transaction checkout process...
                </div>

                <input type="hidden" id="recurringtrxno" name="recurringtrxno" value="{{$recurring->trxno}}" >

            @endif
                    

            <div id="nodisplay-div" style="text-align: center;" hidden >

                {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

                <h3>Your cart is empty....</h3>
                <br>
                <a href="{{url('/shop')}}{{$refnourl}}" class="btn btn-round btn-lg"> 
                    Shop Now
                </a>
               
            </div>
          

            <!--start cart ng-if="vm.isoncart" -->
            <div class="row" id="cart-div" hidden >
               
                <div class="col-12">

                    <div ng-if="vm.mscproducts.length == 0" style="text-align: center;">
                        {{-- @{{vm.statusmsg}} --}}
                    </div>

 
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-30" >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class=""></th>
                                    <th class="pro-title">Item(s)</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Qty</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr ng-repeat="list in vm.mscproducts">

                                    <td class="pro-thumbnail">
                                        <a ng-href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}"> 
                                            <img style="width:75px;height: 70px;" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="">
                                        </a>
                                       
                                    </td>

                                    <td class="pro-title">
                                        <a ng-href="{{url('/shop/')}}/@{{list.slug}}{{$refnourl}}"> 
                                            @{{list.name}}
                                        </a>
                                        
                                    </td>

                                    <td class="pro-price">
                                        $@{{list.cartdiscountedprice}}
                                    </td>

                                    <td class="pro-quantity" >

                                        <div class="input-group mb-3">
                                            
                                            <div class="input-group-prepend" ng-click="vm.UpdateCart('minus', list)" style="cursor: pointer;">
                                                <img src="{{asset('/landingpage/assets/images/minus.png')}}" alt="">
                                            </div>
                                            
                                            <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" ame="qty" ng-model="list.selectedqty" string-to-number ng-change="vm.UpdateCart('', list)" ng-model-options="{debounce: 200}">
                                            
                                            <div class="input-group-append" ng-click="vm.UpdateCart('plus', list)" style="cursor: pointer;"> 
                                                <img src="{{asset('/landingpage/assets/images/plus.png')}}" alt="">
                                            </div>

                                        </div>


                                        {{--<input class="form-control" type="number" min="1" name="qty" ng-model="list.selectedqty" string-to-number ng-change="vm.UpdateCart(list)" ng-model-options="{debounce: 200}" >--}}
                                        
                                    </td>

                                    <td class="pro-subtotal">
                                        <span>$@{{list.totalamount}} </span>
                                    </td>
                                    
                                    <td class="pro-remove">
                                        <span ng-click="vm.RemoveFromCart(list)" style="cursor: pointer;">
                                            <i class="fa fa-trash-o"></i>
                                        </span>
                                    </td>

                                </tr>
                                
                            </tbody>
                        </table>
                    </div><!--END cart-table table-responsive mb-30-->


                    <div class="row" ng-if="vm.mscproducts.length > 0" >

                            <div class="col-lg-6 col-12 mb-5"  ng-if="vm.mscproducts.length > 0">
                                

                                <!-- Discount Coupon -->
                                <div class="discount-coupon">
                                    
                                    <h4>DISCOUNT COUPON CODE</h4>

                                    <form class="form-inline" method="post" ng-submit="vm.ApplyCoupon($event)">
                                        
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" class="form-control" id="coupon" name="coupon" placeholder="coupon code" ng-model="vm.couponcode" maxlength="255">
                                        </div>

                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="submit" class="" style="background-color: #ffffff;color:#222222;" value="Apply Code">
                                        </div>

                                    </form>

                                </div><!--END discount-coupon-->



                            </div><!--END col-lg-6 col-12 mb-5-->

                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-30 d-flex">
                            <div class="cart-summary">
                                
                                <div class="cart-summary-wrap">
                                    <h4>CART SUMMARY</h4>

                                    <p>Count <span> @{{vm.mscproducts.length}} Item(s) </span></p>
                                   
                                    <p>Partial Amount <span> $@{{vm.totalamount}} </span></p>

                                    {{--
                                        shipping cost here..
                                        <p>Shipping Cost <span>$00.00</span></p>
                                    --}}

                                    <span ng-if="vm.msccoupons.length >0 ">
                                        <p>Coupon(s) </p>
                                        <p ng-repeat="list in vm.msccoupons ">

                                            <i class="fa fa-trash-o text-danger" ng-click="vm.RemoveCoupons(list)" style="cursor: pointer;"></i>
                                            &nbsp;

                                            @{{list.code}}

                                            <span style="color:red" ng-if="list.type == 'Fixed'"> 
                                                - $@{{list.amount}} 
                                            </span>

                                            <span style="color:red" ng-if="list.type == 'Rated'"> 
                                                - @{{list.amount}}% 


                                        </p>
                                       
                                        <p>Sub Total <span> $@{{vm.totalamount - vm.totalcoupondiscount}} </span></p>
                                        {{--<p>Sub Total <span> $@{{vm.subtotal}} </span></p>--}}
                                        <p></p>

                                    </span>

                                    <p id="totaltax1">

                                        Sales Tax <span> $@{{vm.totaltax}} </span>
                                    </p>
                                    
                                    
                                    <h2 id="grandtotal1">
                                        Grand Total 
                                        <span id="totalnetamount1">
                                            $@{{vm.totalnetamount}}
                                        </span>
                                    </h2>

                                </div><!--END cart-summary-wrap-->

                                <div class="cart-summary-button">
                                    <button class="checkout-btn" ng-click="vm.ShowCheckout()">Checkout</button>
                                </div><!--END cart-summary-button-->

                            </div><!--END cart-summary-->
                        </div><!--END col-lg-6 col-12 mb-30 d-flex-->

                    </div><!--END row-->
                    
                </div><!--END col-12-->
            
            </div><!--END row-->
            <!--END cart -->

      
            <div class="row" id="divcheckout" hidden >

                @include('landingpage.checkout')
                
            </div>



        </div><!--END container-->
        
    </div><!-- Cart Section End -->
    <!-- Service Section Start -->
    

@endsection



@section('optional_scripts')

    <script src="/customjs/CartCheckoutJquery.js?v={{time()}}" type="text/javascript"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function(){
           if( isloggedin != 'no' ){

                /*$('#billing-form input').attr('readonly', true);
                $('#billing-form select').attr('disabled', true);
                $('#billingcantfindstate').attr('disabled', true);

                $('#intervalno').attr('disabled', false);
                $('#intervalunit').attr('disabled', false);
                $('#enddate').attr('readonly', false);*/

           }

        });

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



@section('rallyapikey')
    
    <script type="text/javascript">
        
        //Rally.setPublishableKey('pk_live_c15b10d1e39a990c2165080985f5b9b9');
        
        //Cleave.js html text formatter
        new Cleave('.credit-card-number', {
            creditCard: true,
            onCreditCardTypeChanged: function (type) {
                // update UI ...
                //console.log(type);
            }
        });

        //Cleave.js html text formatter
        new Cleave('.credit-card-expiry', {
           date: true,
           datePattern: ['m', 'Y'] //Y = 4 digit year
        });

    </script>

@endsection



    


                    