@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Payment Method')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
    'bannerheader'=>'Address', 
    'bannerurl'=> '/myaccount/home',
    'bannerback'=> 'My Account',
    'bannercontent'=> 'Address'
  ])

  <!-- My Account Section Start -->
  <div class="my-account-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
      <div class="container">
          <div class="row">
              <div class="col-12">

                  <div class="row">

                      @include('landingpage.myaccount.menu')

                      <!-- My Account Tab Content Start -->
                      <div class="col-lg-9 col-12 mb-30">

                          <div class="tab-content">

                              <div class="myaccount-content"><!--myaccount-content-->

                                  @include('admin.layouts.alert')

                                  <!-- Checkout Form-->
                                  <form id="form-address" class="jqvalidate-form checkout-form"  method="POST" action="{{url('/myaccount/address')}}" >

                                      {{method_field('PUT')}}
                                      {{ csrf_field() }}

                                      <div class="row">

                                          <!--Billing Address-->
                                          <div class="col-md-6 card custom-content-backgroud" >
                                              
                                              <br>

                                              <h3>Billing Address</h3>

                                              <hr>

                                              <div class="">
                                                 <label style="padding-bottom: 6px;">Country*</label>
                                           
                                                 <select name="billingcountry" id="billingcountry" class="form-control" required=""> 
                                                      @foreach($country as $key => $v)
                                                          <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users->fk_country ) ? 'selected' :'' }}> 
                                                              {{$v->name}} 
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </div><!--END col-md-6 col-12 mb-20-->

                                              <br>

                                              <div class="">
                                                  
                                                  <label>
                                                      <input type="checkbox" class="" id="billingcantfindstate" name="billingcantfindstate" {{ $iscustomstate ? 'checked' : '' }}>
                                                      Can't find State?*
                                                  </label>


                                                  <div id="billingstatesdropdowndiv" {{ $iscustomstate ? 'hidden' : '' }}>
                                                      <select name="billingstatesdropdown" id="billingstatesdropdown" class="form-control" >
                                                  
                                                          @foreach($states as $key => $v)
                                                              <option value="{{$v->name}}" {{ ($v->name == $users->state) ? 'selected' :'' }}> 
                                                                  {{$v->name}} 
                                                              </option>
                                                          @endforeach
                                                      
                                                        
                                                      </select>
                                                  </div>

                                                  <div id="billingstatescustomdiv" {{ !$iscustomstate ? 'hidden' : '' }}>
                                                      <input type="text" class="form-control" id="billingstatescustom" name="billingstatescustom" placeholder="enter manually" value="{{ $iscustomstate ? $users->state : '' }}" maxlength="255" required="">
                                                  </div>

                                              </div><!--END col-md-6 col-12 mb-20-->

                                              <br>

                                              <div class="row">

                                                  <div class="col-md-6 col-5 mb-20">
                                                     <label>City*</label>
                                                     <input type="text" class="form-control" id="billingcity" name="billingcity" placeholder="City" value="{{ $users->city }}" maxlength="255" required="">
                                                  </div><!--END col-md-6 col-12 mb-20-->

                                                  <div class="col-md-6 col-5 mb-20">
                                                     <label>Zip Code*</label>
                                                     <input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="Zip Code" value="{{ $users->zip }}" maxlength="50" required="">
                                                  </div><!--END col-md-6 col-12 mb-20-->

                                                 
                                              </div>

                                              <div class="">
                                                 <label>Phone no*</label>
                                                 <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="" maxlength="255" value="{{$users->phone}}">
                                             </div>


                                            

                                              <div class="">
                                                 <label>Address Line 1*</label>
                                                 <input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="{{$users->address1}}" maxlength="500" required="">
                                                 <label>Address Line 2</label>
                                                 <input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="{{$users->address2}}" maxlength="500">
                                              </div><!--END col-md-6 col-12 mb-20-->


                                          </div><!--END col-md-6-->

                                          <!--Shipping Address-->
                                          <div class="col-md-6 card custom-content-backgroud" >
                                              <br>
                                              <h3>Shipping Address</h3>
                                              <hr>

                                              <div class="row">


                                                  <div class="col-md-6 col-5 mb-20">
                                                     <label>First Name*</label>
                                                     <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="First Name" required="" maxlength="255" value="{{$users->shippingfname}}">
                                                 </div>

                                                 <div class="col-md-6 col-5 mb-20">
                                                     <label>Last Name*</label>
                                                     <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="Last Name" required="" maxlength="255" value="{{$users->shippinglname}}">
                                                 </div>
                                                  
                                              </div>

                                           


                                             <div class="">
                                                 <label style="padding-bottom: 6px;">Country*</label>
                                                 <select name="shippingcountry" id="shippingcountry" class="form-control" required="" >
                                                      @foreach($country as $key => $v)
                                                          <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users->shippingcountry) ? 'selected' :'' }}> 
                                                              {{$v->name}} 
                                                          </option>
                                                      @endforeach

                                                  </select>
                                             </div>

                                             <br>
                                             <div class="">
                                                  <label>
                                                      <input type="checkbox" class="" id="shippingcantfindstate" name="shippingcantfindstate">
                                                      Can't find State?*
                                                  </label>

                                                  <div id="shippingstatesdropdowndiv" >
                                                      <select name="shippingstatesdropdown" id="shippingstatesdropdown" class="form-control" >
                                                  
                                                          @foreach($states as $key => $v)
                                                              <option value="{{$v->name}}" {{$v->name == $users->shippingstate ? 'selected' : '' }} > 
                                                                  {{$v->name}} 
                                                              </option>
                                                          @endforeach
                                                      
                                                        
                                                      </select>
                                                  </div>

                                                  <div id="shippingstatescustomdiv" hidden>
                                                        <input type="text" class="form-control" id="shippingstatescustom" name="shippingstatescustom" placeholder="enter manually" value="" maxlength="255" required="">
                                                  </div>

                                             </div>

                                             <br>
                                             <div class="row">

                                                  <div class="col-md-6 col-5 mb-20">
                                                     <label>City*</label>
                                                     <input type="text" class="form-control" id="shippingcity" name="shippingcity" placeholder="City" value="{{$users->shippingcity}}" maxlength="255" required="">
                                                  </div>

                                                  <div class="col-md-6 col-5 mb-20">
                                                     <label>Zip Code*</label>
                                                     <input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="Zip Code" value="{{$users->shippingzip}}" maxlength="50" required="">
                                                  </div>

                                                 
                                             </div>

                                              <div class="">
                                                 <label>Phone no*</label>
                                                 <input type="text" class="form-control" id="shippingphone" name="shippingphone" placeholder="Phone" required="" maxlength="255" value="{{$users->shippingphone}}">
                                             </div>
                                             
                                             <div class="">
                                                 <label>Address Line 1*</label>
                                                 <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="{{$users->shippingaddress1}}" maxlength="500" required="">
                                                 <label>Address Line 2</label>
                                                 <input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="{{$users->shippingaddress2}}" maxlength="500">
                                             </div>

                                          </div><!--END col-md-6-->



                                      </div><!--END row-->

                                      <br>
                                      @include('landingpage.layouts.buttonsubmit')
                                      <br><br>

                                     

                                  </form>

                              </div><!--END myaccount-content-->

                          </div><!--END tab-content-->

                      </div><!-- col-lg-9 col-12 mb-30 -->

                  </div><!--END row-->

              </div><!--END col-12-->
          </div><!--END row-->
      </div><!--END container-->
  </div><!-- My Account Section End -->

    

@endsection



@section('optional_scripts')

	<script src="/customjs/CartCheckoutJquery.js?v={{time()}}" type="text/javascript"></script>
    

@endsection



	


				    