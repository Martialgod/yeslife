

                @if( count($products) > 0 )

                    <div class="normal-table-list sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                        <div class="basic-tb-hd">
                            @include('admin.layouts.search')
                        </div><!--END basic-tb-hd-->
                        <div class="bsc-tbl-st">
                            
                            <table class="table">
                                
                                   <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Discount%</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                
                                <tbody >
                
                                    @foreach($products as $a)

                                        <tr>
                                            <td width=";"> {{$a->pk_products}} </td>
                                            <td width=";"> {{$a->name}} </td>

                                            <td width=";"> 
                                                <span data-toggle="tooltip" title="{{$a->description}}" style="cursor: help;">
                                                    {{
                                                        (strlen($a->description)) > 60 ? substr($a->description,0,60).'..' : $a->description 
                                                    }}
                                                </span>
                                            </td>

                                            <td width="">
                                                {{ number_format($a->price,2) }}
                                            </td>
                                            
                                            <td width="">
                                                {{  number_format($a->discount,2) }}
                                            </td>

                                            <td width=";" style="color:{{ $a->stat=='Active'?'red':''}} ;"> 
                                                &nbsp;
                                                {{ ($a->stat) ? 'Active' : 'In-Active'}} 

                                            </td>


                                            <td width=";">

                                                <form onsubmit="return confirm('Are you sure you want to delete selected record?')" class="form-inline my-2 my-lg-0" method="POST" action="{{route('products.destroy', $a->pk_products)}}" >
                                                    
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}

                                                    <a href="{{route('products.edit', $a->pk_products)}}" class="btn btn-default notika-btn-default waves-effect">
                                                        Edit
                                                    </a> &nbsp;

                                                    <button class="btn btn-default notika-btn-default waves-effect" type="submit"  >
                                                        <span class="text-danger">Delete</span>
                                                    </button>  &nbsp;

                                                </form>

                                            </td><!--END 150px-->

                                        </tr>

                                    @endforeach

                                </tbody>


                            </table><!--END table table-striped-->

                            
                            @if(count($products) > 0)

                                {{ $products->appends(
                                    ['search' => $search,]
                                )->links() }}

                            @endif


                        </div><!--END bsc-tbl-st-->

                    </div><!--END normal-table-list-->
                

                @else

                    @include('admin.layouts.nosearchfound')

                @endif
