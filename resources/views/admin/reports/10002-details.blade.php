{{-- style="overflow-y:scroll; display:block;height:500px;" --}}
<div class="table-responsive"  >

    <table class="table table-hover">
        
        <thead>

            <tr>
               	<th>Order Number</th>
               	<th>Buyer Full Name</th>
                <th>Buyer First Name</th>
                <th>Buyer Last Name</th>
                <th>Recipient Full Name</th>
                <th>Recipient First Name</th>
                <th>Recipient Last Name</th>
                <th>Recipient Phone</th>
                <th>Address Line 1</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Item Quantity</th>
                <th>Order Created Date</th>
                <th>Order Requested Shipping Service</th>
                <th>Order Total Weight(oz)</th>
                <th>Buyer Phone</th>
                <th>Country Code</th>
                <th>Item SKU</th>
                <th>Item Name</th>
                <th>Item Weight(oz)</th>
                <th>Length</th>
                <th>Width</th>
                <th>Height</th>
                <th>Item Options</th>
                <th>Item Warehouse Location</th>
     
            </tr>

      	</thead>
      	
      	<tbody>

            @foreach($result as $a)

                <tr>
                    <td> {{$a->trxno}}  </td>

                    <td> {{$a->billingfullname}} </td>

                    <td> {{$a->billingfname}} </td>

                    <td> {{$a->billinglname}} </td>

                    <td> {{$a->shippingfullname}} </td>

                    <td> {{$a->shippingfname}} </td>

                    <td> {{$a->shippinglname}} </td>

                    <td> {{$a->shippingphone}} </td>

                    <td> {{$a->shippingaddress1}} </td>

                    <td> {{$a->shippingcity}} </td>

                    <td> {{$a->shippingstate}} </td>

                    <td> {{$a->shippingzip}} </td>

                    <td> {{$a->qty}} </td>

                    <td> {{ date_format( date_create($a->created_at), 'Y-m-d' )}} </td>

                    <td> {{$a->shippingservice}} </td>

                    <td> {{$a->totalweight}} </td>

                    <td> {{$a->billingphone}} </td>

                    <td> {{$a->countrycode}} </td>

                    <td> {{$a->sku}} </td>

                    <td> {{$a->itemname}} </td>

                    <td> {{$a->weight}} </td>

                    <td> {{$a->length}} </td>
                        
                    <td> {{$a->width}} </td>

                    <td> {{$a->height}} </td>

                    <td> {{$a->options}} </td>

                    <td> {{$a->warehouse}} </td>

                </tr>

              

            @endforeach
          
  		</tbody>


  	</table><!--END table table-hover-->

</div><!--END table-responsive-->

@include('admin.reports.generated')

