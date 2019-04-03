@extends('admin.layouts.master')

@section('title', 'Admin Tags Create Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/tags')}}" title="" style="color:#68AE00;">Tags</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('tags.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{old('name')}}" maxlength="255">
                  
                </div>

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/tags'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    