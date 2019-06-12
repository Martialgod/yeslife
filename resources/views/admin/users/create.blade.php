@extends('admin.layouts.master')

@section('title', 'Admin Users Create Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/users')}}" title="" style="color:#68AE00;">Users</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('users.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-4 " >

        		<div class="form-group">
		            <label for="fk_usertype">User Type<span class="label-required">*</span> </label>
		            <select name="fk_usertype" id="fk_usertype" class="form-control" required="">
		                @foreach($usertype as $key => $v)
		                    <option value="{{$v->pk_usertype}}" {{ (old('fk_usertype') == $v->pk_usertype) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">
		            <label for="title">Salutation</label>
		            <select name="title" id="title" class="form-control">

	                    <option value="Mr." {{ (old('title') == 'Mr.') ? 'selected' :'' }}> 
	                    	Mr.
	                    </option>

	                    <option value="Mrs." {{ (old('title') == 'Mrs.') ? 'selected' :'' }}> 
	                    	Mrs.
	                    </option>

	                    <option value="Miss." {{ (old('title') == 'Miss.') ? 'selected' :'' }}> 
	                    	Miss.
	                    </option>

	                    <option value="Company" {{ (old('title') == 'Company') ? 'selected' :'' }}> 
	                    	Company
	                    </option>
		               
		            </select>
		          
		        </div>



	        	<div class="form-group">
		        	<label for="uname">Username <span class="label-required">*</span> </label>
		            <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{old('uname')}}" maxlength="255">
		        </div>

		        <div class="form-group">
		            <label for="password">Password </label> <span class="label-required">*</span> 
				    <input type="password" class="form-control" id="password" name="password" placeholder="" required="" value="" maxlength="15">
		        </div>

		        <div class="form-group">
		            <label for="password_confirmation">Confirm Password</label> <span class="label-required">*</span> 
				    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required="" placeholder=""  value="" maxlength="15">
		        </div>
			  	

		        <div class="form-group">
		        	<label for="lname">Lastname <span class="label-required">*</span> </label>
			    	<input type="text" class="form-control" id="lname" name="lname" placeholder="" required="" value="{{old('lname')}}" maxlength="255">
		        </div>


		        <div class="form-group">
		        	<label for="fname">Firstname  <span class="label-required">*</span> </label>
			    	<input type="text" class="form-control" id="fname" name="fname" placeholder=""  value="{{old('fname')}}" required="" maxlength="255">
		        </div>


			</div><!--END col-md-4-->


			<div class="col-md-4">

				<div class="form-group">
		        	<label for="email">Email</label><span class="label-required">*</span>
			    	<input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{old('email')}}" maxlength="191">
		        </div>


		        <div class="form-group">
		        	<label for="phone">Phone</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{old('phone')}}" maxlength="255" required="">
		        </div>

	   		
	   			<div class="form-group">
		        	<label for="website">Website</label>
			    	<input type="text" class="form-control" id="website" name="website" placeholder="" value="{{old('website')}}" maxlength="255">
		        </div>

		        <div class="form-group">
		        	<label for="companyname">Company Name</label>
			    	<input type="text" class="form-control" id="companyname" name="companyname" placeholder="" value="{{old('companyname')}}" maxlength="255">
		        </div>

		        <div class="form-group">
		        	<label for="vatid">EIN/SSN</label>
			    	<input type="text" class="form-control" id="vatid" name="vatid" placeholder="" value="{{old('vatid')}}" maxlength="255">
		        </div>
				
			</div><!--END col-md-4-->


			<div class="col-md-4">


				<div class="form-group">
		            <label for="fk_country">Country<span class="label-required">*</span> </label>
		            <select name="fk_country" id="fk_country" class="form-control" required="">
		                @foreach($country as $key => $v)
		                    <option value="{{$v->pk_country}}" {{ $v->pk_country == '229' ? 'selected' : '' }}> 
		                    	{{--default USA--}}
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">

		        	{{--<input type="checkbox" class="" id="cantfindstate" name="cantfindstate" {{ old('cantfindstate') == 'on' ? 'checked' : '' }}>
			    	<label for="cantfindstate">
			    		Can't find State?<span class="label-required">*</span>  
			    	</label>--}}

			    	<label for="States">
			    		States<span class="label-required">*</span>  
			    	</label> 


			    	<div id="statesdropdowndiv" {{ old('cantfindstate') == 'on' ? 'hidden' : '' }}>
		            	<select name="statesdropdown" id="statesdropdown" class="form-control" >
		            
	            			@foreach($states as $key => $v)
			                    <option value="{{$v->name}}" {{ ($v->name == old('statesdropdown') ) ? 'selected' :'' }}> 
			                    	{{$v->name}} 
			                    </option>
			                @endforeach
		            	
			              
		            	</select>
			    	</div>


			        <div id="statescustomdiv" {{ !old('cantfindstate') == 'on' ? 'hidden' : '' }}>
				    	<input type="text" class="form-control" id="statescustom" name="statescustom" placeholder="enter manually" value="{{ old('cantfindstate') == 'on' ? old('statescustom') : '' }}" maxlength="255">
			        </div>


		        </div>



	   			<div class="form-group">
		        	<label for="city">City</label><span class="label-required">*</span>
			    	<input type="text" class="form-control" id="city" name="city" placeholder="" value="{{old('city')}}" maxlength="255" required="">
		        </div>

		      

		        <div class="form-group">
		        	<label for="zip">Zip</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="zip" name="zip" placeholder="" value="{{old('zip')}}" maxlength="50" required="">
		        </div>



		        <div class="form-group">
		        	<label for="address1">Address</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="address1" name="address1" placeholder="" value="{{old('address')}}" maxlength="500" required="">
		        </div>



		        <br>
			   	@include('admin.layouts.buttonsubmit')
			

			</div><!--END col-md-4-->

			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/users'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    