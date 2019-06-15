@extends('admin.layouts.master')

@section('title', 'Admin Blogs Page')

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
		 	<a href="{{url('/admin/blogs')}}" title="" style="color:#68AE00;">Blogs</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($blogs) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    <th>Minutes</th>
	                    <th>Status</th>
	                    <th>Date</th>
	                    <th>Postedby</th>
	                    <th></th>
	              	</tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($blogs as $a)

	                    <tr>
	                        <td> {{$a->pk_posts}}  </td>

	                        {{--<td>
	                        	<span data-toggle="tooltip" title="{{$a->slug}}" style="cursor: help;">
                                    {{
                                        (strlen($a->slug)) > 30 ? substr($a->slug,0,30).'..' : $a->slug 
                                    }}
                                </span>
	                        </td> --}}


	                        <td>
	                        	<span data-toggle="tooltip" title="{{$a->name}}" style="cursor: help;">
                                    {{
                                        (strlen($a->name)) > 30 ? substr($a->name,0,30).'..' : $a->name 
                                    }}
                                </span>
	                        </td>

	                        <td>
	                        	{{$a->minstoread}}
	                        </td>

	                        @php
	                        	$statcolor = 'grey';
	                        	if( $a->stat == 'Posted' ){
	                        		$statcolor = 'green';
	                        	}
	                        	elseif( $a->stat == 'In-Active' ){
	                        		$statcolor = 'red';
	                        	}
	                        @endphp
	                        <td style="color:{{$statcolor}}"> 
	                            {{ $a->stat }} 

	                        </td>


	                        <td> {{ date_format( date_create($a->sourcedate), 'd M, Y' ) }} </td>

	                        <td> {{$a->sourcename}} </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('blogs.destroy', $a->pk_posts)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_posts])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/blogs'])

	@endif

    @if(count($blogs) > 0)
    	<div class="pagination-margin-top">
    		{{ $blogs->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    