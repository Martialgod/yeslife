@extends('admin.layouts.master')

@section('title', 'Admin Category Page')

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
		 	<a href="{{url('/admin/category')}}" title="" style="color:#68AE00;">Category</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($category) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    <th>Sorter</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($category as $a)

	                    <tr>
	                        <td> {{$a->pk_category}}  </td>

	                        <td> {{$a->description}} </td>

	                        <td> {{$a->indexno}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('category.destroy', $a->pk_category)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_category])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/category'])

	@endif

    @if(count($category) > 0)
    	<div class="pagination-margin-top">
    		{{ $category->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    