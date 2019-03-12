<div class="table-responsive">

    <table class="table table-hover">
        
        <thead>

            <tr>
               	<th>Tracking</th>
               	<th>Date</th>
                <th>Billto</th>
                <th>Shipto</th>
                {{-- <th>Item(s)</th> --}}
                <th>SubTotal</th>
                <th>Tax</th>
                <th>Shipping</th>
                <th>GrandTotal</th>
                {{--<th>Status</th> --}}
          	</tr>

      	</thead>
      	
      	<tbody>

            @foreach($result as $a)

                <tr>
                    <td> {{$a->trxno}}  </td>

                    <td> {{ date_format( date_create($a->created_at), 'Y-m-d' )}} </td>

                    <td> {{$a->billto}} </td>

                    <td> {{$a->shipto}}  </td>

                    {{-- <td> {{$a->totalitem}}  </td> --}}

                    <td> {{$a->totalamount}}  </td>

                    <td> {{$a->totaltax}}  </td>

                    <td> {{$a->totalshipcost}}  </td>

                    <td> {{$a->netamount}}  </td>


                    {{--<td>
                    	
                	    @if( $a->isapproved == 1 )
                	       
                	       {{$a->paymentstatus}}

                	    @elseif( $a->isdeclined == 1 )

                	    	Declined

                	    @else

                	    	Pending

                	    @endif
                                 
                    </td> --}}
                   
                </tr>

              

            @endforeach
          
  		</tbody>


  	</table><!--END table table-hover-->

</div><!--END table-responsive-->

@include('admin.reports.generated')

