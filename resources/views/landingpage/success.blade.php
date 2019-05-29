@extends('landingpage.layouts.master')



@section('title', 'YesLife Order Success Page')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



@endsection

@section('optional_styles')
		
	<script data-obct type="text/javascript">
	    /** DO NOT MODIFY THIS CODE**/
	    !function(_window, _document) {
	      var OB_ADV_ID='00f8c14969788d63b6869a2e8a86d80aee';
	      if (_window.obApi) {var toArray = function(object) {return Object.prototype.toString.call(object) === '[object Array]' ? object : [object];};_window.obApi.marketerId = toArray(_window.obApi.marketerId).concat(toArray(OB_ADV_ID));return;}
	      var api = _window.obApi = function() {api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);};api.version = '1.1';api.loaded = true;api.marketerId = OB_ADV_ID;api.queue = [];var tag = _document.createElement('script');tag.async = true;tag.src = '//amplify.outbrain.com/cp/obtp.js';tag.type = 'text/javascript';var script = _document.getElementsByTagName('script')[0];script.parentNode.insertBefore(tag, script);}(window, document);
	    obApi('track', 'PAGE_VIEW');
  	</script>

@endsection

	
@section('content-body')

				    
	<div class="page-banner-section" style="text-align: center;">

		<div class="error-404">  	
			
			<div class="error-page-left">
			
				<h3>
    				Thank you for your purchase!
    			</h3>
    			<br>
			</div>

			<div class="error-right">
		    	
	    		<div class="col-12" style="text-align:center">

	    
	    			<p>
	    				Your Confirmation # is: <b> {{ $orders->trxno }} </b>
	    			</p>

	    			<p>
	    				Billing Address
	    				<br>
	    				<b> {{$orders->billto}} </b>

	    			</p>

	    			<p>
	    				Shipping Address
	    				<br>
	    				<b> {{$orders->shipto}} </b>

	    			</p>

	    			<p>
	    				Phone Number
	    				<br>
	    				<b> {{$orders->billingphone}} </b>
	    			</p>

	    			<p>
	    				
	    				You will receive an order confirmation email with details of your order.

	    			</p>

	    			{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

	    			<a href="{{url('/shop')}}{{$refnourl}}" class="btn btn-round btn-lg"> 
	    				Continue Shopping
	    			</a>
                   
                </div>
		    	

			</div>
		</div>


	</div><!--END row-->

	<br>



    

@endsection



@section('optional_scripts')

	<script type="text/javascript">

		@php 

			//echo 'alert(1);';

		@endphp



	</script>


	
		

@endsection



	


	


				    
