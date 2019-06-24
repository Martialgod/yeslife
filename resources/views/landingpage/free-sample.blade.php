@extends('landingpage.layouts.master')

@section('title', 'Free CBD Samples | CBD oil & Pain Relief Lotion | Yes.Life')

@section('meta')

    <meta name="robots" content="follow, index" />
    <meta name="description" content="Yes.Life is offering free CBD samples. For a limited time get our free cbd sample pack that includes both our high-absorbing cbd oil and Relieve Hemp CBD gel that works great for pain relief!">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')

  <script src="/cleavejs/cleave.min.js" type="text/javascript"></script>
    
  <script src="/customjs/FreeSampleController.js?v={{time()}}" type="text/javascript"></script>
    
@endsection

  
@section('content-body')


   {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}


    {{--
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section"  style="height: 350px;">
        <div class="container" >
            <div class="row" >


                <div class="col">

                    <div class="page-banner">
                        <ul class="page-breadcrumb">

                            <li style="color:#3295c3;text-align: center;">
                                
                                <h3>
                                    <span style="color:#8a8c8e;">ORDER</span> 
                                    <span style="color:#3a95c2;">YES.LIFE</span> 
                                    <span style="color:#8a8c8e;">TODAY!</span>
                                </h3> 

                                <h2 style="color:#3a95c2;">
                                    GET YOUR 
                                    <span style="color:#fbb055;"> FREE SAMPLE </span>
                                    of Yes.Life CBD Oil and Relief Cream today!
                                </h2>

                                <h3 style="color:#8a8c8e;">
                                    YOU JUST PAY ${{$products->shippingcost}} FOR SHIPPING
                                </h3>

                            </li>
                        </ul>
                    </div><!--END page-banner-->
                    
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- Page Banner Section End --> --}}


    <!-- Contact Section Start  page-banner-section section-->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div"  ng-app="app" ng-controller="FreeSampleController as vm" ng-cloak style="background-color: #FFFEFA;"  >
       
        <div class="container" >

            <div class="row banner-free-sample">

                <!-- Contact Info Start -->
                <div class="col-xl-8 col-lg-8 col-12 order-1 order-lg-1 mb-sm-50 mb-xs-50" >

                    <h1 style="color:#3a95c2; text-align: center; font-size: 30px !important;">
                        GET YOUR 
                        <span style="color:#fbb055;"> FREE CBD SAMPLES </span>
                        of Yes.Life's CBD Oil and Hemp CBD Pain Relief Cream today!
                    </h1>

                
                    <div class="free-sample-shipping" style="color:#8a8c8e;text-align: center;font-size: 28px; font-weight: bold; font-family: 'Gotham'">
                      <br>
                      <p>
                        <i>
                          Just pay 
                          <span style="color:#fbb055;"> ${{$products->shippingcost}}  </span> 
                          for shipping & handling.
                        </i>
                      </p>
                    </div>


                    <br>

                    <h3 style="text-align: center;">
                      
                      <span style="color:#fbb055;">#1</span> 
                      
                      <span style="color:#3a95c2;">MOST WATER SOLUBLE,</span> 
                     
                      <span style="color:#8a8c8e;">
                        <br>
                        LONGEST-LASTING, HIGHEST-ABSORBING 
                        <br> CBD ON THE MARKET! 

                      </span>

                    </h3>

                    <br>  

                    <div class="row">

                      <div class="col-md-5">
                        <img src="/landingpage/assets/images/product/gel-spray-bottle-V4.png" >
                      </div>

                      <div class="col-md-7">

                        <p>
                          <br>
                        </p>

                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          <b> #1 HIGHEST QUALITY CBD </b> on the market.
                        </p>
                        
                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          CBD Oil and Relieve Cream in one sample, YAY!
                        </p>

                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          Completely Water-Soluble
                        </p>

                        
                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          Faster and Longer Absorption with YesNano™
                        </p>

                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          Made from Hemp, Not Marijuana (Drug-Test Safe)
                        </p>


                        <p>
                          <img src="/landingpage/assets/images/icon-lotus.png" >
                          Best-tasting CBD in the market, don’t eat weeds!
                        </p>

                      </div>
                      
                    </div>


                    {{--{!! $products->description !!}--}}
           
                    {{--<span class="text-center">
                        <img style="" src="{{asset('/storagelink/'.$products->pictxa)}}"alt="">
                    </span>
                    

                    <br><br> --}}

                </div><!-- Contact Info End -->
                
                <!-- Contact Form Start -->
                <div class="col-xl-4 col-lg-4 col-12 order-2 order-lg-2 pr-30 pr-sm-15 pr-md-15 pr-xs-15">

                    <h2 style="text-align: center;">GET YOUR SAMPLE NOW</h2>
               
                    <br>
                   

                    <!-- Checkout Form checkout-form-->
                    <form id="form-checkout" class="jqvalidate-form "  method="POST" action="#" >

                        {{method_field('POST')}}
                        {{ csrf_field() }}

                        <div class="row">

                            <!--start address-->
                            <div class="col-md-12" id="div-personal-info"  >

                                <input type="hidden" class="form-control" id="productid" name="productid" placeholder=""  maxlength="255" readonly="" value="{{$products->pk_products}}">

                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-10">
                                    
                                    {{--checkout-title--}}
                                    {{--<h4 class="" style="background-color: #3a95c2;padding:15px; color:#fff; text-align: center;"> 
                                      PERSONAL INFO
                                    </h4> --}}

                                    <div class="row">

                                        <div class="col-md-6 col-12 mb-20">
                                           {{--<label>First Name*</label> --}}
                                           <input type="text" class="form-control" id="billingfname" name="billingfname" placeholder="First Name" required="" maxlength="255" value="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           {{--<label>Last Name*</label> --}}
                                           <input type="text" class="form-control" id="billinglname" name="billinglname" placeholder="Last Name" required="" maxlength="255" value="">
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           {{--<label>Email Address*</label> --}}
                                           <input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="Email" required="" maxlength="255" value="" >
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                           {{--<label>Phone no*</label> --}}
                                           <input type="text" class="form-control" id="billingphone" name="billingphone" placeholder="Phone" required="" maxlength="255" value="">
                                        </div>


                                        <div class="col-md-6 col-12 mb-20">

                                           {{--<label style="padding-bottom: 6px;">Country*</label> --}}

                                           <select name="billingcountry" id="billingcountry" class="form-control" required=""> 
                                                @foreach($country as $key => $v)
                                                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == 229) ? 'selected' :'' }}> 
                                                        {{$v->name}} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><!--END col-md-6 col-12 mb-20-->

                                        <div class="col-md-6 col-12 mb-20">
                                            
                                            {{--<label>
                                                <input type="checkbox" class="" id="billingcantfindstate" name="billingcantfindstate">
                                                Can't find State?*
                                            </label> --}}

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
                                           {{--<label>City*</label> --}}
                                           <input type="text" class="form-control" id="billingcity" name="billingcity" placeholder="City" value="" maxlength="255" required="">
                                        </div><!--END col-md-6 col-12 mb-20-->

                                        <div class="col-md-6 col-12 mb-20">
                                           {{--<label>Zip Code *</label> --}}
                                           <input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="Zip Code" value="" maxlength="50" required="">
                                        </div><!--END col-md-6 col-12 mb-20-->


                                        <div class="col-12 mb-20">
                                           {{--<label>Address Line 1*</label>--}}
                                           <input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="" maxlength="500" required="">
                                           <br>
                                           <input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="" maxlength="500">
                                        </div><!--END col-md-6 col-12 mb-20-->

                                        {{--
                                        @if(!Auth::check())

                                          <div class="col-12 mb-20">

                                            <div class="check-box">
                                               <input type="checkbox" id="isnewaccount" name="isnewaccount" >
                                               <label for="isnewaccount">Create an Account?</label>
                                            </div>


                                            <div id="isnewaccountdiv" hidden>

                                                <h4 class="" style="background-color: #3a95c2;padding:15px; color:#fff; text-align: center;"> 
                                                  ACCOUNT PASSWORD
                                                </h4>

                                                <span style="font-size: 12px; color:red">
                                                    By default your username will be your email. You can just changed it later.
                                                </span>
                                       
                                                <div id="divbillingpassword" class="form-group">
                                                    <input type="password" class="form-control" id="billingpassword" name="billingpassword" placeholder="password" required="" maxlength="255" value="">
                                                    
                                                </div>

                                                <div id="divbillingrepeatpassword" class="form-group">
                                                    
                                                    <input type="password" class="form-control" id="billingrepeatpassword" name="billingrepeatpassword" placeholder="repeat password" required="" maxlength="255" value="">
                                                    
                                                    
                                                </div>
                                    
                                            </div><!--END isnewaccountdiv-->

                                          </div><!--END col-12 mb-20-->

                                        @endif --}}


                                    </div><!--END row-->

                                </div><!--END billing-form-->

                              
                                <div class="row free-sample-next-step" style="margin: auto; width: 50%; padding: 10px;">

                                  <button type="button" id="nextstep" class="place-order btn btn-lg btn-round" style="margin-top: -10px;" ng-click="vm.NextStep()" >NEXT STEP</button>


                                  @if( strpos(url()->current(), 'training.yes.life/free-sample') !== false )

                                      <script type="text/javascript">
                                        function outbrainNextStepConvert(){
                                          obApi('track', 'Training Next Step');
                                        }
                                      </script>

                                  @elseif( strpos(url()->current(), 'yes.life/free-sample') !== false  )

                                    <script type="text/javascript">
                                      function outbrainNextStepConvert(){
                                        obApi('track', 'Next Step Convert');
                                      }
                                    </script>


                                  @endif

                                </div>

                               

                            </div><!--END col-md-12-->
                            <!--END address-->


                            <div hidden class="col-md-12" id="div-card-details"  >

                              <h4 class="" style="background-color: #3a95c2;padding:10px; color:#fff; text-align: center !important;"> 

                                <button type="button" id="backstep" class="btn btn-sm btn-default" style="background-color: #3a95c2" ng-click="vm.BackStep()">
                                  <span class="fa fa-arrow-left"></span> 
                                </button>

                                CARD DETAILS

                              </h4>


                              <hr>
                              <h4 style="text-align:center;">
                                Free Sample $0.00 + ${{$products->shippingcost}} Shipping & Handling Fee
                              </h4>
                              <hr>
                              <h3 style="text-align:center;">
                                Total: ${{$products->shippingcost}}
                              </h3>
                              <hr>


                              <div class="mb-20">

                                  <label>Card Number *</label>
                                  <input style="color:#666;" class="form-control credit-card-number" type="text" id="rally_cardNumber" placeholder="XXXX XXXX XXXX XXXX" data-input="rally_cardNumber" value="" maxlength="19" required="">
                                  <span id="errrally_cardNumber" style="color:red; font-size: 12px;"> </span>
                              </div>

                              <div class="row  mb-20">
                                  <div class="col-md-6 col-12 mb-20">
                                    <label style="">Expiry Date *</label>
                                    <input style="" type="text" class="form-control credit-card-expiry" id="rally_expDate" placeholder="MM/YYYY" data-input="rally_expDate" maxlength="7" value="">
                                    <span id="errrally_expDate" style="color:red; font-size: 12px;"> </span>
                                  </div>

                                <div class="col-md-6 col-12 mb-20">
                                    <label style="">CVC *</label>
                                    <input style="" type="text" class="form-control" id="rally_cvc" placeholder="XXX" data-input="rally_cvc" maxlength="4" value="">
                                    <span id="errrally_cvc" style="color:red; font-size: 12px;"> </span>
                                </div>

                              </div>


                              <div class="mb-20">
                                <div class="check-box">
                                   <input type="checkbox" id="shiptodifferentaddress" name="shiptodifferentaddress" >
                                   <label for="shiptodifferentaddress">Billing address is different from shipping</label>
                                </div>
                              </div>


                              <!-- Shipping Address -->
                              <div hidden id="divshippingaddress">
                                 
                                  <h4 class="" style="background-color: #3a95c2;padding:15px; color:#fff; text-align: center;"> 
                                    SHIPPING ADDRESS
                                  </h4>

                                  <div class="row">

                                      <div class="col-md-6 col-12 mb-20">
                                         {{--<label>First Name*</label> --}}
                                         <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="Firstname" required="" maxlength="255" value="">
                                      </div>

                                     <div class="col-md-6 col-12 mb-20">
                                         {{--<label>Last Name*</label> --}}
                                         <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="Lastname" required="" maxlength="255" value="">
                                     </div>


                                      <div class="col-12 mb-20">
                                         {{--<label>Phone no*</label> --}}
                                         <input type="text" class="form-control" id="shippingphone" name="shippingphone" placeholder="Phone" required="" maxlength="255" value="">
                                      </div>

                                      <div class="col-md-6 col-12 mb-20">
                                         {{--<label style="padding-bottom: 6px;">Country*</label> --}}
                                         <select name="shippingcountry" id="shippingcountry" class="form-control" required="" >
                                              @foreach($country as $key => $v)
                                                  <option value="{{$v->pk_country}}" {{ ($v->pk_country == 229 ) ? 'selected' :'' }}> 
                                                      {{$v->name}} 
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <div class="col-md-6 col-12 mb-20">
                                          
                                          {{--<label>
                                              <input type="checkbox" class="" id="shippingcantfindstate" name="shippingcantfindstate">
                                              Can't find State?*
                                          </label> --}}

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
                                         {{--<label>City*</label> --}}
                                         <input type="text" class="form-control" id="shippingcity" name="shippingcity" placeholder="City" value="" maxlength="255" required="">
                                      </div>

                                      <div class="col-md-6 col-12 mb-20">
                                         {{--<label>Zip Code *</label> --}}
                                         <input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="Zip Code" value="" maxlength="50" required="">
                                      </div>



                                      <div class="col-12 mb-20">
                                         {{--<label>Address Line 1*</label> --}}
                                         <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="" maxlength="500" required="">
                                         <br>
                                         <input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="" maxlength="500">
                                      </div>

                                  </div><!--END row-->

                              </div><!--END divshippingaddress-->


                              @include('landingpage.layouts.checkout-disclosure')

                              <div class="row free-sample-final-step" style="margin: auto; width: 70%; padding: 10px;">

                                  <button type="submit" id="paymentSubmit" class="place-order btn-lg btn btn-round" style="margin-top: -10px;">GET MY FREE SAMPLE</button>


                              </div>


                           
                            </div>


                        </div><!--END row row-->

                    </form><!--END form-checkout-->


                </div><!-- Contact Form End -->

                
            </div><!--END row-->


            <br><br>


            <div class="">

              <h3 style="text-align: center;"> MESSAGE FROM OUR FOUNDERS </h3>

              <p style="text-align: center;">

                {{--<i>
                   “Our number one goal at Yes Life is to help improve people’s lives. Personally we have seen the power of CBD and the positive effects it has had on Millions of Americans. So we spared no cost when we formulated our Yes Life CBD products. With YesNano ™ technology we have become the best absorbing water soluble product on the market. With so many false CBD’s out there, we wanted to provide the nation with the ability to try CBD themselves before buying something that doesn’t work for them. We want to earn your trust and become your families exclusive CBD provider, and in order to that we are betting on ourselves and our product, by allowing every new customer to try it for Free. Take a sample, and we will see you again in a week!”
                </i> --}}
                
                <i>
                  “Our number one goal at Yes.Life is to help improve people’s lives.  Personally, we have seen the power of CBD and the positive effects it has had on millions of Americans.  So, we spared no cost when we formulated our Yes.Life CBD products.  With <b> YesNano™ Technology,</b> we have become the best-absorbing water-soluble product on the market.  With so many false CBD’s out there, we wanted to provide the nation with the ability to try CBD themselves before buying something that doesn’t work for them.  We want to earn your trust and become your family’s exclusive CBD provider, and in order to do that, we are betting on ourselves and our product, by allowing every new customer to try it for <b>FREE.</b>  Take a sample, and we will see you again in a week!”
                </i>

              </p>




            </div>
        
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