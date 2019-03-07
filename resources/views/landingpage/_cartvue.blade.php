@extends('landingpage.layouts.master')

@section('title', 'YesLife Cart&Checkout')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    
@endsection

    
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Cart & Checkout', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Cart & Checkout'
    ])



    <!-- Cart Section Start -->
    <div class="cart-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
       
        <div class="container" id="main-div" >
           
            {{--
                determine if user is approving recurring order through checkout
                    //recurring = order trxno
            --}}
            @if( $recurring )

                <div class="alert alert-danger" v-if="mscproducts.length > 0" style="font-size: 12px; margin-top: -20px;">
                    This is a recurring transaction checkout process...
                </div>

                <input type="hidden" id="recurringtrxno" name="recurringtrxno" value="{{$recurring->trxno}}" >

            @endif
                    
          

            <!--start cart -->
            <div class="row" v-if="isoncart">
               
                <div class="col-12">

                    <div v-if="mscproducts.length == 0" style="text-align: center;">
                        @{{statusmsg}}
                    </div>

                   
                  
                    <div style="text-align: center;" v-if="mscproducts.length == 0 && statusmsg ==''" >

                        <h3>Nothing to display....</h3>
                        <br>
                        <a href="{{url('/')}}" class="btn btn-round btn-lg"> 
                            Go Back
                        </a>
                       
                    </div>

 
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-30" v-if="mscproducts.length > 0">
                        <table class="table">
                            <thead>
                                <tr>
                                    {{--<th class="pro-thumbnail">Image</th> --}}
                                    <th class="pro-title">Item(s)</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Qty</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="list in mscproducts">

                                    <td class="pro-title">
                                        @{{list.name}}
                                    </td>

                                    <td class="pro-price">
                                        $@{{list.cartdiscountedprice}}
                                    </td>

                                    <td class="pro-quantity" >

                                        <div class="input-group mb-3">
                                            
                                            <div class="input-group-prepend" v-on:click="UpdateCart('minus', list)" style="cursor: pointer;">
                                                <img src="{{asset('/landingpage/assets/images/minus.png')}}" alt="">
                                            </div>
                                            
                                            <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" ame="qty" v-model="list.selectedqty" v-on:change="UpdateCart('', list)" >
                                            
                                            <div class="input-group-append" v-on:click="UpdateCart('plus', list)" style="cursor: pointer;"> 
                                                <img src="{{asset('/landingpage/assets/images/plus.png')}}" alt="">
                                            </div>

                                        </div>

                                        
                                    </td>

                                    <td class="pro-subtotal">
                                        <span>$@{{list.totalamount}} </span>
                                    </td>
                                    
                                    <td class="pro-remove">
                                        <span v-on:click="RemoveFromCart(list)" style="cursor: pointer;">
                                            <i class="fa fa-trash-o"></i>
                                        </span>
                                    </td>

                                </tr>
                                
                            </tbody>
                        </table>
                    </div><!--END cart-table table-responsive mb-30-->


                    <div class="row" v-if="mscproducts.length > 0" >

                            <div class="col-lg-6 col-12 mb-5"  v-if="mscproducts.length > 0">
                                

                                <!-- Discount Coupon -->
                                <div class="discount-coupon">
                                    
                                    <h4>Discount Coupon Code</h4>

                                    <form class="form-inline" method="post" v-on:submit.prevent="ApplyCoupon()">
                                        
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" class="form-control" id="coupon" name="coupon" placeholder="coupon code" v-model="couponcode" maxlength="255">
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
                                    <h4>Cart Summary</h4>

                                    <p>Count <span> @{{mscproducts.length}} Item(s) </span></p>
                                   
                                    <p>Sub Total <span> $@{{totalamount}} </span></p>

                                    {{--
                                        shipping cost here..
                                        <p>Shipping Cost <span>$00.00</span></p>
                                    --}}

                                    <span v-if="msccoupons.length >0 ">
                                        <p>Coupon(s) </p>
                                        <p v-for="list in msccoupons ">

                                            <i class="fa fa-trash-o text-danger" v-on:click="RemoveCoupons(list)" style="cursor: pointer;"></i>
                                            &nbsp;

                                            @{{list.code}}

                                            <span style="color:red" v-if="list.type == 'Fixed'"> 
                                                - $@{{list.amount}} 
                                            </span>

                                            <span style="color:red" v-if="list.type == 'Rated'"> 
                                                - @{{list.amount}}% 

                                            </span>

                                        </p>
                                    </span>
                                    
                                    
                                    <h2>Grand Total <span>$@{{totalnetamount}}</span></h2>

                                </div><!--END cart-summary-wrap-->

                                <div class="cart-summary-button">
                                    <button class="checkout-btn" v-on:click="ShowCheckout()">Checkout</button>
                                </div><!--END cart-summary-button-->

                            </div><!--END cart-summary-->
                        </div><!--END col-lg-6 col-12 mb-30 d-flex-->

                    </div><!--END row-->
                    
                </div><!--END col-12-->
            
            </div><!--END row-->
            <!--END cart -->

      
            <div  class="row" id="divcheckout" >

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

                $('#billing-form input').attr('readonly', true);
                $('#billing-form select').attr('disabled', true);
                $('#billingcantfindstate').attr('disabled', true);

                $('#intervalno').attr('disabled', false);
                $('#intervalunit').attr('disabled', false);
                $('#enddate').attr('readonly', false);

           }

        });

    </script>


  
   
@endsection



@section('rallyapikey')
    
    <script type="text/javascript">
        //Rally.setPublishableKey('pk_live_c15b10d1e39a990c2165080985f5b9b9');
    </script>

    <script src="/vuejs/vue.js" type="text/javascript"></script>
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


    <script src="/customjs/_CartCheckoutVue.js?v={{time()}}" type="text/javascript"></script>



@endsection



    


                    