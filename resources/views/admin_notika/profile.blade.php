@extends('admin.layouts.master')

@section('title', 'Admin Update Profile Page')

@section('optional_styles')
	

@endsection



@section('content')
	
	@section('breadcrumb-details')

		<div class="breadcomb-icon">
			<i class="notika-icon notika-support"></i>
		</div>

		<div class="breadcomb-ctn">
            <h2>
                <a href="#" class="text-success">
                    Update Profile
                </a>
            </h2> 
    
			<p>
				...
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


						<form method="POST" class="swa-confirm" action="{{url('/admin/profile')}}" >

							{{method_field('PUT')}}
							{{ csrf_field() }}

							<div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                	<label for="uname">Username</label>
                                    <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{$user->uname}}" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                	<label for="fullname">Fullname <span style="font-size: 12px; color:red;">*</span> </label>
							    	<input type="text" class="form-control" id="fullname" name="fullname" placeholder="" required="" value="{{$user->fullname}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                	<label for="currentpw">Current Password <span style="font-size: 12px; color:red;">*</span>  </label>
							    	<input type="password" class="form-control" id="currentpw" name="currentpw" placeholder="" required="" value="" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                	<label for="password">New Password </label> <span style="font-size: 12px; color:red;">leave empty if you dont want to change your password</span> 
							    	<input type="password" class="form-control" id="password" name="password" placeholder="" ="" value="" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                	<label for="password_confirmation">Confirm Password</label>
							    	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" ="" value="" maxlength="15">
                                </div>
                            </div>
						  	
						  	<button type="submit" class="btn btn-success notika-btn-success waves-effect">Submit</button>

						  	

						</form>

                     
        			</div><!--END contact-form -->

        		</div><!--END contact-form sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0-->
            
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



	