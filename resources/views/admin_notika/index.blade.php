@extends('admin.layouts.master')

@section('title', 'Admin Index Page')

@section('optional_styles')
	

@endsection



@section('content')
	
	@section('breadcrumb-details')

		<div class="breadcomb-icon">
			<i class="notika-icon notika-house"></i>
		</div>

		<div class="breadcomb-ctn">
			<h2>Welcome Home</h2>
			<p>
				{{ Auth::user()->fullname  }}
			</p>
		</div>

	@endsection


   <div class="container">
        <div class="row">

        

        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	