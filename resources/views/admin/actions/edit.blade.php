@extends('admin.layouts.master')

@section('title', 'Admin Reward Actions Edit Page')

@section('optional_styles')
	
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/actions')}}" title="" style="color:#68AE00;">Actions</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="swa-confirm"  action="{{route('actions.update', $actions->pk_rewardactions)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')


        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$actions->name}}" maxlength="255">
                  
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="label-required">*</span> </label>
                    <textarea class="form-control trumbowyg" id="description" name="description" placeholder="" required="" rows="4" style="resize:none;" >{{$actions->description}}</textarea>
                  
                </div>

             	<div class="form-group">
	                <label for="points">Points <span class="label-required">*</span> </label>
	                <input type="number" min="0" step="any" class="form-control" id="points" name="points" placeholder="" required="" value="{{$actions->points}}">
		        </div>


                @include('admin.layouts.selectstatus', ['source'=>$actions])


                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/actions' ])

@endsection



@section('optional_scripts')

	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        //$('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    