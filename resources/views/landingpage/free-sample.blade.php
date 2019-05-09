@extends('landingpage.layouts.master')

@section('title', 'YesLife FREE Sample!')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
	<script src="/customjs/FreeSampleController.js?v={{time()}}" type="text/javascript"></script>
    
@endsection

	
@section('content-body')


	{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <br><br>
                    <div class="page-banner">
                        <ul class="page-breadcrumb">
                            <li style="color:#3295c3;text-align: center;">

                                <h3>
                                    <span style="color:#8a8c8e;">ORDER</span> 
                                    <span style="color:#3a95c2;">YES.LIFE</span> 
                                    <span style="color:#8a8c8e;">TODAY!</span>
                                </h3>

                                <h1 style="color:#3a95c2;">
                                    GET YOUR 
                                    <span style="color:#fbb055;"> FREE SAMPLE </span>
                                    TODAY! 
                                </h1>

                                <h3 style="color:#8a8c8e;">
                                    YOU JUST PAY ${{$products->shippingcost}} FOR SHIPPING
                                </h3>

                            </li>
                        </ul>
                    </div><!--END page-banner-->
                    
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- Page Banner Section End -->



    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div"  ng-app="app" ng-controller="FreeSampleController as vm" ng-cloak>
       
        <div class="container">
            
            <div class="row">


                <!-- Contact Info Start -->
                <div class="col-md-6">

                    {{--<span class="text-center">
                        <img style="" src="{{asset('/storagelink/'.$products->pictxa)}}"alt="">
                    </span>
                    

                    <br><br> --}}

                    {!! $products->description !!}

                </div><!-- Contact Info End -->
                
                <!-- Contact Form Start -->
                <div class="col-md-6">

                    <!-- Checkout Form-->
                    <form id="form-checkout" class="jqvalidate-form checkout-form"  method="POST" action="#" >

                        {{method_field('POST')}}
                        {{ csrf_field() }}

                        <div class="row">

                            <!--start address-->
                            <div class="col-md-12">

                                <input type="hidden" class="form-control" id="productid" name="productid" placeholder=""  maxlength="255" readonly="" value="{{$products->pk_products}}">

                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-10">
                                    
                                    <h4 class="checkout-title">
                                      BILLING ADDRESS
                                     
                                    </h4>

                                    <div class="row">

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>First Name*</label>
                                           <input type="text" class="form-control" id="billingfname" name="billingfname" placeholder="Firstname" required="" maxlength="255" value="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>Last Name*</label>
                                           <input type="text" class="form-control" id="billinglname" name="billinglname" placeholder="Lastname" required="" maxlength="255" value="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>Email Address*</label>
                                           <input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="Email" required="" maxlength="255" value="" >
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>Phone no*</label>
                                           <input type="text" class="form-control" id="billingphone" name="billingphone" placeholder="Phone" required="" maxlength="255" value="">
                                        </div>


                                        <div class="col-md-6 col-12 mb-20">

                                           <label style="padding-bottom: 6px;">Country*</label>

                                           <select name="billingcountry" id="billingcountry" class="form-control" required=""> 
                                                @foreach($country as $key => $v)
                                                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == 229) ? 'selected' :'' }}> 
                                                        {{$v->name}} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><!--END col-md-6 col-12 mb-20-->

                                        <div class="col-md-6 col-12 mb-20">
                                            
                                            <label>
                                                <input type="checkbox" class="" id="billingcantfindstate" name="billingcantfindstate">
                                                Can't find State?*
                                            </label>

                                            <div id="billingstatesdropdowndiv">

                                                <select name="billingstatesdropdown" id="billingstatesdropdown" class="form-control" >
                                            
                                                    @foreach($states as $key => $v)
                                                        <option value="{{$v->name}}" > 
                                                            {{$v->name}} 
                                                        </option>
                                                    @endforeach
                                                
                                                  
                                                </select>

                                            </div>

                                            <div id="billingstatescustomdiv" hidden>
                                                <input type="text" class="form-control" id="billingstatescustom" name="billingstatescustom" placeholder="enter manually" value="" maxlength="255" required="">
                                            </div>

                                        </div><!--END col-md-6 col-12 mb-20-->

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>City*</label>
                                           <input type="text" class="form-control" id="billingcity" name="billingcity" placeholder="City" value="" maxlength="255" required="">
                                        </div><!--END col-md-6 col-12 mb-20-->

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>Zip Code *</label>
                                           <input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="Zip Code" value="" maxlength="50" required="">
                                        </div><!--END col-md-6 col-12 mb-20-->


                                        <div class="col-12 mb-20">
                                           <label>Address Line 1*</label>
                                           <input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="" maxlength="500" required="">
                                           <input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="" maxlength="500">
                                        </div><!--END col-md-6 col-12 mb-20-->

                                       
                                        <div class="col-12 mb-20">
                                            <h4>Card Details</h4>
                                            <br>
                                            <label>Card Number *</label>
                                            <input style="color:#666;" type="text" id="rally_cardNumber" placeholder="XX-XXXX-XXXX-XX" data-input="rally_cardNumber" value="">
                                            <span id="errrally_cardNumber" style="color:red; font-size: 12px;"> </span>
                                        </div>

                                        <div class="row col-12 mb-20">
                                            <div class="col-md-6 col-12 mb-20">
                                              <label style="">Expiry Date*</label>
                                              <input style="" type="text" id="rally_expDate" placeholder="MM/YYYY" data-input="rally_expDate" maxlength="7" value="">
                                              <span id="errrally_expDate" style="color:red; font-size: 12px;"> </span>
                                            </div>

                                          <div class="col-md-6 col-12 mb-20">
                                              <label style="">CVC*</label>
                                              <input style=" type="text" id="rally_cvc" placeholder="XXX" data-input="rally_cvc" maxlength="4" value="">
                                              <span id="errrally_cvc" style="color:red; font-size: 12px;"> </span>
                                          </div>

                                        </div>


                                        @if(!Auth::check())

                                          <div class="col-12 mb-20">

                                            <div class="check-box">
                                               <input type="checkbox" id="isnewaccount" name="isnewaccount" >
                                               <label for="isnewaccount">Create an Acount?</label>
                                            </div>


                                            <div id="isnewaccountdiv" hidden>

                                                <span style="font-size: 12px; color:red">
                                                    <br>
                                                    By default your username will be your email. You can just changed it later.
                                                </span>
                                       
                                                <div id="divbillingpassword" class="form-group">
                                                    <label for="billingpassword">Password<span class="error">*</span> </label>
                                                    <input type="password" class="form-control" id="billingpassword" name="billingpassword" placeholder="" required="" maxlength="255" value="">
                                                    
                                                </div>

                                                <div id="divbillingrepeatpassword" class="form-group">
                                                    
                                                    <label for="billingrepeatpassword">Repeat Password<span class="error">*</span> </label>
                                                    <input type="password" class="form-control" id="billingrepeatpassword" name="billingrepeatpassword" placeholder="" required="" maxlength="255" value="">
                                                    
                                                    
                                                </div>
                                    
                                            </div><!--END isnewaccountdiv-->

                                          </div><!--END col-12 mb-20-->

                                        @endif


                                        <div class="col-12 mb-20">
                                          <div class="check-box">
                                             <input type="checkbox" id="shiptodifferentaddress" name="shiptodifferentaddress" >
                                             <label for="shiptodifferentaddress">Ship to Different Address?</label>
                                          </div>
                                        </div>

                                    </div><!--END row-->

                                </div><!--END billing-form-->

                                <!-- Shipping Address -->
                                <div hidden id="divshippingaddress">
                                   
                                   <h4 class="checkout-title">Shipping Address</h4>

                                    <div class="row">

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>First Name*</label>
                                           <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="Firstname" required="" maxlength="255" value="">
                                        </div>

                                       <div class="col-md-6 col-12 mb-20">
                                           <label>Last Name*</label>
                                           <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="Lastname" required="" maxlength="255" value="">
                                       </div>


                                        <div class="col-12 mb-20">
                                           <label>Phone no*</label>
                                           <input type="text" class="form-control" id="shippingphone" name="shippingphone" placeholder="Phone" required="" maxlength="255" value="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           <label style="padding-bottom: 6px;">Country*</label>
                                           <select name="shippingcountry" id="shippingcountry" class="form-control" required="" >
                                                @foreach($country as $key => $v)
                                                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == 229 ) ? 'selected' :'' }}> 
                                                        {{$v->name}} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                            
                                            <label>
                                                <input type="checkbox" class="" id="shippingcantfindstate" name="shippingcantfindstate">
                                                Can't find State?*
                                            </label>

                                            <div id="shippingstatesdropdowndiv" >
                                                <select name="shippingstatesdropdown" id="shippingstatesdropdown" class="form-control" >
                                            
                                                    @foreach($states as $key => $v)
                                                        <option value="{{$v->name}}"> 
                                                            {{$v->name}} 
                                                        </option>
                                                    @endforeach
                                                
                                                  
                                                </select>
                                            </div>

                                            <div id="shippingstatescustomdiv" hidden>
                                                <input type="text" class="form-control" id="shippingstatescustom" name="shippingstatescustom" placeholder="enter manually" value="" maxlength="255" required="">
                                            </div>

                                       </div>


                                        <div class="col-md-6 col-12 mb-20">
                                           <label>City*</label>
                                           <input type="text" class="form-control" id="shippingcity" name="shippingcity" placeholder="City" value="" maxlength="255" required="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           <label>Zip Code *</label>
                                           <input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="Zip Code" value="" maxlength="50" required="">
                                        </div>



                                        <div class="col-12 mb-20">
                                           <label>Address Line 1*</label>
                                           <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="" maxlength="500" required="">
                                           <input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="" maxlength="500">
                                        </div>

                                    </div><!--END row-->

                                </div><!--END divshippingaddress-->

                                <button type="submit" id="paymentSubmit" class="place-order btn btn-lg btn-round">Submit</button>

                            </div><!--END col-md-12-->
                            <!--END address-->


                        </div><!--END row row-->

                    </form><!--END form-checkout-->


                </div><!-- Contact Form End -->
                
            </div><!--END row-->
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')
    

    <script src="/customjs/CartCheckoutJquery.js?v={{time()}}" type="text/javascript"></script>
    
	    
    <script type="text/javascript">
        //broadcast toastr
        $(document).ready(function(){

           $('#subscription-div').prop('hidden', true);
           $('#div-main-services').prop('hidden', true);
           $('#div-free-services').prop('hidden', false);
        });


    </script>
    

@endsection