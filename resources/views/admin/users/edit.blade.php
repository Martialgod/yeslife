@extends('admin.layouts.master')

@section('title', 'Admin Users Edit Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/users')}}" title="" style="color:#68AE00;">Users</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')
	
	@include('admin.layouts.alert')

	<div class="row" id="main-div">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('users.update', $users->id)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-4 " >

        		<div class="form-group">
		            <label for="fk_usertype">User Type<span class="label-required">*</span> </label>
		            <select name="fk_usertype" id="fk_usertype" class="form-control" required="">
		                @foreach($usertype as $key => $v)
		                    <option value="{{$v->pk_usertype}}" {{ ($users->fk_usertype == $v->pk_usertype) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">
		            <label for="title">Salutation</label>
		            <select name="title" id="title" class="form-control">

	                    <option value="Mr." {{ ($users->title == 'Mr.') ? 'selected' :'' }}> 
	                    	Mr.
	                    </option>

	                    <option value="Mrs." {{ ($users->title == 'Mrs.') ? 'selected' :'' }}> 
	                    	Mrs.
	                    </option>

	                    <option value="Miss." {{ ($users->title == 'Miss.') ? 'selected' :'' }}> 
	                    	Miss.
	                    </option>

	                    <option value="Company" {{ ($users->title == 'Company') ? 'selected' :'' }}> 
	                    	Company
	                    </option>
		               
		            </select>
		          
		        </div>



	        	<div class="form-group">
		        	<label for="uname">Username <span class="label-required">*</span> </label>
		            <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{$users->uname}}" maxlength="255">
		        </div>

		        <div class="form-group">
		            <label for="password">Password </label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="" value="" maxlength="15">
		        </div>

		        <div class="form-group">
		            <label for="password_confirmation">Confirm Password</label>
				    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder=""  value="" maxlength="15">
		        </div>
			  	

		        <div class="form-group">
		        	<label for="lname">Lastname <span class="label-required">*</span> </label>
			    	<input type="text" class="form-control" id="lname" name="lname" placeholder="" required="" value="{{$users->lname}}" maxlength="255">
		        </div>


		        <div class="form-group">
		        	<label for="fname">Firstname  <span class="label-required">*</span> </label>
			    	<input type="text" class="form-control" id="fname" name="fname" placeholder=""  value="{{$users->fname}}" required="" maxlength="255">
		        </div>

		      
	          

			</div><!--END col-md-4-->


			<div class="col-md-4">

				<div class="form-group">
		        	<label for="email">Email</label><span class="label-required">*</span>
			    	<input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{$users->email}}" maxlength="191" readonly="">
		        </div>


		        <div class="form-group">
		        	<label for="phone">Phone</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{$users->phone}}" maxlength="255" required="">
		        </div>

	   		
	   			<div class="form-group">
		        	<label for="website">Website</label>
			    	<input type="text" class="form-control" id="website" name="website" placeholder="" value="{{$users->website}}" maxlength="255">
		        </div>

		        <div class="form-group">
		        	<label for="companyname">Company Name</label>
			    	<input type="text" class="form-control" id="companyname" name="companyname" placeholder="" value="{{$users->companyname}}" maxlength="255">
		        </div>

		        <div class="form-group">
		        	<label for="vatid">Vat ID</label>
			    	<input type="text" class="form-control" id="vatid" name="vatid" placeholder="" value="{{$users->vatid}}" maxlength="255">
		        </div>

		        @include('admin.layouts.selectstatus', ['source'=>$users])


				<div style="font-size:0.8em;color:#; text-align: left; " class="form-group">
                  		

                    <label> 
                    	<input type="checkbox" id="issubscribed" name="issubscribed" {{ $users->issubscribed == '1' ? 'checked' : '' }} >
                       	Email me for latest news, 
						products, promotions, offers and discount?

                    </label>	

                    <label> 
                    	<input type="checkbox" id="istext" name="istext" {{ $users->istext == '1' ? 'checked' : '' }} >
                       	Send me a text for latest news,
						products, promotions, offers and discount?

                    </label>	

               	</div>	

				
			</div><!--END col-md-4-->


			<div class="col-md-4">

				<div class="form-group">
		            <label for="fk_country">Country<span class="label-required">*</span> </label>
		            <select name="fk_country" id="fk_country" class="form-control" required="">
		                @foreach($country as $key => $v)
		                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == $users->fk_country) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>

		        <div class="form-group">

		        	<input type="checkbox" class="" id="cantfindstate" name="cantfindstate" {{ $iscustomstate ? 'checked' : '' }}>
			    	<label for="cantfindstate">
			    		Can't find State?<span class="label-required">*</span>  
			    	</label>

			    	<div id="statesdropdowndiv" {{ $iscustomstate ? 'hidden' : '' }}>
		            	<select name="statesdropdown" id="statesdropdown" class="form-control" >
		            
	            			@foreach($states as $key => $v)
			                    <option value="{{$v->name}}" {{ ($v->name == $users->state) ? 'selected' :'' }}> 
			                    	{{$v->name}} 
			                    </option>
			                @endforeach
		            	
			              
		            	</select>
			    	</div>


			        <div id="statescustomdiv" {{ !$iscustomstate ? 'hidden' : '' }}>
				    	<input type="text" class="form-control" id="statescustom" name="statescustom" placeholder="enter manually" value="{{ $iscustomstate ? $users->state : '' }}" maxlength="255">
			        </div>


		        </div>



	   			<div class="form-group">
		        	<label for="city">City</label><span class="label-required">*</span>
			    	<input type="text" class="form-control" id="city" name="city" placeholder="" value="{{$users->city}}" maxlength="255" required="">
		        </div>

		      

		        <div class="form-group">
		        	<label for="zip">Zip</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="zip" name="zip" placeholder="" value="{{$users->zip}}" maxlength="50" required="">
		        </div>



		        <div class="form-group">
		        	<label for="address1">Address</label> <span class="label-required">*</span>
			    	<input type="text" class="form-control" id="address1" name="address1" placeholder="" value="{{$users->address1}}" maxlength="500" required="">
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
		
		//initialize select2
        //$("#fk_country").select2({width:'100%'});//initialize jquery select2 plugin; 
        //$("#statesdropdown").select2({width:'100%'});//initialize jquery select2 plugin; 
        
	</script>

@endsection



	


				    