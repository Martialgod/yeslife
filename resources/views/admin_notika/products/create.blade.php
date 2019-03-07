@extends('admin.layouts.master')

@section('title', 'Admin Products Create Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('products.index')}}" data-toggle="tooltip" title="Index products">
                <i class="fa fa-shopping-cart fa"></i> 
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('products.index')}}" class="text-success">
                   Products List
                </a>
            </h2> 
            
            
            <p>
                Create Page
            </p>

  
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

                 <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                    <div class="contact-hd sm-form-hd">
                        <h2></h2>
                        <p></p>
                    </div>
                    
                    <div class="contact-form-int">


                        <form method="POST" class="swa-confirm"  action="{{route('products.store')}}" enctype="multipart/form-data" >

                            {{method_field('POST')}}
                            {{ csrf_field() }}

                            
                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="pictxa"> Cover Photo </label> <br>
                                    <input type="file" class="" id="pictxa" name="pictxa" placeholder=""  value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="name">Product Name <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" max="255" value="{{old('name')}}">
                                </div>
                                
                            </div>



                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="slug">Slug <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="" required="" max="255" value="{{old('slug')}}">
                                </div>
                                
                            </div>



                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="description">Product Description <span style="font-size: 12px; color:red;">*</span> </label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" required="" rows="4">{{old('description')}}</textarea>
                                </div>
                                
                            </div>



                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="price">Price <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="number" min="0" step="any" class="form-control" id="price" name="price" placeholder="" required="" value="{{old('price') ? old('price') : 0 }}">
                                </div>
                                
                            </div>


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="discount">Discount % </label>
                                    <input type="number" min="0" max="100"  step="any" class="form-control" id="discount" name="discount" placeholder="" required="" value="{{old('discount') ? old('discount')  : 0 }}">
                                </div>
                                
                            </div>

                            
                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="qty">Stock on hand </label>
                                    <input type="number" min="0" step="any" class="form-control" id="qty" name="qty" placeholder="" required="" value="{{old('qty') ? old('qty') : 0}}">
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="alertqty"> Inventory critical level </label>
                                    <input type="number" min="0" step="any" class="form-control" id="alertqty" name="alertqty" placeholder="" required="" value="{{old('alertqty') ? old('alertqty') : 0}}">
                                </div>
                                
                            </div>




                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="uom">Unit of Measure <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="text" class="form-control" id="uom" name="uom" placeholder="" required="" max="6" value="{{old('uom') ? old('uom') : 'bottle'}}">
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="fk_category">Product Category <span style="font-size: 12px; color:red;">*</span> </label>
                                    <select name="fk_category" id="fk_category" class="form-control" required="">
                                        @foreach($category as $key => $v)
                                            <option value="{{$v->pk_category}}" {{ ($v->pk_category == old('fk_category') ) ? 'selected' :'' }}> {{$v->description}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>

                            


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="gallery">Photo Gallery  </label> <br>
                                    <input multiple="" type="file" class="" id="gallery" name="gallery[]" placeholder=""  value="">
                                  
                                </div>
                            </div>


                            <br>
                            <button type="submit" class="btn btn-success notika-btn-success waves-effect">Submit</button>

                            

                        </form>

                     
                    </div><!--END contact-form -->


                    <br><br>
                    <hr>
                    <a href="{{route('products.index')}}" class="btn btn-default notika-btn-default waves-effect">
                        <i class="fa fa-arrow-left" aria-hidden="true"> Back</i>
                    </a>
        


                </div><!--END contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0-->
            
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    