@extends('admin.layouts.master')

@section('title', 'Admin Coupons Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name,description'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/coupons')}}" title="" style="color:#68AE00;">Coupons</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($coupons) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                   	<th>Code</th>
	                    <th>Name</th>
	                    <th>Description</th>
	                    <th>Type</th>
	                    <th>Amount</th>
	                    <th>Effectivity</th>
	                    <th>Applies</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($coupons as $a)

	                    <tr>
	                        <td> {{$a->pk_coupons}}  </td>

	                        <td> {{$a->code}} </td>

	                        <td> 
	                        
	                        	<span data-toggle="tooltip" title="{{$a->name}}" style="cursor: help;">
                                    {{
                                        (strlen($a->name)) > 20 ? substr($a->name,0,20).'..' : $a->name 
                                    }}
                                </span>

	                        </td>

	                        <td> 
	                        	<span data-toggle="tooltip" title="{{$a->description}}" style="cursor: help;">
                                    {{
                                        (strlen($a->description)) > 20 ? substr($a->description,0,20).'..' : $a->description 
                                    }}
                                </span>
	                        </td>

	                        <td> {{$a->type}} </td>

	                        <td> 
	                        	@if($a->type == 'Fixed')
	                        		${{$a->amount}} 
	                        	@else
	                        		{{$a->amount}}%
	                        	@endif
	                        	
	                        </td>

	                        <td>
	                        	{{ $a->effective_at }}
	                        	<br>
	                        	{{ $a->expired_at }}
	                        </td>

	                        <td>
	                        	
	                        	{{$a->applies_to}}

	                        </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('coupons.destroy', $a->pk_coupons)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_coupons])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/coupons'])

	@endif

    @if(count($coupons) > 0)
    	<div class="pagination-margin-top">
    		{{ $coupons->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    