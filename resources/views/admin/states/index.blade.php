@extends('admin.layouts.master')

@section('title', 'Admin States Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search state'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/states')}}" title="" style="color:#68AE00;">States</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($states) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                   	<th>Country</th>
	                    <th>State</th>
	                    <th>Code</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($states as $a)

	                    <tr>
	                        <td> {{$a->pk_states}}  </td>

	                        <td> {{$a->country}} </td>

	                        <td> {{$a->name}} </td>

	                        <td>
	                        	{{$a->code}}
	                        </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('states.destroy', $a->pk_states)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_states])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/states'])

	@endif

    @if(count($states) > 0)
    	<div class="pagination-margin-top">
    		{{ $states->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    