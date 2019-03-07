@extends('admin.layouts.master')

@section('title', 'Admin User Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name, fullname,type'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	
    @include('admin.layouts.submenus')
	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/users')}}" title="" style="color:#68AE00;">Users</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($users) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Type</th>
	                    <th>Fullname</th>
	                    <th>Email</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($users as $a)

	                    <tr>
	                        <td> {{$a->id}}  </td>

	                        <td> {{$a->utype}} </td>

	                        <td> {{$a->fullname}} </td>

	                        <td> {{$a->email}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('users.destroy', $a->id)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

	                                @include('admin.layouts.submenus', ['data_id'=> $a->id])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/users'])

	@endif

    @if(count($users) > 0)
    	<div class="pagination-margin-top">
    		{{ $users->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    