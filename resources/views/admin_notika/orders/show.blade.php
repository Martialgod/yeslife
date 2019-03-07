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
                Show Page
            </p>
        </div>

    @endsection


   <div class="container">
        <div class="row" style="font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace; ">

          
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                
                <div class="normal-table-list sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                    
                    <div class="basic-tb-hd">

                        <div class="row">


                            <div class="col-md-8"> 
                                <p>
                                    Customer: {{$ordermstr->billingfname.' '.$ordermstr->shippingfname}}
                                </p>
                                <p>
                                    Shipping Address: {{$ordermstr->shipto}}

                                </p>
                                <p>
                                    Record Status: <b> {{$ordermstr->recordstat}} </b>
                                </p>
                            </div>

                  

                            <div class="col-md-4"> 
                                <p>Date: {{$ordermstr->created_at}}</p>
                                <p>Payment Stat: {{$ordermstr->paymentstat}}</p>
                                <p>Delivery Stat: {{$ordermstr->deliverystat}}</p>
                            </div>

                            
                        </div><!--END row-->


                    </div><!--END basic-tb-hd-->

                    <div class="bsc-tbl-st">
                        
                        <table class="table">
                            
                           <thead>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>UOM</th>
                                <th>Unit Price</th>
                                <th>Net Amount</th>
                            </thead>
                            
                            <tbody >
            
                                @foreach($orderdtls as $key=> $v)

                                    <tr>
                                        
                                        <td>
                                            {{$v->fk_products}}
                                        </td>
                                        <td>
                                            {{$v->name}}
                                        </td>

                                        <td>
                                            {{$v->qty}}
                                        </td>
                                        <td>
                                            {{$v->uom}}
                                        </td>
                                        <td>
                                            {{$v->unitprice}}
                                        </td>
                                        <td>
                                            {{$v->netamount}}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                            <tfoot>
                                <th></th>
                                <th></th>
                                <th>{{$ordermstr->totalqty}}</th>
                                <th></th>
                                <th></th>
                                <th>{{$ordermstr->netamount}}</th>
                            </tfoot>


                        </table><!--END table table-striped-->


                    </div><!--END bsc-tbl-st-->

                </div><!--END normal-table-list-->

                <br><br>
                <hr>
                <a href="{{route('orders.index')}}" class="btn btn-default notika-btn-default waves-effect">
                    <i class="fa fa-arrow-left" aria-hidden="true"> Back</i>
                </a>
        
                

            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')


@endsection



    