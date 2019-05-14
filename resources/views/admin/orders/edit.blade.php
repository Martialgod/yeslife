@extends('admin.layouts.master')

@section('title', 'Admin Orders Edit Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/orders')}}" title="" style="color:#68AE00;">Orders</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('orders.update', $ordermstr->pk_ordermstr)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}


            @if( $ordermstr->isapproved == 0 && $ordermstr->fk_recurring != null && $ordermstr->isdeclined == 0  )
                <br>
                <div class="alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                    This is a recurring transaction that needs user approval. Note that the actual amount displayed may vary upon checkout...
                </div>


            @elseif( $ordermstr->isdeclined == 1 )

                <br>
                <div class=" alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                    This is a recurring transaction which the user declined...
                </div>


            @endif


            <div class="col-md-8"> 

            	<blockquote>

            		<p>
	                    <b>Bill To: </b> 
	                    <br>
	                    {{$ordermstr->billto}}
	                </p>
	                <p>
	                    <b>Ship To: </b> 
	                    <br>
	                    {{$ordermstr->shipto}}

	                </p>
            		
            		<p>
	                    <b>Phone Number:</b> 
	                    <br>
	                    {{$ordermstr->billingphone}}

	                </p>
            		
            	</blockquote>
               
        
            </div>

  

            <div class="col-md-4"> 

            	<blockquote>

	            	<p>
	                	<b>Date: </b>
	                	<br>
	                	{{$ordermstr->created_at}}
	                </p>
            		
            	</blockquote>
                

            </div>

            <div class="row">
            	
            </div>
            <hr>

	        <div class="col-md-12">

	        	<div class="table-responsive">
	        
			        <table class="table table-hover">
			            
			            <thead>

			                <tr>
			                   	<th>Products</th>
			                    <th>Qty</th>
			                    <th>Price</th>
			                    {{--<th>Discount</th>--}}
			                    {{--<th>Ship</th>
			                    <th>Tax</th> --}}
			                    <th>Total</th>
			                    <th>Status</th>
			              </tr>

			          	</thead>


			          	
			          	<tbody>

			                @foreach($orderdtls as $a)

			                    <tr>
			                        <td> {{$a->name}}  </td>

			                        <td> {{$a->qty}} </td>

			                        <td> ${{$a->unitprice}} </td>

			                        {{--<td> ${{$a->coupondisc}} </td>--}}

			                        {{--<td> ${{$a->shipamount}} </td>

			                        <td> ${{$a->taxamount}} </td> --}}

			                        <td> ${{$a->totalamount}} </td>

			                        <td>
		                        		<select name="fk_products[{{$a->fk_products}}]" class="">
			                        		@foreach($mscorderstatus as $key=> $x)
							            		<option value="{{$x->pk_recordstatus}}" {{ $x->pk_recordstatus == $a->fk_recordstatus ? 'selected' : '' }} >{{$x->name}}</option>
							            	@endforeach
			                        	</select>
			                        </td>


			                    </tr>


			                @endforeach



                            {{--<tr>
                                <td></td>
                                <td></td>
                                <td><b>Partial Amount</b></td>
                                <td><b>${{$ordermstr->totalamount}}</b></td>
                                <td></td>

                            </tr> --}}

                            @if(count($coupons) > 0)

                            	@foreach($coupons as $c)

	                                <tr>
	                                
	                                    <td>Coupons</td>
	                                    <td></td>
	                                    {{--<td></td>
	                                    <td></td> --}}
	                                    <td>{{$c->code}}</td>
	                                    <td>
	                                    	<span style="color:red" >
	                                            @if($c->type == 'Fixed')
	                                                - ${{$c->amount}} 
	                                            @else  
	                                                - {{$c->amount}}% 
	                                            @endif 
	                                            
	                                        </span>
	                                    </td>
	                                    <td></td>

	                                </tr>

	                            @endforeach


	                            <tr>
	                                <tr>
	                                    <td></td>
	                                    <td></td>
	                                    <td><b>Sub Total</b></td>
	                                    <td><b>${{$ordermstr->totalamount - $ordermstr->totalcoupon}}</b></td>
	                                    <td></td>
	                                    {{--<td></td>
	                                    <td></td> --}}
	                                </tr>
	                            </tr>

                            @endif

                         
                            <tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Sales Tax</b></td>
                                    <td><b>${{$ordermstr->totaltax}}</b></td>
                                    <td></td>
                                    {{--<td></td>
                                    <td></td> --}}
                                </tr>
                            </tr>

                            <tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Shipping Cost</b></td>
                                    <td><b>${{$ordermstr->totalshipcost}}</b></td>
                                    <td></td>
                                    {{--<td></td>
                                    <td></td> --}}
                                </tr>
                            </tr>


                            <tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Grand Total</b></td>
                                    <td><b>${{$ordermstr->netamount}}</b></td>
                                    <td></td>
                                    {{--<td></td>
                                    <td></td> --}}
                                </tr>
                            </tr>



				          
			      		</tbody>


				  	</table><!--END table table-hover-->

				</div><!--END table-responsive-->

	        	
	        </div><!--END col-md-12-->

	      	
      		<div class="row">
				
			</div>
			

            @if( $ordermstr->isapproved == 1 && $ordermstr->fk_recurring == null )
            	<hr>
	    		@include('admin.layouts.buttonsubmit')
            @endif

	       	

			
		</form>

	
	</div><!--END row-->


	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/orders'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    