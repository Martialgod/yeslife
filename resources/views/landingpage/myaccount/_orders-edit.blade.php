

@if(count($coupons) > 0)

    
    <tr>
        <td></td>

        <td></td>

        <td><b>Sub Total</b></td>

        <td> <b> ${{$orders->totalamount}} </b></td>

    </tr>

    @foreach($coupons as $c)

        <tr>
        
            <td>Coupons</td>
            <td></td>
            <td>
                {{$c->code}}
            </td>
            <td>

                <span style="color:red" >
                    @if($c->type == 'Fixed')
                        - ${{$c->amount}} 
                    @else  
                        - {{$c->amount}}% 
                    @endif 
                    
                </span>

            </td>
        </tr>

    @endforeach

    <tr>
        <td></td>

        <td></td>

        <td><b>Grand Total</b></td>

        <td><b> ${{$orders->netamount}} </b> </td>

    </tr>


@else


    <tr>
        <td></td>

        <td></td>

        <td><b>Grand Total</b></td>

        <td> <b>${{$orders->netamount}}</b> </td>

    </tr>
 
@endif
