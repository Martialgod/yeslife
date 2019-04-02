@extends('admin.layouts.master')

@section('title', 'Admin Blogs Create Page')

@section('optional_styles')

	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">

	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/blogs')}}" title="" style="color:#68AE00;">Blogs</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('blogs.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-12">

        		@include('admin.layouts.alert')

        		<div class="form-group">

	                <label for="pictx"> Cover Photo <span class="label-required"> 870x462px</span>  </label> <br>
	                <input type="file" class="" id="pictx" name="pictx" placeholder=""  value="" >
	                
		        </div>



        		<div class="form-group">
                    <label for="slug">Slug <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="" required="" value="{{old('slug')}}" >
                  
                </div>

                <div class="form-group">
                    <label for="name">Blog Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{old('name')}}" >
                  
                </div>

                <div class="form-group">
                    <label for="summary">Brief Summary <span class="label-required">*</span> </label>
                   <textarea class="form-control" id="summary" name="summary" placeholder="A brief summary here..." required="" rows="3" style="resize: none;" maxlength="255" >{{old('summary')}}</textarea>
                  
                </div>

                <div class="form-group">
	                <label for="content">Content <span class="label-required">*</span> </label>
	                <textarea class="form-control trumbowyg" id="content" name="content" placeholder="" required="" rows="5" style="resize: none;" >{{old('content')}}</textarea>
		          		            
		        </div>

		        <div class="form-group">
                    <label for="sourcename">Source Name <span class="label-required">* (Blogger name displayed in home page)</span> </label>
                    <input type="text" class="form-control" id="sourcename" name="sourcename" placeholder="" required="" value="{{Auth()->user()->fname}}" >
                  
                </div>

                <div class="form-group">
                    <label for="sourcedate">Blog Date <span class="label-required">* (Blog date displayed in home page)</span> </label>
                    <input type="date" class="form-control" id="sourcedate" name="sourcedate" placeholder="" required="" value="{{old('sourcedate')}}" >
                  
                </div>


		        <div class="form-group">
				    <label for="stat">Status <span class="label-required">*</span> </label>
				    <select name="stat" id="stat" class="form-control">
				        <option value="For Approval" {{ old('stat') == 'For Approval' ? 'selected' : '' }}>	
				        	For Approval
				        </option>
				        <option value="Posted" {{ old('stat') == 'Posted' ? 'selected' : '' }}>	
				        	Posted
				        </option>
				        <option value="In-Active" {{ old('stat') == 'In-Active' ? 'selected' : '' }}>	
				        	In-Active
				        </option>
				    </select>

				</div>

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/blogs'])

@endsection



@section('optional_scripts')

	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    