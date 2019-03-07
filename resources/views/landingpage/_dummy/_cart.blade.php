@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop')

@section('optional_styles')

	<script src="/customjs/CartCheckoutController.js?v={{time()}}" type="text/javascript"></script>
	
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row" id="main-div" ng-app="app" ng-controller="CartCheckoutController as vm" >
			
		<h2>Sample Cart Page</h2> 

		{{--style="overflow-y:scroll; display:block;height:300px" --}}
        <div class="col-md-8" ng-if="vm.isoncart" >


    		<span ng-if="vm.mscproducts.length == 0">
    			@{{vm.statusmsg}}
    		</span>

    		<table class="table" ng-if="vm.mscproducts.length > 0">
    			<thead>
    				<tr>
    					<th></th>
    					<th>Item(s)</th>
    					<th>Qty</th>
    					<th>Unit Price</th>
    					<th>Total Price</th>
    					<th></th>
    				</tr>
    			</thead>

    			<tfoot>
    				<th></th>
    				<th></th>
    				<th></th>
    				<th></th>
    				<th></th>
    				<th></th>
    			</tfoot>

    			<tbody>
    				<tr ng-repeat="list in vm.mscproducts">

    					<td>
    						<img style="width:40px;height: 40px;" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="">
    					</td>
    					<td> @{{list.name}} </td>
    					<td> 
    						<input type="number" min="1" name="qty" ng-model="list.selectedqty" string-to-number ng-change="vm.UpdateCart(list)" ng-model-options="{debounce: 200}" >
    					</td>
    					<td> $@{{list.discountedprice}} </td>
    					<td> 
    						$@{{list.totalamount}} 
    					</td>

    					<td>
    						
    						<button name="" ng-click="vm.RemoveFromCart(list)" class="btn btn-sm btn-danger"> Remove </button>

    					</td>

    				</tr>

    				<tr>
    					<td></td>
    					<td></td>
    					<td></td>
    					<td></td>
    					<td> 
    						<b> 
    							$@{{vm.totalamount}} 
    						</b> 
    					</td>
    					<td></td>
    					
    				</tr>

    				<tr ng-if="vm.msccoupons.length >0 ">

    					<td></td>
    					<td></td>
    					<td>Coupons</td>
    					<td></td>
    					<td></td>
    					<td></td>
    					
    				</tr>


    				<tr ng-repeat="list in vm.msccoupons ">

    					<td></td>
    					<td></td>
    					<td>@{{list.code}} </td>
    					<td></td>
    					<td>
    						<span style="color:red" ng-if="list.type == 'Fixed'"> - $@{{list.amount}} </span>
    						<span style="color:red" ng-if="list.type == 'Rated'"> - @{{list.amount}}% </span>
    					</td>
    					<td>
    						<button name="" ng-click="vm.RemoveCoupons(list)" class="btn btn-sm btn-danger"> Remove </button>
    					</td>
    					
    				</tr>


    				<tr ng-if="vm.msccoupons.length >0 ">
    					<td></td>
    					<td></td>
    					<td></td>
    					<td></td>
    					<td> <b> $@{{vm.totalnetamount}} </b> </td>
    					<td></td>
    					
    				</tr>

    			</tbody>
    		</table>



		</div><!--END col-md-12-->


		<div class="row"></div>

		<div class="row" ng-if="vm.isoncart">

			<div class="col-md-2" ng-if="vm.mscproducts.length > 0">

				<form method="post" ng-submit="vm.ApplyCoupon($event)">
					<div class="form-group">
		                <label for="coupon"></label>
		                <input type="text" class="form-control" id="coupon" name="coupon" placeholder="coupon code" ng-model="vm.couponcode" maxlength="255">
		            </div>

					<button type="submit" class="btn btn-sm btn-primary"> Apply Coupon </button>
				</form>

			</div>


			<div class="col-md-6 pull-right" ng-if="vm.mscproducts.length > 0">
				<br>
				<button type="submit" class="btn btn-sm btn-success" ng-click="vm.ShowCheckout()"> Checkout </button>

			</div>
			
		</div>


		<div class="row">
			
		</div>

		<div class="col-md-8" id="divcheckout" hidden>

			@include('landingpage.checkout')
			
		</div>
	

	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">

        $(document).on('change','#billingcountry',function(){


            let fk_country = $('#billingcountry').val();
            $('#billingstatesdropdowndiv').show();
            $('#billingstatescustomdiv').hide();
            $('#billingcantfindstate').prop('checked', false);

            $('#billingstatescustom').val(null);

            //GlobalScript.js
            apigetstates('#checkout-div', '#billingstatesdropdown', fk_country);

        });//END #billingcountry on change

        $(document).on('change','#billingcantfindstate',function(){
          
           if( $(this).prop("checked") == true ){
            $('#billingstatesdropdowndiv').hide();
            $('#billingstatescustomdiv').show();
          }else{
            $('#billingstatesdropdowndiv').show();
            $('#billingstatescustomdiv').hide();
          }      

        });//END #billingcantfindstate on change


        $(document).on('change', '#shiptodifferentaddress', function(){
            if( $('#shiptodifferentaddress').is(":checked") )
            {
                // it is checked
                $('#divshippingaddress').show();
            }
            else{
                $('#divshippingaddress').hide();
            }
        });


        $(document).on('change','#shippingcountry',function(){

            let fk_country = $('#shippingcountry').val();
            $('#shippingstatesdropdowndiv').show();
            $('#shippingstatescustomdiv').hide();
            $('#shippingcantfindstate').prop('checked', false);

            $('#shippingstatescustom').val(null);

            //GlobalScript.js
            apigetstates('#checkout-div', '#shippingstatesdropdown', fk_country);


        });//END #shippingcountry on change

        $(document).on('change','#shippingcantfindstate',function(){
          
            if( $(this).prop("checked") == true ){
                $('#shippingstatesdropdowndiv').hide();
                $('#shippingstatescustomdiv').show();
            }else{
                $('#shippingstatesdropdowndiv').show();
                $('#shippingstatescustomdiv').hide();
            }      

        });//END #billingcantfindstate on change


        $(document).on('change','#isnewaccount',function(){

            if( $(this).prop("checked") == true ){
                $('#isnewaccountdiv').show();
            }else{
                $('#isnewaccountdiv').hide();
            }      

        });//END #billingcantfindstate on change


        $(document).ready(function(){
            $(".jqvalidate-form").validate({
                onfocusout: injectTrim($.validator.defaults.onfocusout)
            });

        });

        /*
            $.blockUI('#checkout-div');

            $.ajax({
                type: "GET",
                url: '/api/getstatebycountry/'+fk_country, //store on post
                data: {}, // 
                success: function(data){
                    
                  console.log(data);

                  let options = '';

                  data.forEach(function(item1, index1){
                    options = options + "<option value='"+ item1.name+"'>"  + item1.name +  "</option>";
                  });

                  $('#billingstatesdropdown').html(options); //update html options


                  $.unblockUI('#checkout-div');

                },
                error: function(data){
                  console.log(data);
                  console.log('error');

                  $.unblockUI('#checkout-div');

                }

            });//END $.ajax
        */


	</script>

@endsection



	


				    