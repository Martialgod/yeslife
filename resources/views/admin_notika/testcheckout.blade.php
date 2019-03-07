<h1>
	Checkout Page
</h1>
<hr>


<div class="row">

	<form novalidate="" id="form-checkout" method="POST" action="#" v-on:submit.prevent="confirmCheckout">

	    {{method_field('POST')}}
	    {{ csrf_field() }}

		<div class="col-md-4">

			    <h4>Billing Address</h4>
			    
			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingfname">Firstname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingfname" name="billingfname" placeholder="" required="" maxlength="255" value="{{old('billingfname')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billinglname">Lastname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billinglname" name="billinglname" placeholder="" required="" maxlength="255" value="{{old('billinglname')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingaddress1">Address Line 1 <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="Street address, P.O Box, Company name, c/o" required="" maxlength="500" value="{{old('billingaddress1')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingaddress2">Address Line 2 <span class="error"></span> </label>
			            <input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="Apartment, suite, unit, building, floor, etc"  maxlength="500" value="{{old('billingaddress2')}}">
			        </div>
			        
			    </div>


			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingcity">City<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingcity" required="" name="billingcity" required="" placeholder=""  maxlength="255" value="{{old('billingcity')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingstate">State/Province<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingstate" name="billingstate" required="" placeholder=""  maxlength="255" value="{{old('billingstate')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingzip">Zip/Postal Code<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="" required="" maxlength="50" value="{{old('billingzip')}}">
			        </div>
			        
			    </div>


			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingcountry">Country<span class="error">*</span> </label>
			            <select class="form-control" required="" name="billingcountry" id="billingcountry" >
			            	@foreach($country as $key=> $v)
			            		{{--default country USA --}}
			            		<option value="{{$v->pk_country}}" {{ $v->pk_country == '229' ? 'selected' : '' }} >{{$v->name}}</option>

			            	@endforeach
			            </select>
			        </div>
			        
			    </div>


			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingemail">Email Address<span class="error">*</span> </label>
			            <input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="" required="" maxlength="255" value="{{old('billingemail')}}">
			        </div>
			        
			    </div>

			    
			    <input type="checkbox" id="isnewaccount" name="isnewaccount">
			    Create account?
			   
			    <div id="divbillingpassword" hidden class="form-group">
			    	<br>
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingpassword">Password<span class="error">*</span> </label>
			            <input type="password" class="form-control" id="billingpassword" name="billingpassword" placeholder="" required="" maxlength="255" value="{{old('billingpassword')}}">
			        </div>
			        
			    </div>

		</div><!--END col-md-4-->

		<div class="col-md-4">
	
			<input type="checkbox" id="shiptodifferentaddress" name="shiptodifferentaddress">
			Ship to a different address?


			<div hidden id="divshippingaddress">

				<div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingfname">Firstname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="" required="" maxlength="255" value="{{old('shippingfname')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippinglname">Lastname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="" required="" maxlength="255" value="{{old('shippinglname')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingaddress1">Address Line 1 <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="Street address, P.O Box, Company name, c/o" required="" maxlength="500" value="{{old('shippingaddress1')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingaddress2">Address Line 2 <span class="error"></span> </label>
			            <input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="Apartment, suite, unit, building, floor, etc"  maxlength="500" value="{{old('shippingaddress2')}}">
			        </div>
			        
			    </div>


			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingcity">City<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingcity" required="" name="shippingcity" placeholder=""  maxlength="255" value="{{old('shippingcity')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingstate">State/Province<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingstate" name="shippingstate" placeholder="" required=""  maxlength="255" value="{{old('shippingstate')}}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingzip">Zip/Postal Code<span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="" required="" maxlength="50" value="{{old('shippingzip')}}">
			        </div>
			        
			    </div>


			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingcountry">Country<span class="error">*</span> </label>
			            <select class="form-control" required="" name="shippingcountry" id="shippingcountry" >
			            	@foreach($country as $key=> $v)
			            		{{--default country USA --}}
			            		<option value="{{$v->pk_country}}" {{ $v->pk_country == '229' ? 'selected' : '' }} >{{$v->name}}</option>

			            	@endforeach
			            </select>
			        </div>
			        
			    </div>

	
				
			</div><!--END divshippingaddress-->
			
		</div><!--END col-md-4-->


		<div class="col-md-4">

			<h3>Payment Information</h3>

			<button type="submit" name="checkoutCart" class="btn btn-lg btn-success" > Place Order </button>
			
		</div><!--END col-md-4-->

	</form>
	
</div>
