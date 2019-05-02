@extends('landingpage.layouts.master')

@section('title', 'YesLife Contact Us')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
	<script src="/customjs/ContactUs.js?v={{time()}}" type="text/javascript"></script>
    
@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Contact Us', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Contact Us'
    ])

    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div">
       
        <div class="container">
            
            <div class="row">
                
                <!-- Contact Info Start -->
                <div class="col-lg-5 col-12 mb-30">
                    <div class="contact-info">
                        <ul>
                            <li>
                                <h4>Address</h4>
                                <p>3855 S 500 W Suite D South Salt Lake, UT 84115</p>
                            </li>
                            <li>
                                <h4>Phone No.</h4>
                                <p>
                                   <a href="#">1 – 833 - 879 - 5433</a>
                                </p>
                            </li>
                            <li>
                                <h4>Web</h4>
                                <p>
                                   <a href="#">info@yes.life</a>
                                   <a href="https://yes.life">https://yes.life</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div><!-- Contact Info End -->
                
                <!-- Contact Form Start -->
                <div class="col-lg-7 col-12 mb-30">
                    
                    <div class="contact-form-wrap">
                        <h3> {{$header}} </h3>
                        
                        <p>
                        	We love to hear from you! Please send us any inquiries you have about our product and we will get back to you as quickly as possible.
                        </p>

                        <div class="contact-form">
                            
                            <form id="form-contact" id="form-contact" class="jqvalidate-form checkout-form"  method="POST" action="#" >

                            	{{method_field('POST')}}
			    				{{ csrf_field() }}
                                
                                <div class="row row-10">

                                	@php
                                		$fullname = '';
                                		$email = '';
                                		$phone = '';
                                		$readonly  = '';

                                		if(Auth::check()){

                                			$fullname = Auth::user()->fullname;
                                			$email = Auth::user()->email;
                                			$phone = Auth::user()->phone;
                                			//$readonly = 'readonly';

                                		}

                                	@endphp

                                	<div class="col-md-12"  hidden >
		
										<div class="form-group" >
										    <input type="hidden" class="form-control" id="requesturl" name="requesturl" value="{{url()->current()}}">
										</div>

                                        <div class="form-group" >
                                            <input type="hidden" class="form-control" id="contacttype" name="contacttype" value="{{$contacttype}}">
                                        </div>

									</div>

                                    <div class="col-md-6 col-12 mb-30">
                                    	<input type="text" name="fullname" id="fullname" placeholder="Name" required=""  maxlength="255" value="{{$fullname}}" {{$readonly}} >
                                    </div>

                                    <div class="col-md-6 col-12 mb-30">
                                    	<input type="email" name="email" id="email" placeholder="Email" required=""  maxlength="255" value="{{$email}}"  {{$readonly}} >
                                    </div>

                                    <div class="col-md-6 col-12 mb-30">
                                    	<input type="text" name="phone" id="phone" placeholder="Phone"  maxlength="255" value="{{$phone}}"  >
                                    </div>

                                    <div class="col-md-6 col-12 mb-30">
                                    	<input type="text" name="subject" id="subject" placeholder="Subject" required="" maxlength="255" value="{{$subject}}">
                                    </div>


                                    @if($contacttype == 'Distributor')

                                        <div class="col-md-6 col-12 mb-30">
                                            <input type="text" name="ein" id="ein" placeholder="EIN/SSN"  maxlength="255" value=""  >
                                        </div>

                                        <div class="col-md-6 col-12 mb-30">
                                            <input type="text" name="businessname" id="businessname" placeholder="Business Name" required="" maxlength="255" value="">
                                        </div>


                                    @endif

                                    <div class="col-12 mb-30">
                                    	<textarea name="message" id="message" placeholder="Write message here..." required=""></textarea>
                                    </div>

                                    <div class="col-12">
                                    	<button class="">submit</button>
                                    </div>

                                </div>
                            
                            </form><!--END contact-form-->
                            
                            <p class="form-messege"></p>

                        </div><!--END contact-form-->
                        
                    </div><!--END contact-form-wrap-->
                
                </div><!-- Contact Form End -->
                
            </div><!--END row-->
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    