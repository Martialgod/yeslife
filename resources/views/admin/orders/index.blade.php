@extends('admin.layouts.master')

@section('title', 'Admin Orders Index Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search id, billto'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')	

   	@include('admin.layouts.submenus')
   	
   	{{--filters[1=daterange, 2=paymenstatus]--}}
   	@include('admin.layouts.filterpreferences', ['filters'=>[1,2]])

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/orders')}}" title="" style="color:#68AE00;">Orders</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection
		

	@if(count($orders) > 0)

		
		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                   	<th>Trxno</th>
	                   	<th>Date</th>
	                    <th>Billto</th>
	                    <th>Items</th>
	                    <th>Shipping</th>
	                    <th>Net</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($orders as $a)

	                    <tr>
	                        <td> {{$a->pk_ordermstr}}  </td>

	                        <td> {{$a->trxno}}  </td>

	                        <td> {{ $a->created_at }} </td>


                            <td> 
                                <span data-toggle="tooltip" title="{{$a->billto}}" style="cursor: help;">
                                    {{
                                        (strlen($a->billto)) > 20 ? substr($a->billto,0,20).'..' : $a->billto 
                                    }}
                                </span>
                            </td>


	                        <td>{{$a->totalitem}}</td>


	                        <td>${{$a->totalshipcost}}</td>

	                        <td> ${{$a->netamount}} </td>

	                        <td> 
	                        	{{$a->paymentstatus}} 
	                        	@if( $a->isapproved == 0 && $a->isdeclined == 0 )
	                        		<span style="font-size: 10px;color:red">
	                        			<br>
	                        			*for approval*
	                        		</span>

	                        	@elseif( $a->isdeclined == 1 )
	                        		<span style="font-size: 10px;color:red">
	                        			<br>
	                        			*user declined*
	                        		</span>

	                        	@endif
	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('orders.destroy', $a->pk_ordermstr)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

	                                @include('admin.layouts.submenus', ['data_id'=> $a->pk_ordermstr, 'options'=>[
	                                		'unbroadcastusers' => $a->unbroadcastusers
	                                	] 
	                                ])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/orders'])

	@endif

    @if(count($orders) > 0)
    	<div class="pagination-margin-top" >
    		{{ $orders->appends(
            	[
            		'search' => $search,
            	 	'datefrom'=> $datefrom,
            	 	'dateto'=> $dateto,
            	 	'paymentstatus'=> $paymentstatus
            	]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    