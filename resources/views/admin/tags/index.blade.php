@extends('admin.layouts.master')

@section('title', 'Admin Tags Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/tags')}}" title="" style="color:#68AE00;">Tags</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($tags) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($tags as $a)

	                    <tr>
	                        <td> {{$a->pk_tags}}  </td>

	                        <td> {{$a->name}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('tags.destroy', $a->pk_tags)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_tags])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/tags'])

	@endif

    @if(count($tags) > 0)
    	<div class="pagination-margin-top">
    		{{ $tags->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    