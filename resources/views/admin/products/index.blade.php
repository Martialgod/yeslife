@extends('admin.layouts.master')

@section('title', 'Admin Products Index Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name,desc,category'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	
   	@include('admin.layouts.submenus')
	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/products')}}" title="" style="color:#68AE00;">Products</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($products) > 0)

		
			
		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    {{--<th>Description</th>--}}
	                    <th>Slug</th>
	                    <th>Category</th>
	                    {{--<th>Flavors</th> --}}
	                    <th>Indexno</th>
	                    <th>Price</th>
	                    <th>Qty</th>
	                    <th>Status</th>
	                    <th></th>
	              	</tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($products as $a)

	                    <tr>
	                        <td> {{$a->pk_products}}  </td>

	                        <td> 
	           
	                        	<span data-toggle="tooltip" title="{{$a->name}}" style="cursor: help;">
                                    {{
                                        (strlen($a->name)) > 15 ? substr($a->name,0,15).'..' : $a->name 
                                    }}
                                </span>

	                        </td>

	                        {{--<td> 
	                            <span data-toggle="tooltip" title="{{$a->description}}" style="cursor: help;">
	                                {{
	                                    (strlen($a->description)) > 30 ? substr($a->description,0,30).'..' : $a->description 
	                                }}
	                            </span>
	                        </td>--}}

	                        <td>

	                        	<span data-toggle="tooltip" title="{{$a->slug}}" style="cursor: help;">
                                    {{
                                        (strlen($a->slug)) > 6 ? substr($a->slug,0,6).'..' : $a->slug 
                                    }}
                                </span>

	                        </td>

	                        <td> 
	                        	<span data-toggle="tooltip" title="{{$a->category}}" style="cursor: help;">
                                    {{
                                        (strlen($a->category)) > 6 ? substr($a->category,0,6).'..' : $a->category 
                                    }}
                                </span>

	                        </td>

	                        {{--<td>
	                        	<span data-toggle="tooltip" title="{{$a->options}}" style="cursor: help;">
                                    {{
                                        (strlen($a->options)) > 4 ? substr($a->options,0,4).'..' : $a->options 
                                    }}
                                </span>
	                        </td> --}}

	                        <td>
	                           {{$a->indexno}}
	                        </td>

	                        <td width="">

	                            <span data-html="true" data-toggle="tooltip" title="{{$a->pricestr}}" style="cursor: help;"

				                >
				                	${{ number_format($a->discountedprice,2) }}
				                
				                </span>
				                


	                        </td>
	                        

	                        <td>
	                           {{$a->qty}}
	                        </td>

	                        <td style="color:{{ $a->recordstat == 'Active' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ $a->recordstat }} 

	                        </td>

	                        <td>
	                        	{{-- 
	                        		action="{{route('products.destroy', $a->pk_products)}}" 
	                        		change to softdelete
	                        	--}}
	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('products.softdelete', $a->pk_products)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

	                                @include('admin.layouts.submenus', ['data_id'=> $a->pk_products])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/products'])

	@endif

    @if(count($products) > 0)
    	<div class="pagination-margin-top">
    		{{ $products->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    