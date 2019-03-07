@extends('landingpage.layouts.master')

@section('title', 'YesLife Shop')

@section('optional_styles')
	

@endsection

	
@section('content-body')

	<div class="row" id="main-div" >

        <div class="col-md-6" >

        	<form action="#" method="post" id="form-addcart" name="form-addcart" class='add-to-cart'>

        		{{method_field('POST')}}
			    {{ csrf_field() }}

        		<h1>{{$products->name}}</h1>

	        	<br>

        	   	{{$products->price}}

        	   	<br>

	        	{!! $products->description !!}

	        	<br>

	        	<img style="width: 50%; height:50%;" src="{{asset('/storagelink/'.$products->pictxa)}}" alt="">
           
                <input type="hidden" name="productid" value="{{$products->pk_products}}">
                <input type="hidden" name="productname" value="{{$products->name}}">
                <input type="hidden" name="qty" value="1">

                <br><br>
                <button type="submit" id="btnaddcart" class="btn btn-default"  > ADD TO CART </button>

              	<button type="button" class="btn btn-danger" onclick="removeCartCookie({{$products->pk_products}})" > Remove</button>
       
            </form>

        	

		</div><!--END col-md-6-->


		<div class="col-md-4 " >


			@include('admin.layouts.alert')


        	<h1> Reviews</h1>

        	<br>

        	@if(Auth::check())


				<form method="POST" class="jqvalidate-form" action="{{url('/shop/'.$products->pk_products.'/reviews')}}" >

				    {{method_field('POST')}}
			        {{ csrf_field() }}

			        <div class="form-group">
			        	<label for="email">Email</label><span class="label-required">*</span>
				    	<input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{Auth::user()->email}}" readonly="">
			        </div>

			        <div class="form-group">
			        	<label for="email">Fullname</label><span class="label-required">*</span>
				    	<input type="text" class="form-control" id="text" name="text" placeholder="" required="" value="{{Auth::user()->fullname}}" readonly="">
			        </div>


	        		<div class="form-group">
					    <label for="star">Ratings <span class="label-required">*</span> </label>
					    <select name="star" id="star" class="form-control">
					    	@for($i=5; $i>=1; $i--)
					    		<option value="{{$i}}"> {{$i}} </option>}
					    	@endfor
					    </select>

					</div>


					<div class="form-group">
		                <label for="comments">Review <span class="label-required">*</span> </label>
		                <textarea class="form-control" id="comments" name="comments" placeholder="" required="" rows="5" style="resize: none;" >{{old('comments')}}</textarea>
			          		            
			        </div>

			        <button type="reset" class="btn btn-warning hvr-underline-from-left">Reset</button>
					<button type="submit" class="btn btn-success hvr-underline-from-left">Submit</button>


			        

		    	</form>


        	@endif

        	<br><hr>
        	<ul>
        		
	        	@foreach($reviews as $v)

	        		<li>
	        			{{$v->stars}}
	        			{{$v->comments}}
	        			<br>
	        			<span style="font-size: 10px;">
	        				{{$v->fullname}} | {{$v->email}} 
	        				<br>
	        				{{ date_format( date_create($v->created_at), 'M d, Y' ) }}
	        			</span>
	        			
	        			
	        			
	        		</li>
	        	
	        	@endforeach

        	</ul>

        	<br>
		    @if(count($reviews) > 0)
		    	<div class="pagination-margin-top">
		    		{{ $reviews->appends(
		            	['search' => '',]
		        	)->links() }}
		    	</div>
		    @endif


		</div><!--END col-md-4-->


	
	</div><!--END row-->


@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection