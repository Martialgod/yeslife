@extends('admin.layouts.master')

@section('title', 'Admin Product Compositions Page')

@section('optional_styles')

	<script src="/customjs/ProductCompositionsController.js?v{{time()}}" type="text/javascript"></script>
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/products')}}" title="" style="color:#68AE00;">Product</a> 
		<span style="font-size: 16px;"> / Compositions </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row" id="main-div" ng-app="app" ng-controller="ProductCompositionsController as vm" ng-cloak>


	    <input type="hidden" name="pk_products" id="pk_products" value="{{$products->pk_products}}">


        <div class="col-md-6"> 

        	<div class="well">

        		<p>
                    <b>Product ID: </b> {{$products->pk_products}}
                </p>

                <p>
                	<b>Product Name: </b> {{$products->name}}
                	
                </p>
        		
        	</div>


        	<input type="text" name="" placeholder="search here..." ng-model="vm.search" ng-change="vm.Search()" ng-model-options="{debounce: 500}" class="form-control col-md-4"  >


			<table class="table" style="overflow-y:scroll; display:block;height:400px">
    			
    			<tbody>
    					
    				<tr ng-repeat="list in vm.searchitems">

    					<td>
    						<img style="" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="" width="40px;" height="40px;">
    					</td>

    					<td> @{{list.name}} </td>
    					
    					<td>
    						
    						<button type="button" name="" ng-click="vm.AddCompositions(list)" class="btn btn-info btn-sm" >  <i class="fa fa-plus"></i> </button>

    					</td>

    				</tr>	

    			</tbody>

    		</table>


        	
        </div><!--END col-md-4-->


    	<div class="col-md-6">

        	<div class="table-responsive" ng-if="vm.compositions.length > 0">
        
		        <table class="table table-hover">
		            
		            <thead>

		                <tr>
		                   	<th></th>
		                    <th>Name</th>
		                    <th>Qty</th>
		                    <th></th>
		              	</tr>

		          	</thead>

		          	
		          	<tbody>

		          		<tr ng-repeat="list in vm.compositions">

		          			<td>
	    						<img style="" ng-src="{{asset('/storagelink')}}/@{{list.pictxa}}" alt="" width="40px;" height="40px;">
	    					</td>

	    					<td> @{{list.name}} </td>

	    					<td>
	    						<input type="number" name="" ng-model="list.qty" ng-change="vm.isNumber(list, 'qty')" ng-model-options="{debounce: 500}" class="form-control col-md-4" string-to-number >
	    					</td>
	    					
	    					<td>
	    						
	    						<button type="button" name="" ng-click="vm.RemoveCompositions(list)" class="btn btn-danger btn-sm" >  <i class="fa fa-times"></i> </button>

	    					</td>

		          			
		          		</tr>

		      		</tbody>


			  	</table><!--END table table-hover-->


			</div><!--END table-responsive-->

		  	<div ng-if="vm.compositions.length == 0">
		  		<img src="/adminpage/images/nosearchfound.png" alt="">
		  	</div>

		  	<div class="row"></div>
			
	       	<hr>
	    	<button class="btn btn-success hvr-underline-from-left" ng-click="vm.SubmitCompositions()" >
			  Submit
			</button>

		

        </div><!--END col-md-8-->


	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/products'])

@endsection



@section('optional_scripts')

	<script type="text/javascript">


		
	</script>

@endsection



	


				    