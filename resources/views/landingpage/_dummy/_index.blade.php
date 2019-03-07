@extends('landingpage.layouts.master')

@section('title', 'YesLife Index')

@section('optional_styles')
	

@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row" id="main-div" >

        <div class="col-md-12" >

	        	<h2>Sample Index Page</h2> 

	        	@foreach($products as $key => $v)

	        		<div class="col-md-3">

	        			<form action="#" method="post" id="form-addcart" name="form-addcart" class='add-to-cart'>

			        		{{method_field('POST')}}
						    {{ csrf_field() }}


		        			<h1>{{$v->name}}</h1>

				        	<br>

			        	   	{{$v->discountedprice}}


				        	<br>

				        	<img style="width: 50%; height:50%;" src="{{asset('/storagelink/'.$v->pictxa)}}" alt="">
			           
			                <input type="hidden" name="productid" value="{{$v->pk_products}}">
			                <input type="hidden" name="productname" value="{{$v->name}}">
			                <input type="hidden" name="qty" value="1">

			                <br><br>
			                <button type="submit" id="btnaddcart" class="btn btn-default"  > ADD TO CART </button>

			              	<button type="button" class="btn btn-danger" onclick="removeCartCookie({{$v->pk_products}})" > Remove</button>


            			</form>


		        	</div>

	        	@endforeach

		</div><!--END col-md-12-->


		<div class="row"></div>


		<div class="col-md-4 ">
			<hr>
			<a href="{{url('/shop')}}" title="" class="btn btn-primary">
				Show More
			</a>
			
		</div>


	
	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    