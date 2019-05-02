@extends('admin.layouts.master')

@section('title', 'Admin Reward Actions Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search action name'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/actions')}}" title="" style="color:#68AE00;">Actions</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($actions) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                   	<th>Name</th>
	                    <th>Description</th>
	                    <th>Type</th>
	                    <th>Points</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($actions as $a)

	                    <tr>
	                        <td> {{$a->pk_rewardactions}}  </td>

	                        <td> {{$a->name}} </td>

	                        <td>

	                        	<span data-toggle="tooltip" title="{{$a->description}}" style="cursor: help;">
                                    {{
                                        (strlen($a->description)) > 30 ? substr($a->description,0,30).'..' : $a->description 
                                    }}
                                </span>

	                     	</td>	

	                     	<td> {{$a->type}} </td>

	                        <td>
	                        	{{$a->points}}
	                        </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('actions.destroy', $a->pk_rewardactions)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_rewardactions])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/actions'])

	@endif

    @if(count($actions) > 0)
    	<div class="pagination-margin-top">
    		{{ $actions->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    