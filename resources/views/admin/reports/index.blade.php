@extends('admin.layouts.master')

@section('title', 'Admin Reports Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search report name'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	
    @include('admin.layouts.submenus')
	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/reports')}}" title="" style="color:#68AE00;">Reports</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($reports) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Report Name</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($reports as $a)

	                    <tr>
	                        <td> {{$a->pk_permalink}}  </td>

	                        <td> {{$a->description}} </td>

	                        <td>

	                        	<a href="{{url('/admin/reports/'.$a->pk_permalink)}}" class="btn btn-default btn-sm hvr-underline-from-left">
							        Generate
							    </a>
	                        	
	                        </td>
	                       
	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/reports'])

	@endif


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    