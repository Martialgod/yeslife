@extends('admin.layouts.master')

@section('title', 'Admin Users Create Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('users.index')}}" data-toggle="tooltip" title="Index User">
                <i class="notika-icon notika-support"></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('users.index')}}" class="text-success">
                    Users List
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

                 <div class="contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0 bglight">
                    <div class="contact-hd sm-form-hd">
                        <h2></h2>
                        <p></p>
                    </div>
                    
                    <div class="contact-form-int">


                        <form method="POST" class="swa-confirm"  action="{{url('/admin/users')}}"  >

                            {{method_field('POST')}}
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="fullname">Fullname <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="" maxlength="25" required="" value="{{old('fullname')}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="uname">Username  <span style="font-size: 12px; color:red;">*</span></label>
                                    <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{old('uname')}}" maxlength="15" >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="password">Password <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" ="" value="" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="password_confirmation">Repeat Password  <span style="font-size: 12px; color:red;">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" ="" value="" maxlength="15">
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-success notika-btn-success waves-effect">Submit</button>

                            

                        </form>

                     
                    </div><!--END contact-form -->

                    <br><br>
                    <hr>
                    <a href="{{route('users.index')}}" class="btn btn-default notika-btn-default waves-effect">
                        <i class="fa fa-arrow-left" aria-hidden="true"> Back</i>
                    </a>
        


                </div><!--END contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0-->
            
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    