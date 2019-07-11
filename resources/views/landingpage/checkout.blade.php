<div style="margin-top: -80px;" class="cart-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="checkout-div">
       
  <div class="container">
    <div class="row">
      <div class="col-12">
        
        <!-- Checkout Form-->
        <form id="form-checkout" class="jqvalidate-form checkout-form"  method="POST" action="#" >

			    {{method_field('POST')}}
			    {{ csrf_field() }}

			    <div class="row row-40">

            {{--optional, for referral links--}}
            {{--<input type="hidden" readonly="" id="referrer_token" name="referrer_token" value="{{ ($referrer) ? $referrer->affiliate_token : ''}}"> --}}

			    	<!--start address-->
           	<div class="col-lg-7">

              <!-- Billing Address -->
              <div id="billing-form" class="mb-10">
                <h4 class="checkout-title">
                  BILLING ADDRESS
                 
                </h4>

                {{--@if( Auth::check() )
                  <a href="{{url('/myaccount/address')}}" title="" class="" >
                     <h5 class="checkout-title" style="font-size: 14px;"> Update My Billing Address </h5>

                  </a>
                @endif --}}

                <div class="row">

                   <div class="col-md-6 col-12 mb-20">
                       <label>First Name*</label>
                       <input type="text" class="form-control" id="billingfname" name="billingfname" placeholder="First Name" required="" maxlength="255" value="{{ $users['fname'] }}">
                   </div>

                   <div class="col-md-6 col-12 mb-20">
                       <label>Last Name*</label>
                       <input type="text" class="form-control" id="billinglname" name="billinglname" placeholder="Last Name" required="" maxlength="255" value="{{ $users['lname'] }}">
                   </div>

                   <div class="col-md-6 col-12 mb-20">
                       <label>Email Address*</label>
                       {{--<input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="Email" required="" maxlength="255" value="{{$users['email']}}" {{ ( Auth::check() ) ? 'readonly="readonly"' : '' }} >--}}
                       <input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="Email" required="" maxlength="255" value="{{$users['email']}}" {{ ( $users['email'] != '' ) ? 'readonly="readonly"' : '' }} >
                   </div>

                   <div class="col-md-6 col-12 mb-20">
                       <label>Phone no*</label>
                       <input type="text" class="form-control" id="billingphone" name="billingphone" placeholder="Phone" required="" maxlength="255" value="{{ $users['phone'] }}">
                   </div>


                   <div class="col-md-6 col-12 mb-20">
                       <label style="padding-bottom: 6px;">Country*</label>
                       {{--
                          disabled automatically when user currently logged in
                          needs to declare hidden input with the same id and name so that when form is submitted the value will still be submitted
                        --}}
                        @if( Auth::check() )
                          <input type="hidden" readonly="" name="billingcountry" value="{{$users['fk_country']}}">
                        @endif
                       <select name="billingcountry" id="billingcountry" class="form-control" required=""> 
					                @foreach($country as $key => $v)
					                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users['fk_country'] ) ? 'selected' :'' }}> 
					                    	{{$v->name}} 
					                    </option>
					                @endforeach

					            </select>
                   </div><!--END col-md-6 col-12 mb-20-->

                   <div class="col-md-6 col-12 mb-20">
                     	
                      {{--<label>
                     		<input type="checkbox" class="" id="billingcantfindstate" name="billingcantfindstate" {{ $iscustomstate ? 'checked' : '' }}>
                     		Can't find State?*
                     	</label> --}}

                       {{--
                          disabled automatically when user currently logged in
                          needs to declare hidden input with the same id and name so that when form is submitted the value will still be submitted
                        --}}
                        @if( Auth::check() )
                          <input type="hidden" readonly="" name="billingstatesdropdown" value="{{$users['state']}}">
                        @endif

                     	<div id="billingstatesdropdowndiv" {{ $iscustomstate ? 'hidden' : '' }}>
                          <label style="padding-bottom: 6px;">States*</label>
						            	<select name="billingstatesdropdown" id="billingstatesdropdown" class="form-control" >
						            
					            			@foreach($states as $key => $v)
						                    <option value="{{$v->name}}" {{ ($v->name == $users['state']) ? 'selected' :'' }}> 
						                    	{{$v->name}} 
						                    </option>
						                @endforeach
						            	
							              
						            	</select>
								    	</div>

								    	<div id="billingstatescustomdiv" {{ !$iscustomstate ? 'hidden' : '' }}>
									    	<input type="text" class="form-control" id="billingstatescustom" name="billingstatescustom" placeholder="enter manually" value="{{ $iscustomstate ? $users['state'] : '' }}" maxlength="255" required="">
								      </div>

                   </div><!--END col-md-6 col-12 mb-20-->

                   <div class="col-md-6 col-12 mb-20">
                       <label>City*</label>
                       <input type="text" class="form-control" id="billingcity" name="billingcity" placeholder="City" value="{{ $users['city'] }}" maxlength="255" required="">
                   </div><!--END col-md-6 col-12 mb-20-->

                   <div class="col-md-6 col-12 mb-20">
                       <label>Zip Code *</label>
                       <input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="Zip Code" value="{{$users['zip']}}" maxlength="50" required="">
                   </div><!--END col-md-6 col-12 mb-20-->


                   <div class="col-12 mb-20">
                       <label>Address Line 1*</label>
                       <input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="{{$users['address1']}}" maxlength="500" required="">
                       <input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="{{$users['address2']}}" maxlength="500">
                   </div><!--END col-md-6 col-12 mb-20-->


                   <div class="col-12 mb-20">

                   		@if( !Auth::check() )

                        <div class="check-box">
                           <input type="checkbox" id="isnewaccount" name="isnewaccount" >
                           <label for="isnewaccount">Create an Account?</label>
                        </div>

                       	<div class="" id="isnewaccountdiv" hidden>

										    	{{--<div id="divbillingusername" class="form-group">
										        	<label for="billinguname">Username <span class="label-required">*</span> </label>
										            <input type="text" class="form-control" id="billinguname" name="billinguname" placeholder="" required="" value="" maxlength="15">
										        </div>--}}

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


                   		@endif

                   </div><!--END col-12 mb-20-->


                   <div class="col-12 mb-20"> 

                      {{--
                        determine if user is approving recurring order through checkout
                        //recurring = order trxno
                        this is only applicable for logged in user
                        !$recurring && Auth::check()
                      --}}
                      @if( !$recurringorder  )

                        <div class="check-box">
                          <input type="checkbox" name="isrecurring" id="isrecurring" >
                          <label for="isrecurring">Recurring Order?</label>
                        </div>

                        <div id="isrecurringdiv" hidden >

                          <br><br>

                          <div class="">
                            <label> I want my order every*</label>
                            <select required="" name="intervalno" id="intervalno" class="form-control">
                              @for($i=1;$i<=31; $i++)
                                <option value="{{$i}}"> {{$i}} </option>
                              @endfor
                            </select>
                            
                          </div><!--END col-md-6 col-12 mb-20-->

                          <div class="">

                            <label></label>
                            <select required="" name="intervalunit" id="intervalunit" class="form-control">
                              <option value="Day"> Day(s) </option>
                              <option value="Month" selected> Month(s) </option>
                              <option value="Years"> Year(s) </option>
                            </select>
                          </div><!--END col-md-6 col-12 mb-20-->

                          {{--<div>
                            <label>And it should start on*</label>
                            <input type="date" required="" name="startdate" id="startdate" class="form-control">
                            
                          </div><!--END col-md-6 col-12 mb-20--> --}}
                         
                          <div>
                            <br>
                            <label>And it should end on</label>
                            <input type="date" name="enddate" id="enddate" class="form-control">
                            
                          </div><!--END col-md-6 col-12 mb-20-->

                        </div><!--END isrecurringdiv-->

                      @endif

                   </div><!--END col-12 mb-20-->

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
                           <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="First Name" required="" maxlength="255" value="{{$users['shippingfname']}}">
                       </div>

                       <div class="col-md-6 col-12 mb-20">
                           <label>Last Name*</label>
                           <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="Last Name" required="" maxlength="255" value="{{$users['shippinglname']}}">
                       </div>


                       <div class="col-12 mb-20">
                           <label>Phone no*</label>
                           <input type="text" class="form-control" id="shippingphone" name="shippingphone" placeholder="Phone" required="" maxlength="255" value="{{$users['shippingphone']}}">
                       </div>

                       <div class="col-md-6 col-12 mb-20">
                          <input type="hidden" id="currentshippingcountry" value="{{$users['shippingcountry']}}">
                           <label style="padding-bottom: 6px;">Country*</label>
                           <select name="shippingcountry" id="shippingcountry" class="form-control" required="" >
							                @foreach($country as $key => $v)
							                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users['shippingcountry']) ? 'selected' :'' }}> 
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
                              <label style="padding-bottom: 6px;">States*</label>
  							            	<select name="shippingstatesdropdown" id="shippingstatesdropdown" class="form-control" >
  							            
  						            			@foreach($states as $key => $v)
								                    <option value="{{$v->name}}" {{$v->name == $users['shippingstate'] ? 'selected' : '' }} > 
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
                           <input type="text" class="form-control" id="shippingcity" name="shippingcity" placeholder="City" value="{{$users['shippingcity']}}" maxlength="255" required="">
                       </div>

                       <div class="col-md-6 col-12 mb-20">
                           <label>Zip Code *</label>
                           <input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="Zip Code" value="{{$users['shippingzip']}}" maxlength="50" required="">
                       </div>



                       <div class="col-12 mb-20">
                           <label>Address Line 1*</label>
                           <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="Street address, P.O. box, company name, c/o" value="{{$users['shippingaddress1']}}" maxlength="500" required="">
                           <input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="Apartment, suite, unit, building, floor, etc." value="{{$users['shippingaddress2']}}" maxlength="500">
                       </div>

                   </div><!--END row-->


               </div><!--END divshippingaddress-->

              @include('landingpage.layouts.checkout-disclosure')

              @include('landingpage.layouts.required-fields')

            

           	</div><!--END col-lg-7-->
           	<!--END address-->


            <!--start cart total-->
            <div class="col-lg-5">
               	
               	<div class="row">

                  <!-- Cart Total -->
                  <div class="col-12 mb-60">

                     	<h4 class="checkout-title">Cart Total</h4>

                     	<div class="checkout-cart-total">

                       	<h4>Product <span>Total</span></h4>

                       	<ul>
                       		<li ng-repeat="list in vm.mscproducts">
                       			@{{list.name}} @@{{list.selectedqty}} 
                       			<span>$@{{list.discountedprice}}</span>
                       		</li>

                       	</ul>

                       	<p>Partial Amount <span>$@{{vm.totalamount}}</span></p>
                       
                       	{{--<p>Shipping Fee <span>$00.00</span></p> --}}

                       	<p ng-if="vm.msccoupons.length >0 ">Coupon(s)</p>
                       	<ul>
                       		<li ng-repeat="list in vm.msccoupons">
                       			@{{list.code}}
                       			<span style="color:red" ng-if="list.type == 'Fixed'"> 
                                - $@{{list.amount}} 
                              </span>

                              <span style="color:red" ng-if="list.type == 'Rated'"> 
                                  - @{{list.amount}}% 

                              </span>
                       		</li>

                       	</ul>

                        <p ng-if="vm.msccoupons.length >0 "> 
                          Sub Total <span> $@{{vm.totalamount - vm.totalcoupondiscount}} </span>
                          {{--Sub Total <span> $@{{vm.subtotal}} </span>--}}
                        </p>

                        <p id="totaltax2">
                          Sales Tax <span> $@{{vm.totaltax}} </span> 
                        </p>
                        

                       	<h4 id="grandtotal2">Grand Total <span>$@{{vm.totalnetamount}}</span></h4>

                     	</div><!--END col-12 mb-60-->


                  </div><!--END col-12 mb-60-->


                  @include('landingpage.checkout-rallypayform')


               	</div><!--END row-->

            </div><!--END col-lg-5-->
            <!--END cart total-->


       	  </div><!--END row row-40-->

		    </form><!--END form-checkout-->

            
      </div><!--END col-12-->

    </div><!--END row-->

  </div><!--END container-->
    
</div><!-- Cart Section End -->
