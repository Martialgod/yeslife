@extends('admin.layouts.master')

@section('title', 'Admin User Type Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name, description'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')
	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/usertype')}}" title="" style="color:#68AE00;">User Type</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($usertype) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    <th>Description</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($usertype as $a)

	                    <tr>
	                        <td> {{$a->pk_usertype}}  </td>

	                        <td> {{$a->name}} </td>

	                        <td> {{$a->description}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('usertype.destroy', $a->pk_usertype)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

    								@include('admin.layouts.submenus', ['data_id'=> $a->pk_usertype])

	                            </form>

	                    	</td>

	                    </tr>


	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/usertype'])

	@endif

    @if(count($usertype) > 0)
    	<div class="pagination-margin-top">
    		{{ $usertype->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    