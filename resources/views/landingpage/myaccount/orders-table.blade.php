@php 
    $sourcearr = ( isset($sourcearr) ) ? $sourcearr : [];
@endphp

@if(count($sourcearr) > 0)


    <div class="cart-table table-responsive mb-30" >
        
        <table class="table">
            <thead class="">
                <tr>
                    <th>Track No.</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach($sourcearr as $v)

                    <tr>
                        
                        <td> 

                            {{--@if($v->isrecurring == 1)

                                <span data-toggle="tooltip" title="This is part of a recurring transaction" style="cursor: help;" class="fa fa-refresh text-danger" ></span>
                            
                            @endif--}}

                            {{$v->trxno}} 
                            
                        </td>

                        <td>
                            {{ date_format( date_create($v->created_at) , 'M d, Y' ) }}
                        </td>

                        <td> {{$v->totalitem}} </td>

                        <td> {{$v->netamount}} </td>

                        <td> 
                            {{$v->paymentstatus}} 
                            
                            @if( $v->isapproved == 0 && $v->isdeclined == 0  )
                                <span style="font-size: 10px;color:red">
                                    <br>
                                    *for approval*
                                </span>

                            @elseif( $v->isdeclined == 1 )
                                <span style="font-size: 10px;color:red">
                                    <br>
                                    *user declined*
                                </span>

                     
                            @endif
                        </td>

                        <td>
                            <a href="{{url('/myaccount/orders/'.$v->trxno)}}" class="btn btn-round custom-default-btn">Manage</a>
                        </td>

                    </tr>

                @endforeach
            
            </tbody>

        </table>


    </div><!--END myaccount-table table-responsive text-center-->

        
    <br>

    @if(count($sourcearr) > 0)
        <div class="text-center" >
            {{ $sourcearr->appends([])->links() }}
        </div>
    @endif



@else

    @include('landingpage.layouts.nodisplay')

@endif
                                    