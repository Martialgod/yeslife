@extends('admin.layouts.master')

@section('title', 'Admin Orders List Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')
        
        <div class="breadcomb-icon">
            <a href="{{route('orders.index')}}">
                <i class="fa fa-opencart fa" aria-hidden="true"></i>
            </a>
        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('orders.index')}}" class="text-success">
                    Orders List
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

                        @if( count($orders) > 0 )

                            <div class="bsc-tbl-st">
                                
                                <table class="table">
                                    
                                       <thead>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Bill To</th>
                                            <th>Total Item</th>
                                            <th>Net Amount</th>
                                            <th>Ship To</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                    
                                    <tbody >
                    
                                        @foreach($orders as $a)

                                            <tr>
                                                
                                                <td width=";"> 
                                                
                                                    {{$a->pk_ordermstr}} 
                                                    @if( !$a->isopen && $a->recordstat == 'Active' )
                                                        &nbsp;
                                                        <span class="badge alert-success" style="font-size: 12px;">
                                                           New 
                                                        </span>

                                                    @endif
                                                   
                                                </td>

                                                <td width=";"> 
                                                    {{ 
                                                        date_format(date_create($a->created_at), 'M d, Y')
                                                    }} 
                                                </td>

                                                <td width=";"> 
                                                    <span data-toggle="tooltip" title="{{$a->billto}}" style="cursor: help;">
                                                        {{
                                                            (strlen($a->billto)) > 20 ? substr($a->billto,0,20).'..' : $a->billto 
                                                        }}
                                                    </span>
                                                </td>



                                                <td width=";"> 
                                                    {{ number_format($a->totalitem, 2)}} 
                                                </td>

                                              

                                                <td width=";"> 
                                                    {{ number_format($a->netamount, 2)}} 
                                                </td>

                                                <td>
                                                    <span data-toggle="tooltip" title="{{$a->shipto}}" style="cursor: help;">
                                                        {{
                                                            (strlen($a->shipto)) > 20 ? substr($a->shipto,0,20).'..' : $a->shipto 
                                                        }}
                                                    </span>
                                                </td>

                                                <td width=";"> 
                                                    {{ $a->deliverystat }} 
                                                </td>

                                                <td width=";" style="color:{{ $a->recordstat=='Active'?'green':'red'}} ;"> 
                                                    &nbsp;
                                                    {{ $a->recordstat }}


                                                </td>

                                                <td width=";"> 
                                                   
                                                        <div class="dropdown">
                                                            
                                                            <button class="btn btn-teal teal-icon-notika btn-reco-mg btn-button-mg waves-effect dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-cogs "></i>
                                                            </button>

                                                            <ul class="dropdown-menu" role="menu">

                                                                <li role="presentation" >
                                                                    
                                                                    <a href="{{route('orders.show', $a->pk_ordermstr)}}" class="btn btn-default notika-btn-default waves-effect col-md-12"  >
                                                                        View Order
                                                                    </a>

                                                                    
                                                                </li>

                                                                <li role="presentation" >


                                                                    <form class="swa-confirm form-inline my-2 my-lg-0" method="POST" action="{{url('/admin/orders/updatestat/'.$a->pk_ordermstr)}}?btnaction=deliverystat" >
                                                                        
                                                                        {{method_field('POST')}}
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="deliverystat" value="{{$a->deliverystat}}" readonly="" >

                                                                        @if( $a->deliverystat == 'For Delivery' )

                                                                            <button name="btnaction" class="btn btn-default notika-btn-default waves-effect col-md-12"  type="submit" value="deliverystat" >
                                                                               Mark as Delivered
                                                                            </button>

                                                                        @else

                                                                            <button name="btnaction" class="btn btn-default notika-btn-default waves-effect col-md-12"  type="submit" value="deliverystat">
                                                                               Mark as For Delivery
                                                                            </button>

                                                                        @endif

                                                                       
                                                                        <br>


                                                                    </form>

                                                                   
                                                                </li>



                                                                <li role="presentation" >

                                                                    <form class="swa-confirm form-inline my-2 my-lg-0" method="POST" action="{{url('/admin/orders/updatestat/'.$a->pk_ordermstr)}}?btnaction=recordstat" >
                                                                        
                                                                        {{method_field('POST')}}
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="stat" value="{{$a->recordstat}}" readonly="" >

                                                                        @if( $a->recordstat == 'Active' )

                                                                            <button name="btnaction" class="btn btn-danger notika-btn-danger waves-effect col-md-12" value="stat"  type="submit" >
                                                                               Mark as Cancelled
                                                                            </button>

                                                                        @else

                                                                            <button name="btnaction"  class="btn btn-success notika-btn-success waves-effect col-md-12" value="stat" type="submit" >
                                                                               Mark as Active
                                                                            </button>

                                                                        @endif

                                                                       
                                                                        <br>

                                                                    </form>

                                                                </li>


                                                            </ul><!--END dropdown-menu-->

                                                          
                                                        </div><!--END dropdown-->

                                                </td>


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
                
                
                @if(count($orders) > 0)

                    {{ $orders->appends(
                        ['search' => $search,]
                    )->links() }}

                @endif


            </div>


        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    