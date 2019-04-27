@extends('admin.layouts.master')

@section('title', 'Admin Product Group Edit Page')

@section('optional_styles')


	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">

	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/productgroup')}}" title="" style="color:#68AE00;">Product Group</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')


	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('productgroup.update', $productgroup->pk_productgroup)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$productgroup->name}}" maxlength="255">
                  
                </div>

                <div class="form-group">
	                <label for="description">Product Description <span class="label-required">*</span> </label>
	                <textarea class="form-control trumbowyg" id="description" name="description" placeholder="" required="" style="resize: none;" >{{$productgroup->description}}</textarea>
		          		            
		        </div>


                @include('admin.layouts.selectstatus', ['source'=>$productgroup])

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/productgroup'])

@endsection



@section('optional_scripts')

		
    <script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    