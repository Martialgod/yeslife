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

   	{{--filters[6=productgroup]--}}
   	@include('admin.layouts.filterpreferences', ['filters'=>[6]])


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

	                	<th></th>
	                	<th></th>
	                   	<th>ID</th>
	                   	<th>Group</th>
	                    <th>Name</th>
	                    {{--<th>Description</th>--}}
	                    {{--<th>Slug</th>--}}
	                    <th>Flavor</th>
	                    <th>Category</th>
	                    <th>Sorter</th>
	                    <th>Price</th>
	                    <th>Qty</th>
	                    <th>Unit</th>
	                    <th>Status</th>
	                   
	              	</tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($products as $a)

	                    <tr>

	                        <td>
	                        	{{-- 
	                        		action="{{route('products.destroy', $a->pk_products)}}" 
	                        		change to softdelete
	                        	--}}
	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('products.softdelete', $a->pk_products)}}" >


	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

	                                {{--@include('admin.layouts.submenus', ['data_id'=> $a->pk_products]) --}}


	                    			<!-- Default dropleft button -->
									<div class="btn-group" >


									  	<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    	<i class="fa fa-cog"></i>
									  	</button>

									  	<div class="dropdown-menu" >

										    <!-- Dropdown menu links -->
										    @foreach($sub_menu as $key => $sub)

										    	<div class="dropdown-divider"></div>

												@if( $sub->indexno >= 1 ) 

													@if( $sub->method == 'DELETE' )

														<button class="btn btn-default btn-xs label-required hvr-underline-from-left dropdown-item col-md-12"  type="submit" >
											               {{$sub->description}}
											           	</button>

											        @else 

									        			{{--default. display all menu--}}
											        	<a href="{{route($sub->route, $a->pk_products)}}" class="btn btn-default btn-xs hvr-underline-from-left dropdown-item  col-md-12">
											               {{$sub->description}}
											            </a>	

													@endif {{--END $sub->method == 'DELETE' --}}

												@endif {{--END $sub->indexno >= 1 --}}


											@endforeach

									 	</div><!--END dropdown-menu-->

									</div><!--END btn-group-->

	                            </form>

	                    	</td>

	                    	<td>
	                    		<img src="{{asset('/storagelink/'.$a->pictxa)}}" alt="" style="width:40px;height:40px">
	                    	</td>


	                        <td> {{$a->pk_products}}  </td>

	                        <td> 
	           
	                        	<span data-toggle="tooltip" title="{{$a->groupname}}" style="cursor: help;">
                                   {{$a->fk_productgroup}}
                                </span>

	                        </td>

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

	                        {{--<td>

	                        	<span data-toggle="tooltip" title="{{$a->slug}}" style="cursor: help;">
                                    {{
                                        (strlen($a->slug)) > 6 ? substr($a->slug,0,6).'..' : $a->slug 
                                    }}
                                </span>

	                        </td>--}}

	                        <td>
	                           {{$a->flavor}}
	                        </td>


	                        <td> 
	                        	<span data-toggle="tooltip" title="{{$a->category}}" style="cursor: help;">
                                    {{
                                        (strlen($a->category)) > 8 ? substr($a->category,0,8).'..' : $a->category 
                                    }}
                                </span>

	                        </td>


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


	                        <td>{{$a->uom}}</td>

	                        <td style="color:{{ $a->recordstat == 'Active' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ $a->recordstat }} 

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



	


				    