@extends('landingpage.layouts.master')

@section('title', 'YesLife Forgot Password')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	<!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">
                    
                    <div class="page-banner text-center" >
                        <h1>Forgot Password</h1>
                        <ul class="page-breadcrumb" >
                            <li style="color:#fff;"><a href="{{url('/')}}" >Home</a></li>
                            <li style="color:#fff;">Forgot Password</li>
                        </ul>
                    </div><!--END page-banner-->
                    
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- Page Banner Section End -->


	<!-- Login & Register Section End -->
	<div class="login-register-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
               
                <!-- Login Form Start -->
                <div class="col-lg-6 col-md-6 col-12 mr-auto mb-30  alert alert-info ">
                    <div class="login-register-form">{{--login-register-form--}}
                        <h3>Forgot Password?</h3>

                        <p>
                        	Enter your email address below, and we'll email instructions for setting a new one.
                        </p>

                        <form method="POST" name="login-form" class="jqvalidate-form-2" action="" >

						    {{method_field('POST')}}
					        {{ csrf_field() }}

					        <div class="" >

				                <div class="form-group">
						        	<label for="email">Email <span class="label-required">*</span> </label>
						            <input type="email" name="email" class="form-control" placeholder="enter your email" required="" value="{{ old('email') }}" autofocus="" >
						        </div>
										
						        <div class="col-12" style="text-align:center">
                                    <button type="submit" class="btn btn-round btn-lg">Reset my password</button>
                                </div>


							</div><!--END col-md-4-->

						</form>

                     
                    </div><!--END login-register-form-->
                </div>
                <!-- Login Form End -->

            </div>
        </div>
    </div><!-- Login & Register Section End -->

    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    