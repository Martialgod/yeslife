@extends('admin.layouts.master')

@section('title', 'Admin FAQs Create Page')


@section('optional_styles')
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/faqs')}}" title="" style="color:#68AE00;">FAQs</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('faqs.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
                    <label for="question">Question <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="question" name="question" placeholder="" required="" value="{{old('question')}}" maxlength="255">
                  
                </div>

                <div class="form-group">
	                <label for="answer">Answer <span class="label-required"></span> </label>
	                <textarea class="form-control trumbowyg" id="answer" name="answer" placeholder="" style="resize: none;" >{{old('answer')}}</textarea>
		          		            
		        </div>

                <div class="form-group">
                    <label for="indexno">Sorter <span class="label-required">* sorter</span> </label>
                    <input type="number" class="form-control" id="indexno" name="indexno" placeholder="" required="" value="{{$maxindexno}}" >
                  
                </div>

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/faqs'])

@endsection



@section('optional_scripts')
	
	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    