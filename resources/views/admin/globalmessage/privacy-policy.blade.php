@extends('admin.layouts.master')

@section('title', 'Admin Privacy Policy Page')

@section('optional_styles')
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
@endsection


@section('global-search')

@endsection

	
@section('content-body')

	@include('admin.layouts.alert')


	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/privacy')}}" title="" style="color:#68AE00;">Privacy Policy</a> <span style="font-size: 16px;"> / Index </span> 
		</h2> 
	@endsection


    <form method="POST" class="jqvalidate-form swa-confirm"  action="{{url('/admin/privacy/'.$globalmessage->pk_globalmessage)}}" enctype="multipart/form-data" >

		{{method_field('PUT')}}
	    {{ csrf_field() }}

	    <div class="form-group">
	        <label for="content"> Content <span class="label-required"></span> </label>
	        <textarea class="form-control trumbowyg" id="content" name="content" placeholder="" style="resize: none;" >{{$globalmessage->content}}</textarea>
	      		            
	    </div>


	    <br>
		@include('admin.layouts.buttonsubmit')
		

	</form>
	


@endsection



@section('optional_scripts')

	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    