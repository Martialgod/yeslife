@extends('admin.layouts.master')

@section('title', 'Admin Orders Broadcast Page')

@section('optional_styles')

	<script src="/customjs/BroadcastController.js?v={{time()}}" type="text/javascript"></script>

	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/orders')}}" title="" style="color:#68AE00;">Orders</a> 
		<span style="font-size: 16px;"> / Broadcast </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row" id="main-div" ng-app="app" ng-controller="BroadcastController as vm">

		<form method="POST" class="" action="#" id="form-broadcast" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}


            <div class="col-md-4 well"> 

            	<blockquote>

            		<div class="form-group" hidden>
			        	<label for="pk_ordermstr">ID <span class="label-required">*</span> </label>
			            <input type="hidden" class="form-control" id="pk_ordermstr" name="pk_ordermstr" placeholder="" required="" value="{{$ordermstr->pk_ordermstr}}" >
			        </div>
            		<p>
	                    <b>Customer: </b> 
	                    {{$ordermstr->billto}}
	                </p>

	                <p>
	                	<b>Date: </b>
	                	{{$ordermstr->created_at}}
	                </p>
            		
            	</blockquote>


                <div class="table-responsive">
	        
			        <table class="table table-hover">
			            
			            <thead>

			                <tr>
			                   	<th>Products</th>
			                    <th>Qty</th>
			              	</tr>

			          	</thead>


			          	
			          	<tbody>

			                @foreach($orderdtls as $a)

			                    <tr>
			                        <td> {{$a->name}}  </td>

			                        <td> {{$a->qty}} </td>

			                    </tr>

			                  

			                @endforeach
				          
			      		</tbody>


				  	</table><!--END table table-hover-->

				</div><!--END table-responsive-->

               
        
            </div><!--END col-md-4-->



            <div class="col-md-8">

               	<blockquote>
               		Broadcast to the following customers
               	</blockquote>

               	@if(count($unbroadcastusers) > 0)

	            	<div class="table-responsive">
		        
				        <table class="table table-hover">
				            
				            <thead>

				                <tr>
				                   	<th>Fullname</th>
				                    <th>Email</th>
				                    <th></th>
				              	</tr>

				          	</thead>


				          	<tbody>

				                @foreach($unbroadcastusers as $a)

				                    <tr>
				                        
				                        <td class="col-md-3" > 

				                        	{{$a->fullname}}  
				                        	<input type="hidden" class="form-control" id="fullname{{$a->id}}" value="{{$a->fullname}}" readonly="">

				                        </td>

				                        <td class="col-md-4"> 

				                        	<input type="hidden" class="form-control" name="users_{{$a->id}}" value="{{$a->email}}" readonly="">
				                        	
				                        	{{$a->email}}

				                        </td>

				                        <td>
				                        	<span id="{{$a->id}}stat">Pending...</span>
				                        </td>

				                    </tr>


				                @endforeach
					          
				      		</tbody>


					  	</table><!--END table table-hover-->

					  	

						@include('admin.layouts.buttonback', ['backurl'=>'/admin/orders'])


			            @if( $ordermstr->isapproved == 0  )
			                <br><br><br>
			                <div class="alert alert-danger" style="font-size: 12px; margin-top: -20px;">
			                    This is a recurring transaction that needs user approval. Unable to use broadcast event...
			                </div>

			            @else


							<button class="btn btn-success hvr-underline-from-left" >
							    Start Broadcast 
							</button>

			            @endif
        

					</div><!--END table-responsive-->

					<hr>
					@if(count($unbroadcastusers) > 0)
				    	<div class="pagination-margin-top" >
				    		{{ $unbroadcastusers->appends(
				            	['search' =>'']
				        	)->links() }}
				    	</div>
				    @endif


            	@else

            		<div class="text-center">  	
						<div class="error-page-left">
							<img src="/adminpage/images/nosearchfound.png" alt="">
						</div>

						@include('admin.layouts.buttonback', ['backurl'=>'/admin/orders'])


					</div>

            	@endif
 

            </div><!--END col-md-8-->


			
		</form>

	
	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    