@extends('admin.layouts.master')

@section('title', 'Admin 404 Page')

@section('optional_styles')
	
@endsection


	
@section('content-body')


	<div class="row">

	
		<div class="error-404">  	
			<div class="error-page-left">
				<img src="/adminpage/images/404.png" alt="">
			</div>
			<div class="error-right">
		    	<h2>Oops! Page Not found</h2>
	    		<h4>Nothing Is Found Here!!</h4>
		    	<a href="{{route('admin.home')}}">Go Back</a>
			</div>
		</div>
	
	</div><!--END row-->


@endsection



	


				    