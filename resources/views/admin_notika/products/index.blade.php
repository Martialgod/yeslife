@extends('admin.layouts.master')

@section('title', 'Admin Products List Page')

@section('optional_styles')
    


@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('products.create')}}" data-toggle="tooltip" title="Add Product">
               <i class="fa fa-plus "></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('products.index')}}" class="text-success">
                    Products List
                </a>
            </h2> 
            
            <p>
                Index Table 

            </p>

  
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

                <div class="normal-table-list sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                    
                    <div class="basic-tb-hd">
                        @include('admin.layouts.search')
                    </div><!--END basic-tb-hd-->

                    @if( count($products) > 0 )
                        
                        <div class="bsc-tbl-st">
                            
                            <table class="table">
                                
                                   <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Disc%</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Critical</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                
                                <tbody >
                
                                    @foreach($products as $a)

                                        <tr>
                                            <td width=";"> 
                                                
                                                <a href="{{url('/order/'.$a->pk_products)}}" title="">
                                                   {{$a->pk_products}}   
                                                </a>
                                               
                                            </td>
                                            <td width=";"> {{$a->name}} </td>

                                            <td width=";"> 
                                                <span data-toggle="tooltip" title="{{$a->description}}" style="cursor: help;">
                                                    {{
                                                        (strlen($a->description)) > 30 ? substr($a->description,0,30).'..' : $a->description 
                                                    }}
                                                </span>
                                            </td>

                                            <td>{{$a->slug}}</td>

                                            <td width=";"> {{$a->category}} </td>

                                            <td width="">
                                                {{ number_format($a->price,2) }}
                                            </td>
                                            
                                            <td width="">
                                                {{  number_format($a->discount,2) }}
                                            </td>

                                            <td>
                                               {{$a->qty}}
                                            </td>

                                            <td>
                                                {{$a->uom}}
                                            </td>

                                            <td>
                                               {{  number_format($a->alertqty) }}
                                            </td>


                                            <td width=";" style="color:{{ $a->recordstat == 'Active' ? 'green' : 'red'}} ;"> 
                                                &nbsp;
                                                {{ $a->recordstat }} 

                                            </td>


                                            <td width=";">

                                                <form class="form-inline my-2 my-lg-0 swa-confirm" method="POST" action="{{route('products.destroy', $a->pk_products)}}" >
                                                    
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}

                                                       <div class="dropdown">
                                                            
                                                            <button class="btn btn-teal teal-icon-notika btn-reco-mg btn-button-mg waves-effect dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-cogs "></i>
                                                            </button>

                                                            <ul class="dropdown-menu" role="menu">

                                                                <li role="presentation" >
                                                                    
                                                                    <a href="{{route('products.edit', $a->pk_products)}}" class="btn btn-default notika-btn-default waves-effect">
                                                                        Edit
                                                                    </a>

                                                                    
                                                                </li>

                                                                <li role="presentation" >
                                                                   <button class="btn btn-danger notika-btn-danger waves-effect col-md-12"  type="submit" >
                                                                       Delete
                                                                   </button>
                                                                    <br>
                                                                </li>

                                                               
                                                            </ul><!--END dropdown-menu-->

                                                          
                                                        </div><!--END dropdown-->




                                                </form>

                                            </td><!--END 150px-->

                                        </tr>

                                    @endforeach

                                </tbody>


                            </table><!--END table table-striped-->

                      
                        </div><!--END bsc-tbl-st-->

                     @else

                        @include('admin.layouts.nosearchfound')

                    @endif


                </div><!--END normal-table-list-->
            

  
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                @if(count($products) > 0)

                    {{ $products->appends(
                        ['search' => $search,]
                    )->links() }}

                @endif


            </div>


        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    