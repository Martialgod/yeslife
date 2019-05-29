@extends('landingpage.layouts.master')



@section('title', 'YesLife Order Success Page')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



@endsection

@section('optional_styles')
		
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



	


	


				    
