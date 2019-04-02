@extends('admin.layouts.master')

@section('title', 'Admin Country Edit Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/country')}}" title="" style="color:#68AE00;">Country</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('country.update', $country->pk_country)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$country->name}}" maxlength="255">
                  
                </div>

                <div class="form-group">
                    <label for="countrycode">Country Code <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="countrycode" name="countrycode" placeholder="" required="" value="{{$country->countrycode}}" maxlength="15">
                  
                </div>

                <div class="form-group">
                    <label for="isocode">ISO Code <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="isocode" name="isocode" placeholder="" required="" value="{{$country->isocode}}" maxlength="15">
                  
                </div>

                @include('admin.layouts.selectstatus', ['source'=>$country])

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/country'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">

    
    </script>

@endsection



	


				    