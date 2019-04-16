@extends('admin.layouts.master')

@section('title', 'Admin Products Edit Page')

@section('optional_styles')

	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
	
@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/products')}}" title="" style="color:#68AE00;">Products</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')

	@include('admin.layouts.alert')

	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm" action="{{route('products.update', $products->pk_products)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-4">


		        <div class="form-group">
	                <label for="name">Product Name <span class="label-required">*</span> </label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="" required="" maxlength="255" value="{{$products->name}}">
		        </div>



		        <div class="form-group">
	                <label for="slug">Slug <span class="label-required">*</span> </label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="" required="" maxlength="255" value="{{$products->slug}}">
		            
		        </div>


		        <div class="form-group">
	                <label for="description">Product Description <span class="label-required">*</span> </label>
	                <textarea class="form-control trumbowyg" id="description" name="description" placeholder="" required="" style="resize: none;" >{{$products->description}}</textarea>
		          		            
		        </div>


		        <div class="form-group">
	                <label for="price">Default Price <span class="label-required">*</span> </label>
	                <input type="number" min="0" step="any" class="form-control" id="price" name="price" placeholder="" required="" value="{{$products->price}}">
		        </div>


		        <div class="form-group">
	                <label for="discount">Discount % </label>
	                <input type="number" min="0" max="100"  step="any" class="form-control" id="discount" name="discount" placeholder="" required="" value="{{$products->discount}}">
		        </div>


		        <div class="form-group">
	                <label for="taxrate">Tax Rate % </label>
	                <input type="number" min="0" max="100"  step="any" class="form-control" id="taxrate" name="taxrate" placeholder="" required="" value="{{$products->taxrate}}">
		        </div>
		       

			</div><!--END col-md-4-->


			<div class="col-md-4">


		        <div class="form-group">
	                <label for="shippingcost">Shipping Cost </label>
	                <input type="number" min="0" step="any" class="form-control" id="shippingcost" name="shippingcost" placeholder="" required="" value="{{$products->shippingcost}}">
		        </div>

				<div class="form-group">
		            <label for="qty">Stock on hand </label>
		            <input type="number" min="0" step="any" class="form-control" id="qty" name="qty" placeholder="" required="" value="{{$products->qty}}">
		        </div>

		        

				{{--<div class="form-group">
		            <label for="alertqty"> Inventory critical level </label>
		            <input type="number" min="0" step="any" class="form-control" id="alertqty" name="alertqty" placeholder="" required="" value="{{$products->alertqty}}">
		        </div>--}}

		        <div class="form-group">
		            <label for="sku">SKU </label>
		            <input type="number" min="0" step="any" class="form-control" id="sku" name="sku" placeholder=""  value="{{$products->sku}}">
		        </div>

		        <div class="form-group">
		            <label for="weight">Weight </label>
		            <input type="number" min="0" step="any" class="form-control" id="weight" name="weight" placeholder=""  value="{{$products->weight}}">
		        </div>

		        <div class="form-group">
		            <label for="length">Length </label>
		            <input type="number" min="0" step="any" class="form-control" id="length" name="length" placeholder=""  value="{{$products->length}}">
		        </div>


		        <div class="form-group">
		            <label for="width">Width </label>
		            <input type="number" min="0" step="any" class="form-control" id="width" name="width" placeholder=""  value="{{$products->width}}">
		        </div>

		        <div class="form-group">
		            <label for="height">Height </label>
		            <input type="number" min="0" step="any" class="form-control" id="height" name="height" placeholder=""  value="{{$products->height}}">
		        </div>


		        <div class="form-group">
		            <label for="options">Options  </label>
		            <input type="text" class="form-control" id="options" name="options" placeholder="" maxlength="255"  value="{{$products->options}}">
		        </div>


		        <div class="form-group">
		            <label for="uom">Unit of Measure <span class="label-required">*</span> </label>
		            <input type="text" class="form-control" id="uom" name="uom" placeholder="" required="" maxlength="6" value="{{$products->uom}}">
		        </div>

		        <div class="form-group">
		            <label for="fk_category">Product Category <span class="label-required">*</span> </label>
		            <select name="fk_category" id="fk_category" class="form-control" required="">
		                @foreach($category as $key => $v)
		                    <option value="{{$v->pk_category}}" {{ ($v->pk_category == $products->fk_category) ? 'selected' :'' }}> 
		                    	{{$v->description}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>



				
		        <div class="form-group">
	                <label for="videoshare">Youtube Video Id </label>
	                <input type="text" class="form-control" id="videoshare" name="videoshare" placeholder="tgbNymZ7vqY"  value="{{$products->videoshare}}">
		            
		        </div>

		      
                
			</div><!--END col-md-4-->


			<div class="col-md-4">

		        <div class="form-group">
	                <label for="pictxa"> Cover Photo </label> <br>
	                <input type="file" class="" id="pictxa" name="pictxa" placeholder=""  value="">
	                @if( $products->pictxa )
                        <br>
                        <div class="card" style="width:100px;height:50px" id="spanqpix">
                            <img src="{{asset('/storagelink/'.$products->pictxa)}}" alt="" style="width:80px;height:50px">
                        </div>
                        <br>
                        <input type="checkbox" name="removepictxa" id="removepictxa" class="i-checks"  > Remove Image
                    @endif
		        </div>




		        <div class="form-group">
		            <label for="gallery">Photo Gallery  </label> <br>
		            <input multiple="" type="file" class="" id="gallery" name="gallery[]" placeholder=""  value="">
		            
		            @if( count($gallery) > 0 )
                        <br>
                        @foreach($gallery as $v)
                            
                            <div class="row col-md-5">

                                <input type="checkbox" name="removegallery[{{$v->pictx}}]"  class="i-checks"  > Remove
                              
                                <img src="{{asset('/storagelink/'.$v->pictx)}}" alt="" style="width:80px;height:50px">

                            </div>
                        @endforeach

                    @endif

		        </div>


				<div class="row">
					
				</div>

				<hr>

				<div class="form-group">
                    <label for="indexno">Indexno <span class="label-required">* sorter</span> </label>
                    <input type="number" class="form-control" id="indexno" name="indexno" placeholder="" required="" value="{{$products->indexno}}" min="0" >
                  
                </div>

		        				
				@include('admin.layouts.selectstatus', ['source'=>$products])


				
		       	<hr>
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



	


				    