@extends('admin.layouts.master')

@section('title', 'Admin Abandoned Cart Index Page')

@section('optional_styles')

	<script src="/customjs/AbandonedCartController.js?v={{time()}}" type="text/javascript"></script>
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search fullname'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')	

   	{{--filters[3=notified]--}}
   	@include('admin.layouts.filterpreferences', ['filters'=>[3]])

	<br><br>

	@section('content-header')
		<h2>
			<a href="{{url('/admin/orders')}}" title="" style="color:#68AE00;">Orders</a> 
			<span style="font-size: 16px;"> / Abandoned Cart </span>
		</h2> 
	@endsection


	<div class="row" id="main-div" ng-app="app" ng-controller="AbandonedCartController as vm">

		@if(count($abandonedcart) > 0)

			<form method="POST" class="" action="#" id="form-broadcast" >

			    {{method_field('POST')}}
		        {{ csrf_field() }}


				<div class="table-responsive">
			        
			        <table class="table table-hover">
			            
			            <thead>

			                <tr>
			                   	<th>Fullname</th>
			                   	<th>Email</th>
			                    <th>Items</th>
			                    <th>Notification</th>
			                    <th></th>
			              </tr>

			          	</thead>
			          	
			          	<tbody>

			                @foreach($abandonedcart as $a)

			                    <tr>

		                    	    <td> 

			                        	{{$a->fullname}}  
			                        	<input type="hidden" class="form-control" id="fullname{{$a->fk_users}}" value="{{$a->fullname}}" readonly="">
			                        	<input type="hidden" class="form-control" id="fullname{{$a->fk_users}}" value="{{$a->fullname}}" readonly="">

			                        </td>

			                        <td> 

			                        	<input type="hidden" class="form-control" name="users_{{$a->fk_users}}" value="{{$a->email}}" readonly="">
			                        	
			                        	{{$a->email}}

			                        </td>
			                       

			                        <td> {{ $a->totalitems }} </td>

			                        <td> {{ $a->lastnotification }} </td>

			                        <td>
			                        	<span id="{{$a->fk_users}}stat">Pending...</span>
			                        </td>

			                        
			                    </tr>

			                  

			                @endforeach
				          
			      		</tbody>


				  	</table><!--END table table-hover-->

					<button class="btn btn-primary hvr-underline-from-left" >
					    Start Broadcast 
					</button>


				</div><!--END table-responsive-->


			</form>


		@else

			@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/orders'])

		@endif

		<hr>

	    @if(count($abandonedcart) > 0)
	    	<div class="pagination-margin-top" >
	    		{{ $abandonedcart->appends(
	            	['search' => $search,
	            	'notified' => $notified,]
	        	)->links() }}
	    	</div>
	    @endif


		
	</div>
		


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    