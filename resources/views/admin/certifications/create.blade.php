@extends('admin.layouts.master')

@section('title', 'Admin Certifications Create Page')

@section('optional_styles')

@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/certifications')}}" title="" style="color:#68AE00;">Certifications</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('certifications.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')



        		<div class="form-group">
		            <label for="fk_products">Product<span class="label-required">*</span> </label>
		            <select name="fk_products" id="fk_products" class="form-control" required="">
		            	
		            	<option value="-1">
		            		Not Applicable
		            	</option>

		                @foreach($products as $key => $v)
		                    <option value="{{$v->pk_products}}" {{ ($v->pk_products == old('fk_products') ) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>



        		<div class="form-group">
                    <label for="lotcode">Lot Code <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="lotcode" name="lotcode" placeholder="" value="{{old('lotcode')}}" required="" maxlength="255">
                  
                </div>

             	

		        <div class="form-group">
	                <label for="pictx"> Upload File <span class="label-required">*</span> </label> <br>
	                <input type="file" class="" id="pictx" name="pictx"  placeholder=""  value="">
		        </div>


                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/certifications'])

@endsection



@section('optional_scripts')


@endsection



	


				    