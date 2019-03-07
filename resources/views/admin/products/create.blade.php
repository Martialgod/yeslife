@extends('admin.layouts.master')

@section('title', 'Admin Products Create Page')

@section('optional_styles')
	

	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
	

@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/products')}}" title="" style="color:#68AE00;">Products</a> 
		<span style="font-size: 16px;"> / New </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">

		<form method="POST" class="swa-confirm "  action="{{route('products.store')}}" enctype="multipart/form-data" >

		    {{method_field('POST')}}
	        {{ csrf_field() }}

        	<div class="col-md-4">


		        <div class="form-group">
	                <label for="name">Product Name <span class="label-required">*</span> </label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="" required="" max="255" value="{{old('name')}}">
		        </div>



		        <div class="form-group">
	                <label for="slug">Slug <span class="label-required">*</span> </label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="" required="" max="255" value="{{old('slug')}}">
		            
		        </div>


		        <div class="form-group">
	                <label for="description">Product Description <span class="label-required">*</span> </label>
	                <textarea class="form-control trumbowyg" id="description" name="description" placeholder="" required="" rows="5" style="resize: none;" >{{old('description')}}</textarea>
		          		            
		        </div>


		        

			</div><!--END col-md-4-->


			<div class="col-md-4">

				<div class="form-group">
	                <label for="price">Default Price <span class="label-required">*</span> </label>
	                <input type="number" min="0" step="any" class="form-control" id="price" name="price" placeholder="" required="" value="{{old('price') ? old('price') : 0 }}">
		        </div>


		        <div class="form-group">
	                <label for="discount">Discount % </label>
	                <input type="number" min="0" max="100"  step="any" class="form-control" id="discount" name="discount" placeholder="" required="" value="{{old('discount') ? old('discount')  : 0 }}">
		        </div>


		        <div class="form-group">
	                <label for="taxrate">Tax Rate % </label>
	                <input type="number" min="0" max="100"  step="any" class="form-control" id="taxrate" name="taxrate" placeholder="" required="" value="{{old('taxrate') ? old('taxrate') : 0}}">
		        </div>


		        <div class="form-group">
	                <label for="shippingcost">Shipping Cost </label>
	                <input type="number" min="0" step="any" class="form-control" id="shippingcost" name="shippingcost" placeholder="" required="" value="{{old('shippingcost') ? old('shippingcost') : 0}}">
		        </div>



				<div class="form-group">
		            <label for="qty">Stock on hand </label>
		            <input type="number" min="0" step="any" class="form-control" id="qty" name="qty" placeholder="" required="" value="{{old('qty') ? old('qty') : 0}}">
		        </div>

		        {{--<div class="form-group">
		            <label for="alertqty"> Inventory critical level </label>
		            <input type="number" min="0" step="any" class="form-control" id="alertqty" name="alertqty" placeholder="" required="" value="{{old('alertqty') ? old('alertqty') : 0}}">
		        </div>--}}




		        <div class="form-group">
		            <label for="uom">Unit of Measure <span class="label-required">*</span> </label>
		            <input type="text" class="form-control" id="uom" name="uom" placeholder="" required="" max="6" value="{{old('uom') ? old('uom') : 'bottle'}}">
		        </div>

		        <div class="form-group">
		            <label for="fk_category">Product Category <span class="label-required">*</span> </label>
		            <select name="fk_category" id="fk_category" class="form-control" required="">
		                @foreach($category as $key => $v)
		                    <option value="{{$v->pk_category}}" {{ ($v->pk_category == old('fk_category') ) ? 'selected' :'' }}> {{$v->description}} </option>
		                @endforeach
		            </select>
		          
		        </div>


		        <div class="form-group">
	                <label for="videoshare">Youtube Video Id </label>
	                <input type="text" class="form-control" id="videoshare" name="videoshare" placeholder="tgbNymZ7vqY" value="{{old('videoshare')}}">
		            
		        </div>

			</div><!--END col-md-4-->


			<div class="col-md-4">
				

		        <div class="form-group">
	                <label for="pictxa"> Cover Photo </label> <br>
	                <input type="file" class="" id="pictxa" name="pictxa"  placeholder=""  value="">
		        </div>




		        <div class="form-group">
		            <label for="gallery">Photo Gallery  </label> <br>
		            <input multiple="" type="file" class="" id="gallery" name="gallery[]" placeholder=""  value="">
		        </div>

			
		        <br>
		    	@include('admin.layouts.buttonsubmit')
		
	        
			</div><!--END col-md-4-->


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/products'])

@endsection



@section('optional_scripts')

  	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    