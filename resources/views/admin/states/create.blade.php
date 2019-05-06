@extends('admin.layouts.master')

@section('title', 'Admin States Create Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/states')}}" title="" style="color:#68AE00;">States</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('states.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')


                <div class="form-group">
		            <label for="fk_country">Country<span class="label-required">*</span> </label>
		            <select name="fk_country" id="fk_country" class="form-control" required="">
		                @foreach($country as $key => $v)
		                    <option value="{{$v->pk_country}}" {{ ($v->pk_country == old('fk_country')) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>



        		<div class="form-group">
                    <label for="name">State <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{old('name')}}" maxlength="255">
                  
                </div>

                <div class="form-group">
                    <label for="code">Code <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="" required="" value="{{old('code')}}" maxlength="15">
                  
                </div>


                <div class="form-group">
	                <label for="taxrate">Tax Rate <span class="label-required">*</span> </label>
	                <input type="number" min="0" max="100" step="any" class="form-control" id="taxrate" name="taxrate" placeholder="" required="" value="{{old('taxrate') ? old('taxrate') : 0.00}}">
		        </div>


                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/states'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    