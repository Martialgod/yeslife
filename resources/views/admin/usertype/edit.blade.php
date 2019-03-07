@extends('admin.layouts.master')

@section('title', 'Admin User Type Edit Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/usertype')}}" title="" style="color:#68AE00;">User Type</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	<div class="row">

		<form method="POST" class="swa-confirm"  action="{{route('usertype.update', $usertype->pk_usertype)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">


				@include('admin.layouts.alert')


        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$usertype->name}}" maxlength="15">
                  
                </div>

        		<div class="form-group">
                    <label for="description">Description <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" maxlength="255" value="{{$usertype->description}}">
                  
                </div>

                @include('admin.layouts.selectstatus', ['source'=>$usertype])

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/usertype'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    