@extends('admin.layouts.master')

@section('title', 'Admin Users Downline')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/users')}}" title="" style="color:#68AE00;">Users</a> 
		<span style="font-size: 16px;"> / Downline </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">


	        <div class="col-md-3 well"> 


        		<p>
                    <b>Token: </b> {{$users->affiliate_token}}
                </p>

                <p>
                	<b>Fullname: </b> {{$users->fullname}}
                	
                </p>

                <p>
                	<b>Email: </b> {{$users->email}}
                	
                </p>


            </div><!--END col-md-4-->



	    	<div class="col-md-8">

	    		@if(count($downline) > 0)


		        	<div class="table-responsive">
		        
				        <table class="table table-hover">
				            
				            <thead>

				                <tr>
				                   	<th>Name</th>
	                                <th>Email</th>
	                                <th>Register</th>
                                    <th>Referrals</th>
                                    <th>Purchases</th>
				              	</tr>

				          	</thead>

				          	
				          	<tbody>

	                            @foreach($downline as $v)

	                                <tr>
	                                    
	                                    <td>
	                                        {{$v->fullname}}
	                                    </td>


	                                    <td>
	                                        {{$v->email}}
	                                    </td>

                                        <td>
                                           {{$v->date}}
                                        </td>
                                        
                                        <td>
                                            {{$v->referralcount}}
                                        </td>

                                        <td>
                                            {{$v->purchasecount}}
                                        </td>


	                                </tr>

	                            @endforeach
	                        
	                        </tbody>

					  	</table><!--END table table-hover-->

					</div><!--END table-responsive-->

					<br>


    		   	@else

    		   		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/users'])

    		   	@endif

				<div class="row"></div>
				
		   

	        </div><!--END col-md-8-->


	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/users'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">


		
	</script>

@endsection



	


				    