<div class="row" id="checkout-div">

	<form id="form-checkout" class="jqvalidate-form"  method="POST" action="#" >

	    {{method_field('POST')}}
	    {{ csrf_field() }}

		<div class="col-md-4">

			    <h4>Billing Address</h4>
			    
			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingfname">Firstname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billingfname" name="billingfname" placeholder="" required="" maxlength="255" value="{{ $users['fname'] }}">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="billinglname">Lastname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="billinglname" name="billinglname" placeholder="" required="" maxlength="255" value="{{ $users['lname'] }}">
			        </div>
			        
			    </div>

			   	<div class="form-group">
		            <label for="billingcountry">Country<span class="label-required">*</span> </label>
		            <select name="billingcountry" id="billingcountry" class="form-control" required="">
		                @foreach($country as $key => $v)
		                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users['fk_country'] ) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">

		        	<input type="checkbox" class="" id="billingcantfindstate" name="billingcantfindstate" {{ $iscustomstate ? 'checked' : '' }}>
			    	<label for="billingcantfindstate">
			    		Can't find State?<span class="label-required">*</span>  
			    	</label>

			    	<div id="billingstatesdropdowndiv" {{ $iscustomstate ? 'hidden' : '' }}>
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


		        </div>



	   			<div class="form-group">
		        	<label for="billingcity">City</label><span class="label-required">*</span>
			    	<input type="text" class="form-control" id="billingcity" name="billingcity" placeholder="" value="{{$users['city']}}" maxlength="255" required="">
		        </div>

		      

		        <div class="form-group">
		        	<label for="billingzip">Zip</label>
			    	<input type="text" class="form-control" id="billingzip" name="billingzip" placeholder="" value="{{$users['zip']}}" maxlength="50">
		        </div>



		        <div class="form-group">
		        	<label for="billingaddress1">Address Line 1</label>
			    	<input type="text" class="form-control" id="billingaddress1" name="billingaddress1" placeholder="" value="{{$users['address1']}}" maxlength="500">
		        </div>

		        
		        <div class="form-group">
		        	<label for="billingaddress2">Address Line 2</label>
			    	<input type="text" class="form-control" id="billingaddress2" name="billingaddress2" placeholder="" value="" maxlength="500">
		        </div>


			    <div class="form-group">
			        
			        <div class="form-single nk-int-st widget-form">
			            <label for="billingemail">Email Address<span class="error">*</span> </label>
			            <input type="email" class="form-control" id="billingemail" name="billingemail" placeholder="" required="" maxlength="255" value="{{$users['email']}}">
			        </div>
			        
			    </div>


			    @if( !Auth::check() )

			    	<input type="checkbox" id="isnewaccount" name="isnewaccount">
				    Create account?

				    <div id="isnewaccountdiv" hidden>

				    	{{--<div id="divbillingusername" class="form-group">
				        	<label for="billinguname">Username <span class="label-required">*</span> </label>
				            <input type="text" class="form-control" id="billinguname" name="billinguname" placeholder="" required="" value="" maxlength="15">
				        </div>--}}

				        <span style="font-size: 12px; color:red">By default your username will be your email. You can just changed it later.</span>
					   
					    <div id="divbillingpassword" class="form-group">
					        <div class="form-single nk-int-st widget-form">
					            <label for="billingpassword">Password<span class="error">*</span> </label>
					            <input type="password" class="form-control" id="billingpassword" name="billingpassword" placeholder="" required="" maxlength="255" value="">
					        </div>
					        
					    </div>

					    <div id="divbillingrepeatpassword" class="form-group">
					        <div class="form-single nk-int-st widget-form">
					            <label for="billingrepeatpassword">Repeat Password<span class="error">*</span> </label>
					            <input type="password" class="form-control" id="billingrepeatpassword" name="billingrepeatpassword" placeholder="" required="" maxlength="255" value="">
					        </div>
					        
					    </div>
				    	
				    </div>

				    

			    @endif


		</div><!--END col-md-4-->


		<div class="col-md-4">
	
			<input type="checkbox" id="shiptodifferentaddress" name="shiptodifferentaddress">
			Ship to a different address?


			<div hidden id="divshippingaddress">

				<div class="form-group">
			        <div class="form-single nk-int-st widget-form">
			            <label for="shippingfname">Firstname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippingfname" name="shippingfname" placeholder="" required="" maxlength="255" value="">
			        </div>
			        
			    </div>

			    <div class="form-group">
			        <div class="form-single">
			            <label for="shippinglname">Lastname <span class="error">*</span> </label>
			            <input type="text" class="form-control" id="shippinglname" name="shippinglname" placeholder="" required="" maxlength="255" value="">
			        </div>
			        
			    </div>

			    
			    <div class="form-group">
		            <label for="shippingcountry">Country<span class="label-required">*</span> </label>
		            <select name="shippingcountry" id="shippingcountry" class="form-control" required="">
		                @foreach($country as $key => $v)
		                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users['fk_country']) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">

		        	<input type="checkbox" class="" id="shippingcantfindstate" name="shippingcantfindstate">
			    	<label for="shippingcantfindstate">
			    		Can't find State?<span class="label-required">*</span>  
			    	</label>

			    	<div id="shippingstatesdropdowndiv" >
		            	<select name="shippingstatesdropdown" id="shippingstatesdropdown" class="form-control" >
		            
	            			@foreach($states as $key => $v)
			                    <option value="{{$v->name}}" > 
			                    	{{$v->name}} 
			                    </option>
			                @endforeach
		            	
			              
		            	</select>
			    	</div>


			        <div id="shippingstatescustomdiv" hidden>
				    	<input type="text" class="form-control" id="shippingstatescustom" name="shippingstatescustom" placeholder="enter manually" value="" maxlength="255" required="">
			        </div>


		        </div>



	   			<div class="form-group">
		        	<label for="shippingcity">City</label><span class="label-required">*</span>
			    	<input type="text" class="form-control" id="shippingcity" name="shippingcity" placeholder="" value="" maxlength="255" required="">
		        </div>

		      

		        <div class="form-group">
		        	<label for="shippingzip">Zip</label>
			    	<input type="text" class="form-control" id="shippingzip" name="shippingzip" placeholder="" value="" maxlength="50">
		        </div>



		        <div class="form-group">
		        	<label for="shippingaddress1">Address Line 1</label>
			    	<input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" placeholder="" value="" maxlength="500">
		        </div>

		        
		        <div class="form-group">
		        	<label for="shippingaddress2">Address Line 2</label>
			    	<input type="text" class="form-control" id="shippingaddress2" name="shippingaddress2" placeholder="" value="" maxlength="500">
		        </div>
	
				
			</div><!--END divshippingaddress-->
			
		</div><!--END col-md-4-->


		<div class="col-md-4">

			<h3>Payment Information</h3>

			<button type="submit" name="checkoutCart" class="btn btn-lg btn-success" > Place Order </button>
			
		</div><!--END col-md-4-->

	</form>


</div><!--END row-->
