@extends('admin.layouts.master')

@section('title', 'Admin Category Edit Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('category.index')}}" data-toggle="tooltip" title="Index category">
                <i class="fa fa-sliders "></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('category.index')}}" class="text-success">
                    Category List
                </a>
            </h2> 
            
            
            <p>
                Edit Page
            </p>

  
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

                 <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0 bglight">
                    <div class="contact-hd sm-form-hd">
                        <h2></h2>
                        <p></p>
                    </div>
                    
                    <div class="contact-form-int">


                        <form method="POST" class="swa-confirm"  action="{{route('category.update', $category->pk_category)}}"  >

                            {{method_field('PUT')}}
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="description">Description <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" value="{{$category->description}}">
                                </div>
                            </div>  


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="stat">Status <span style="font-size: 12px; color:red;">*</span> </label>
                                    <select name="stat" id="stat" class="form-control">
                                        <option value="1" {{ $category->stat == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $category->stat == '0' ? 'selected' : '' }}>In-Active</option>
                                    </select>
                                </div>
                                
                            </div>



                          
                            <br>
                            <button type="submit" class="btn btn-success notika-btn-success waves-effect">Submit</button>

                            

                        </form>

                     
                    </div><!--END contact-form -->

                    <br><br>
                    <hr>
                    <a href="{{route('category.index')}}" class="btn btn-default notika-btn-default waves-effect">
                        <i class="fa fa-arrow-left" aria-hidden="true"> Back</i>
                    </a>
        


                </div><!--END contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0-->
            
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    