@extends('admin.layouts.master')

@section('title', 'Admin Reward Edit Page')

@section('optional_styles')

@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/rewards')}}" title="" style="color:#68AE00;">Rewards</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')

	
	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('rewards.update', $rewards->pk_userrewards)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}


	        <div class="col-md-6 well">

        		<blockquote>
        			<b>Referral: </b> {{$rewards->downline}}
        			<br>
					<b>Order No: </b> {{$rewards->trxno}}
					<br>
					<b>Order Amount: </b> ${{$rewards->orderamount}}
				</blockquote>



				<blockquote>
					<b>Reward Type: </b> {{$rewards->type}}
					<br>
					<b>Reward Amount: </b> {{$rewards->actionpoints}}
				</blockquote>

				

			</div>



        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
		            <label for="fk_rewardactions">Action Name<span class="label-required">*</span> </label>
		            <select name="fk_rewardactions" id="fk_rewardactions" class="form-control" required="">

		            	@if( $actions )
		            		<option value="{{$actions->pk_rewardactions}}"  > 
		                    	{{$actions->name}} 
		                    </option>
		            	@endif
	                   
	
		            </select>
		          
		        </div>


        		<div class="form-group">
                    <label for="fk_users">Customer Name<span class="label-required">*</span> </label>
		            <select name="fk_users" id="fk_users" class="form-control" required="">

	            		<option value="{{$rewards->fk_users}}"  > 
	                    	{{$rewards->fullname}} 
	                    </option>

		            </select>
                  
                </div>

             	<div class="form-group">
	                <label for="points">Points <span class="label-required">*</span> </label>
	                <input type="number" min="0" step="any" class="form-control" id="points" name="points" placeholder="" required="" value="{{$rewards->points}}">
		        </div>


                <div class="form-group">
                    <label for="remarks">Remarks <span class="label-required">*</span> </label>
                    <textarea class="form-control" id="remarks" name="remarks" placeholder="" required="" rows="4" style="resize:none;" >{{$rewards->remarks}}</textarea>
                </div>


                <div class="form-group">
                    <label for="sysremarks">System Remarks <span class="label-required"></span> </label>
                    <blockquote>{{$rewards->sysremarks}}</blockquote>
                </div>


                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->

			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/rewards' ])

@endsection



@section('optional_scripts')

    <script type="text/javascript">
   
    </script>

@endsection



	


				    