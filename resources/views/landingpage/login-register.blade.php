@extends('landingpage.layouts.master')

@section('title', 'YesLife Login & Register')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')
	
	{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Login & Register', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Login & Register'
    ])



	<!-- Login & Register Section End -->
	<div class="login-register-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
               
                <!-- Login Form Start -->
                <div class="col-lg-4 col-md-6 col-12 mr-auto mb-30  alert alert-info" >
                    <div class="login-register-form">{{--login-register-form--}}
                        
                        <h3>Already a Member?</h3>

                        {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
						@php

							$loginurl = '?logtype=login'; //default no referral link
							if( $refnourl != '' ){
								$loginurl = $refnourl.'&logtype=login'; //default with referral link
							}

						@endphp

                        <form method="POST" name="login-form" class="jqvalidate-form-2" action="{{$loginurl}}" >

						    {{method_field('POST')}}
					        {{ csrf_field() }}

					        <div class="" >


								@if( isset($is_login) && $is_login == 'error' )
				                    <h5 class="alert alert-danger">
				                        Invalid Login Details!
				                    </h5>
				                @endif  


				                <div class="form-group">
						        	<label for="uname">Username <span class="label-required">*</span> </label>
						            <input type="text" name="uname" class="form-control" placeholder="Username" required="" value="{{ isset($uname) ? $uname : '' }}" autofocus="" >
						        </div>

				     
					        	<div class="form-group">
						        	<label for="password">Password <span class="label-required">*</span> </label>
						           	<input type="password" name="password" class="form-control" required=""  placeholder="Password">
						        </div>
										
						        <div class="col-12" style="text-align:center">
                                    <button type="submit" class="btn btn-round btn-lg">Login</button>

                                    <br />
			                        or login using
			                        <br />
			                        <div class="form-group">
			                            <div class="">
				                            <a href="{{url('/redirectfb')}}{{$refnourl}}" class="">
				                              	<h3> <span class="fa fa-facebook fa-fw"></span> </h3>
				                            </a>

			                                <a href="{{url('/redirectgoogle')}}{{$refnourl}}" class="">
			                              		<h3 style=""> <span class="fa fa-google fa-fw"></span> </h3>
			                              	</a>

			                              	<a href="{{url('/redirecttwitter')}}{{$refnourl}}" class="">
			                              		<h3 style=""> <span class="fa fa-twitter fa-fw"></span> </h3>
			                              	</a>

			                              	{{--<a href="{{url('/redirectlinkedin')}}" class="">
			                              		<h3> <span class="fa fa-linkedin fa-fw"></span> </h3>
			                              	</a> --}}
			                              
			                            </div>
			                        </div>

                                </div>
                         		<hr>
                                <div class="form-group" style="text-align: center;">
                                	<a href="{{url('/myaccount/forgotpassword')}}{{$refnourl}}" title="">
                                		Forgot Password? 
                                	</a>
						        	
						        </div>
							

							</div><!--END col-md-4-->

						</form>

                     
                    </div><!--END login-register-form-->
                </div>
                <!-- Login Form End -->

                <!-- Login Form Start -->
                <div class="col-lg-7 col-md-6 col-12 mb-30 alert alert-info">
                    
                    <div class="">{{-- login-register-form--}}

                        <h3>Register Form</h3>

						@include('admin.layouts.alert')

						<br>

						{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
						@php

							$registerurl = '?logtype=register'; //default no referral link
							if( $refnourl != '' ){
								$registerurl = $refnourl.'&logtype=register'; //default with referral link
							}

						@endphp

                    	<form method="POST" name="register-form" class="jqvalidate-form" action="{{$registerurl}}" >

						    {{method_field('POST')}}
					        {{ csrf_field() }}

							<div class="login-register-form row">

								<div class="col-md-6" >

						        	<div class="form-group" hidden="" >
							        	<label for="refno">Reference Token </label>
							            <input type="hidden" class="form-control" id="refno" name="refno" placeholder="" value="{{isset($referrer) ? $referrer->affiliate_token : null}}">
							        </div>

					     
						        	<div class="form-group">
							        	<label for="uname">Username <span class="label-required">*</span> </label>
							            <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{old('uname')}}" maxlength="15">
							        </div>

							        <div class="form-group">
							            <label for="password">Password </label> <span class="label-required">*</span> 
									    <input type="password" class="form-control" id="password" name="password" placeholder="" required="" value="" maxlength="15">
							        </div>

							        <div class="form-group">
							            <label for="password_confirmation">Confirm Password</label> <span class="label-required">*</span> 
									    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required="" placeholder=""  value="" maxlength="15">
							        </div>


								</div><!--END col-md-6-->

								<div class="col-md-6">
									<div class="form-group">
							        	<label for="lname">Lastname <span class="label-required">*</span> </label>
								    	<input type="text" class="form-control" id="lname" name="lname" placeholder="" required="" value="{{old('lname')}}" maxlength="255">
							        </div>


							        <div class="form-group">
							        	<label for="fname">Firstname <span class="label-required">*</span> </label>
								    	<input type="text" class="form-control" id="fname" name="fname" placeholder=""  value="{{old('fname')}}" required="" maxlength="255">
							        </div>



									<div class="form-group">
							        	<label for="email">Email</label><span class="label-required">*</span>
								    	<input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{old('email')}}" maxlength="191">
							        </div>

								</div>

							
							</div><!--END row-->


							<div style="font-size:0.8em;color:#; text-align: left; " class="check-box">
                              	
                                <label> 
                                	<input type="checkbox" name="issubscribed" checked="" >
                                   	Email me for latest news, 
									products, promotions, offers and discount?

                                </label>	

                                 <label> 
                                	<input type="checkbox" name="istext" checked="" >
                                   	Send me a text for latest news,
									products, promotions, offers and discount?

                                </label>	

                           	</div>	



					        <div class="col-12" style="text-align:center">
                                <button type="submit" class="btn btn-round btn-lg">Register</button>
                            </div>


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


	<script>
	  	/*window.fbAsyncInit = function() {
		    
		    FB.init({
		      appId      : '650055895413278',
		      cookie     : true,
		      xfbml      : true,
		      version    : 'v3.2'
		    });
	      
	    	FB.AppEvents.logPageView();   

	    		FB.getLoginStatus(function(response) {
			    statusChangeCallback(response);
			    console.log(response);
			});

	      
	  	};

	  	(function(d, s, id){
	     	var js, fjs = d.getElementsByTagName(s)[0];
	     	if (d.getElementById(id)) {return;}
	     	js = d.createElement(s); js.id = id;
	     	js.src = "https://connect.facebook.net/en_US/sdk.js";
	     	fjs.parentNode.insertBefore(js, fjs);
	   	}(document, 'script', 'facebook-jssdk'));

	  
	  	function checkLoginState() {
		  FB.getLoginStatus(function(response) {
		    statusChangeCallback(response);
		  });
		}*/

	</script>

@endsection



	


				    