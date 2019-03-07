@if( count($products) > 0 )

                            <div class="row">

                                @foreach($products as $a)
                                
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                        <img src="{{asset('/storage/'.$a->pictxa)}}" alt="" style="width:150px;height:100px">
                                        
                                        <br><br>

                                        <h1>{{$a->name}}</h1>

                                        {{--<span style="overflow-y:scroll; display:block;height:200px;width: 100%">
                                           {!! str_replace("\n", "<br>",  $a->description) !!}
                                        </span> --}}

                                        <span>
                                            {{ $a->description }}
                                        </span>

                                        <br><br>
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

                                    </div>
                                
                              
                                @endforeach

                                
                            </div><!--END row-->
                           

                        @else

                            @include('admin.layouts.nosearchfound')


                        @endif