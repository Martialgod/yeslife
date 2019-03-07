@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop')

@section('optional_styles')

	<script src="/customjs/ShopController.js?v={{time()}}" type="text/javascript"></script>
	
@endsection

	
@section('content-body')


	<div class="row" id="main-div" ng-app="app" ng-controller="ShopController as vm" >
			
		<h2>Sample Shop Index Page</h2> 


        <div class="col-md-4">

        	<div class="form-group">

                <input type="text" placeholder="search here..." class="form-control" ng-model="vm.search" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}"  >
              
            </div>
        	
        </div>


        <div class="col-md-12" >


    		<div class="col-md-3" ng-repeat="list in vm.mscproducts">

    			<h1>@{{list.name}}</h1>

	        	<br>

        	   	@{{list.discountedprice}}

	        	<br>

	        	<img style="width: 50%; height:50%;" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="">
           
                <input type="hidden" name="productid" value="list.productid">
                <input type="hidden" name="productname" value="list.name">
                <input type="hidden" name="qty" value="list.selectedqty" >

                <br><br>
                <button type="submit" class="btn btn-default" ng-click="vm.AddToCart(list)" > ADD TO CART </button>

              	<button type="button" class="btn btn-danger" ng-click="vm.RemoveFromCart(list)"> Remove</button>


        	</div>



		</div><!--END col-md-12-->


		<div class="row"></div>


		<div class="col-md-4 " >
			<hr>
			<button class="btn btn-primary" ng-disabled="!vm.navlinks.next" ng-click="vm.LoadProducts(vm.navlinks.next)" >
				Load More
			</button>
			
		</div>

	
	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    