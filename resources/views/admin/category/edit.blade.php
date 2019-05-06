@extends('admin.layouts.master')

@section('title', 'Admin Category Edit Page')

@section('optional_styles')
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/category')}}" title="" style="color:#68AE00;">Category</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')


	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('category.update', $category->pk_category)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="description">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" value="{{$category->description}}" maxlength="255">
                  
                </div>

                <div class="form-group">
                    <label for="indexno">Sorter <span class="label-required">* sorter</span> </label>
                    <input type="number" class="form-control" id="indexno" name="indexno" placeholder="" required="" value="{{$category->indexno}}" >
                  
                </div>


                <div class="form-group">
	                <label for="description2">Description <span class="label-required"></span> </label>
	                <textarea class="form-control trumbowyg" id="description2" name="description2" placeholder="" style="resize: none;" >{{$category->description2}}</textarea>
		          		            
		        </div>


                @include('admin.layouts.selectstatus', ['source'=>$category])

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/category'])

@endsection



@section('optional_scripts')

		
    <script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    