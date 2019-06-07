@extends('landingpage.layouts.master')

@section('title', 'Contact Us | Yes.Life')

@section('meta')

    <meta name="robots" content="index, follow" />
    <meta name="description" content="Contact Yes.Life, one of the web's best cbd oil sellers. Let us help answer any and all questions you have. We're here to help you regain & maintain a happy & healthy life.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
	<script src="/customjs/ContactUs.js?v={{time()}}" type="text/javascript"></script>
    
@endsection

	
@section('content-body')
    

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h1 style="color:#3295c3; text-transform: none !important;"> CONTACT Yes.Life </h1>
                        <ul class="page-breadcrumb">
                            <li style="color:#3295c3;">
                                <a href="/{{$refnourl}}">Home</a>
                            </li>
                            <li style="color:#3295c3;"><b> Contact Us </b></li>
                        </ul>
                    </div><!--END page-banner-->
                    
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- Page Banner Section End -->


	{{--@include('landingpage.layouts.banner', [
      'bannerheader'=>'Contact Yes.Life', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Contact Us'
    ])--}}

    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div">
       
        <div class="container">
            
            <div class="row">
                
                <!-- Contact Info Start -->
                <div class="col-lg-5 col-12 mb-30">
                    <div class="contact-info">
                        <ul>

                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                      <i style="color:#3a95c2;" class="fa fa-map-marker fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            3855 S 500 W Suite D <br> 
                                            South Salt Lake, UT 84115
                                        </p>
                                    </div>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                      <i style="color:#3a95c2;" class="fa fa-phone fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            1 - 833 - 879 - 5433 <br>
                                            1 - 833 - TRY - LIFE
                                        </p>
                                    </div>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2">
                                      <i style="color:#3a95c2;" class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            info@yes.life <br>
                                            https://yes.life
                                        </p>
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- Contact Info End -->
                
                <!-- Contact Form Start -->
                <div class="col-lg-7 col-12 mb-30">
                    
                    <div class="contact-form-wrap">
                        <h3> {{$header}} </h3>
                        
                        <p>
                        	We love to hear from you!  Please send us any inquiries about our company and the products we offer, and we will get back to you as quickly as possible.
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

                                    {{--<div class="col-md-6 col-12 mb-30">
                                    	<input type="text" name="subject" id="subject" placeholder="Subject" required="" maxlength="255" value="{{$subject}}">
                                    </div> --}}

                                    <div class="col-md-6 col-12 mb-30" style="border-radius:36px;display:inline-block;overflow:hidden;background:#fff;border:1px solid #cccccc; height: 45px;">
                                        <select name="subject" id="subject" required="" style="height:100%; width: 100%;border:0px;outline:none;" class="">

                                            <option value="null" disabled="" selected="">
                                                Subject (choose one)
                                            </option>

                                            <option value="General questions" {{($subject == 'Customer Inquiry') ? 'selected' : ''}}> 
                                                General questions
                                            </option>

                                            <option value="Product Inquiry"> 
                                                Product Inquiry
                                            </option>

                                            <option value="Direct Sales and Wholesale" {{($subject == 'Distributor Inquiry') ? 'selected' : ''}} > 
                                                Direct Sales and Wholesale
                                            </option>

                                            <option value="Returns and Exchange"> 
                                                Returns and Exchange
                                            </option>

                                            <option value="Shipping Questions"> 
                                                Shipping Questions
                                            </option>

                                            <option value="Marketing"> 
                                                Marketing
                                            </option>

                                            <option value="Others"> 
                                                Others
                                            </option>
                                            
                                        </select>
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



	


				    