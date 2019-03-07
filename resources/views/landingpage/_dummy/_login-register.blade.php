@extends('landingpage.layouts.master')

@section('title', 'YesLife Register')

@section('optional_styles')
	

@endsection


@section('content-body')

	<div class="row">

		<form method="POST" name="login-form" action="?logtype=login" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

	        <div class="col-md-4 " >

	        	<h2>Sample Login</h2> 


				@if( isset($is_login) && $is_login == 'error' )
                    <h5 class="text-danger" style="margin-top: -20px;">
                        <b> Invalid Login Details! </b>
                    </h5>
                    <br>
                @endif  


                <div class="form-group">
		        	<label for="uname">Username <span class="label-required">*</span> </label>
		            <input type="text" name="uname" placeholder="Username" required="" value="{{ isset($uname) ? $uname : '' }}" autofocus="" >
		        </div>

     
	        	 <div class="form-group">
		        	<label for="uname">Password <span class="label-required">*</span> </label>
		           	<input type="password" name="password" class="lock" required=""  placeholder="Password">
		        </div>
						

				<input type="submit" class="btn btn-info" name="login" value="Login">

			</div><!--END col-md-4-->

		</form>


		<form method="POST" name="register-form" class="jqvalidate-form" action="?logtype=register" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

	        <div class="col-md-4 " >

	        	<h2>Sample Registration</h2> 


				@include('admin.layouts.alert')


	        	<div class="form-group" hidden >
		        	<label for="refno">Reference Token </label>
		            <input type="hidden" class="form-control" id="refno" name="refno" placeholder="" required="" value="{{$refno}}">
		        </div>

     
	        	<div class="form-group">
		        	<label for="uname">Username <span class="label-required">*</span> </label>
		            <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{old('uname')}}" maxlength="15">
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
		        	<label for="fname">Firstname <span class="label-required">*</span> </label>
			    	<input type="text" class="form-control" id="fname" name="fname" placeholder=""  value="{{old('fname')}}" required="" maxlength="255">
		        </div>



				<div class="form-group">
		        	<label for="email">Email</label><span class="label-required">*</span>
			    	<input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{old('email')}}" maxlength="191">
		        </div>


		        <br>
			   	@include('admin.layouts.buttonsubmit')
			


			</div><!--END col-md-4-->

		</form>


	
	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    