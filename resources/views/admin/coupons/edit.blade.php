@extends('admin.layouts.master')

@section('title', 'Admin Coupons Edit Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/coupons')}}" title="" style="color:#68AE00;">Coupons</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')
	
	@include('admin.layouts.alert')
        		
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('coupons.update', $coupons->pk_coupons)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-4">


        		<div class="form-group">
                    <label for="code">Coupon Code <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="" required="" value="{{$coupons->code}}" maxlength="255">
                  
                </div>


        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$coupons->name}}" maxlength="255">
                  
                </div>

        		<div class="form-group">
                    <label for="description">Description <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" value="{{$coupons->description}}" maxlength="255">
                  
                </div>

                <div class="form-group">
                    <label for="type">Type <span class="label-required">*</span> </label>
                  	<select name="type" id="type" class="form-control">
				        <option value="Fixed" {{ $coupons->type == 'Fixed' ? 'selected' : '' }}>Fixed</option>
				        <option value="Rated" {{ $coupons->type == 'Rated' ? 'selected' : '' }}>Rated (Percentage)</option>
				    </select>

 
                </div>

                <div class="form-group">
                    <label for="amount">Amount <span class="label-required">*</span> </label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="" required="" value="{{$coupons->amount}}" min="0">
                  
                </div>


                {{--'Y-m-d\TH:i' = 2019-01-01T01:00--}}
				
				@php
                	$efd = ( $coupons->effective_at ) ? date_format(date_create($coupons->effective_at), 'Y-m-d\TH:i' ) : null;
                @endphp
				<div class="form-group">
                    <label for="effective_at">Effective At <span class="label-required"></span> </label>
                    <input type="datetime-local" class="form-control" id="effective_at" name="effective_at" placeholder="" value="{{$efd}}" >
                  
                </div>

                @php
                	$exd = ( $coupons->expired_at ) ? date_format(date_create($coupons->expired_at), 'Y-m-d\TH:i' ) : null;
                @endphp
				<div class="form-group">
                    <label for="expired_at">Expired At <span class="label-required"></span> </label>
                    <input type="datetime-local" class="form-control" id="expired_at" name="expired_at" placeholder="" value="{{$exd}}" >
                  
                </div>

  
			</div><!--END col-md-4-->


			<div class="col-md-4">

				<div class="form-group">
                    <label for="applies_to">Applies To <span class="label-required">*</span> </label>
                  	<select name="applies_to" id="applies_to" class="form-control">
				        <option value="All" {{ $coupons->applies_to == 'All' ? 'selected' : '' }}>
				        	All User (Site login is not required)
				        </option>
				        <option value="Specific" {{  $coupons->applies_to == 'Specific' ? 'selected' : '' }}>
				        	Specific User (Site login is required)
				        </option>
				    </select>

 
                </div>

                <div class="form-group">
                    <label for="max_use">Max Use<span class="label-required">* (0 = unlimited) </span> </label>
                    <input type="number" class="form-control" id="max_use" name="max_use" placeholder="" required="" value="{{$coupons->max_use}}" min="0">
                  
                </div>



                @include('admin.layouts.selectstatus', ['source'=>$coupons])

				<br>
		    	@include('admin.layouts.buttonsubmit')
		
				
			</div><!--END cold-md-4-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/coupons'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    