@extends('admin.layouts.master')

@section('title', 'Admin User Type Create Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/usertype')}}" title="" style="color:#68AE00;">User Type</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')


	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('usertype.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">


				@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{old('name')}}" maxlength="15">
                  
                </div>

        		<div class="form-group">
                    <label for="description">Description <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" maxlength="255" value="{{old('description')}}">
                  
                </div>

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/usertype'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    