@extends('admin.layouts.master')

@section('title', 'Admin Products Price List Page')

@section('optional_styles')
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/products')}}" title="" style="color:#68AE00;">Products</a> 
		<span style="font-size: 16px;"> / Price List </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">


	        <div class="col-md-4 well"> 

	        	<p>
	        		<input type="hidden" id="totalusertype" name="totalusertype" value="{{count($pricelist)}}">	
	        	</p>

        		<p>
                    <b>Product ID: </b> {{$products->pk_products}}
                </p>

                <p>
                	<b>Product Name: </b> {{$products->name}}
                	
                </p>

               
               	<br>
           		<div class="input-group">
            		<span class="input-group-btn">
				    	<span class="btn btn-default"> <b> Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;</b> </span>
				    </span>
			      	<input type="number" min="0" step="any" class="form-control" id="initialprice" name="initialprice" placeholder="" required="" value="{{$products->price}}">
				    <span class="input-group-btn">
				    	<button class="btn btn-danger" id="btninitialprice" type="button"> Apply All</button>
				    </span>
			    </div><!-- /input-group -->

             
            	
			    <br>
            	<div class="input-group">
            		<span class="input-group-btn">
				    	<span class="btn btn-default"> <b> Discount % </b> </span>
				    </span>
			      	<input type="number" min="0" max="100"  step="any" class="form-control " id="initialdiscount" name="initialdiscount" placeholder="" required="" value="{{$products->discount}}">
				    <span class="input-group-btn">
				    	<button class="btn btn-danger" id="btninitialdiscount" type="button">Apply All</button>
				    </span>
			    </div><!-- /input-group -->

			    <br>
                <p style="text-align: center;">
                	<img src="{{asset('/storagelink/'.$products->pictxa)}}" alt="" style="width:;">
                </p>

            </div><!--END col-md-4-->


            <form method="POST" id="jqvalidate-form pricelist-form" name="pricelist-form" class="swa-confirm"  action="{{route('products.pricelist', $products->pk_products)}}" enctype="multipart/form-data" >

			    {{method_field('POST')}}
		        {{ csrf_field() }}


		    	<div class="col-md-8">

		        	<div class="table-responsive">
		        
				        <table class="table table-hover">
				            
				            <thead>

				                <tr>
				                   	<th>User Type</th>
				                    <th>Price</th>
				                    <th>Discount % </th>
				              	</tr>

				          	</thead>

				          	
				          	<tbody>

				          		@php 
				          			//determine pricelist index number; use in apply all button
				          			$pindex = 0; 
				          		@endphp

				                @foreach($pricelist as $a)

				                    <tr>

				                        <td> 
				                        	
				                        	<input type="hidden" class="form-control" name="fk_usertype[]" placeholder="" required="" value="{{$a->pk_usertype}}">

				                        	{{$a->usertype}} 

				                        </td>

				                        <td class="col-md-3"> 

				                        	<input type="number" min="0" step="any" class="form-control" id="{{$pindex}}price" name="price[]" placeholder="" required="" value="{{$a->price}}">

				                        </td>

				                        <td class="col-md-3">

				                        	<input type="number" min="0" max="100"  step="any" class="form-control "  id="{{$pindex}}discount"  name="discount[]" placeholder="" required="" value="{{$a->discount}}">

				                        </td>

				                    </tr>


				                    @php 
				                    	//determine pricelist index number; use in apply all button
				                    	$pindex++;
				                    @endphp
				                  

				                @endforeach
					          
				      		</tbody>


					  	</table><!--END table table-hover-->

					</div><!--END table-responsive-->

					<div class="row"></div>
					
			       	<hr>
			    	@include('admin.layouts.buttonsubmit')
				

		        </div><!--END col-md-8-->


			</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/products'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">


		$(document).ready(function(){

			let totalusertype = parseFloat($('#totalusertype').val().trim());

			$('#btninitialprice').on('click', function(){


				let price = $('#initialprice').val();

				if( isNaN(price) || price == undefined || price == '' || parseFloat(price) < 0 ){
					swal('Opps!', 'Invalid Amount', 'error');
					$('#initialprice').val('0.00');
					return;
				}

				//apply to all price
				for(var i=0; i<totalusertype; i++){

					$('#'+i+'price').val(price);

				}

			
			});

			$('#btninitialdiscount').on('click', function(){

				let discount = $('#initialdiscount').val();

				if( isNaN(discount) || discount == undefined || discount == '' || parseFloat(discount) < 0 || parseFloat(discount) > 100 ){
					swal('Opps!', 'Invalid Amount', 'error');
					$('#initialdiscount').val('0.00');
					return;
				}

				//apply to all price
				for(var i=0; i<totalusertype; i++){

					$('#'+i+'discount').val(discount);

				}

				
			});

		
		});



		
	</script>

@endsection



	


				    