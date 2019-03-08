@extends('admin.layouts.master')

@section('title', 'Admin Reports - '.$permalink->description)

@section('optional_styles')
	
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	{{--dynamic filters returned from the ReportsController@create--}}
	@include('admin.layouts.filterpreferences', ['filters'=>$filters])


	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/reports')}}" title="" style="color:#68AE00;">Reports</a> <span style="font-size: 16px;"> / {{ $permalink->description }} </span> 
		</h2> 
	@endsection

	<br>
	@include("admin.reports.".$permalink->pk_permalink)


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    