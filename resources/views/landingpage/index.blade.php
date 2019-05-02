@extends('landingpage.layouts.master')

@section('title', 'YesLife The highest absorbing natural CBD supplement on the market')

@section('meta')

    <meta name="robots" content="YesLife We provide the best CBD oil in almost all US states." />
    <meta name="description" content="YesLife We provide the best CBD oil in almost all US states.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url"           content="{{url('/')}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Yes.Life" />
    <meta property="og:description"   content="We provide the best CBD oil in almost all US states." />
    <meta property="og:image"         content="/landingpage/assets/images/favicon3.png" />


@endsection

@section('optional_styles')



@endsection



@section('content-body')
    
    {{--$refnourl initialized at landingpage.master.blade.php--}}

	<!-- Hero Section Start -->
    <div class="hero-slider section" style="margin-top: -30px; ">

        <div class="carousel slide" data-ride="carousel" data-interval="8000" id="slider"  style="" > {{--class="carousel slide" data-ride="carousel"--}}
          
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol><!--END carousel-indicators-->

            <div class="carousel-inner">

                <div class="carousel-item active">

                    <!-- Hero Item Start -->
                    {{--url(/landingpage/assets/images/slider/slider-bg-1.jpg) --}}
                    <div class="hero-item" style="background-image: url(/landingpage/assets/images/slider/slide-01a.jpg); margin-top: 80px;">
                        <div class="container">
                            <div class="row">
                              
                                <div class="hero-content-wrap col">
                                    
                                    <div class="hero-image" style="width:50%;">
                                        {{--<img src="/landingpage/assets/images/slider/cbd-circle-flavor.png" alt=""  > --}}
                                    </div>

                                    <div class="hero-content text-center" >
                                        
                                        {{--<h2>
                                            <img src="/landingpage/assets/images/slider/b&w-top-logo_slide.png"/>
                                        </h2> --}}

                                        <h2 id="" style="color:#fff;">
                                           NOURISH YOUR BODY <br> WITH NATURE AND <br> LIVE YOUR BEST LIFE.
                                        </h2>

                                        <p id="" style="color:#fff; text-align:left">
                                            
                                            ✓ #1 Most-stable
                                            ✓ Water-soluble ✓ highest-absorbing
                                            <br> 
                                            ✓ Fast-acting
                                            ✓ NO addictive chemicals added 
                                            <br>

                                            <a href="{{url('/shop')}}{{$refnourl}}">
                                                <img src="/landingpage/assets/images/30-days-btn-02.png" alt="" />
                                            </a>
                                            <br/>
                                        </p>
                                    </div><!--END hero-content text-center-->
                                    
                                </div><!--END hero-content-wrap col-->
                                
                            </div><!--END row -->
                        </div><!--END container-->
                    </div><!-- Hero Item End -->

           
                </div><!--END carousel-item active-->

                <div class="carousel-item ">

                    <!-- Hero Item Start -->
                    {{--url(/landingpage/assets/images/slider/slider-bg-1.jpg) --}}
                    <div class="hero-item "  style="background-image: url(/landingpage/assets/images/slider/slide-02.jpg); margin-top: 80px;">
                        <div class="container">
                            <div class="row">
                              
                                <div class="hero-content-wrap col">
                                    
                                    {{--<div class="hero-image" style="width:35%">
                                        <img src="/landingpage/assets/images/slider/cbd-product-4.png" alt="" style="width: 300px;">
                                    </div> --}}

                                    <div class="hero-content text-center"  >
                                        
                                        {{--<h2>
                                            <img src="/landingpage/assets/images/slider/b&w-top-logo_slide.png"/ >
                                        </h2> --}}

                                        <h2 id="" style="color:#fbb055 ;">
                                            DON'T SETTLE FOR <br> INFERIOR HEMP CBD OIL!

                                        </h2>

                                        <p id="" style="color:#fff; text-align:left">
                                            
                                            We offer the most effective cbd that is engineered  to work <br> with your body and can help you take back your health, with the best nature as to offer.

                                            {{--<a href="{{url('/shop')}}{{$refnourl}}">
                                                <img src="/landingpage/assets/images/30-days-btn.png" alt="" />
                                            </a> --}}
                                            <br/>
                                            Nourish your body with nature and life your best life.
                                        </p>
                                    </div><!--END hero-content text-center-->
                                    
                                </div><!--END hero-content-wrap col-->
                                
                            </div><!--END row -->
                        </div><!--END container-->
                    </div><!-- Hero Item End -->
 
                </div><!--END carousel-item-->


                 <div class="carousel-item ">

                    <!-- Hero Item Start -->
                    {{--url(/landingpage/assets/images/slider/slider-bg-1.jpg) --}}
                    <div class="hero-item" style="background-image: url(/landingpage/assets/images/slider/slide-03a.jpg); margin-top: 80px;">
                        <div class="container">
                            <div class="row">
                              
                                <div class="hero-content-wrap col ">
                                    
                                    

                                    <div class="hero-content text-center" >
                                        
                                        {{--<h2>
                                            <img src="/landingpage/assets/images/slider/b&w-top-logo_slide.png"/ >
                                        </h2> --}}

                                        <h2 id="" style="color:#fbb055;" >
                                            HAND IN HAND WITH <br> NATURE AND SCIENCE
                                        </h2>


                                        <p id="" style="color:#000; text-align:left">

                                            <br><br>
                                            
                                            {{--YES.Life strives to help you transform your health and discover <br> a happier life through the very best products.

                                            <br>
                                            Our Promise: to provide natural products as tools to help you to achieve <br> better health, live with more happiness, and transform your life. --}}

                                        </p>
                                    </div><!--END hero-content text-center-->
                                    
                                </div><!--END hero-content-wrap col-->
                                
                            </div><!--END row -->
                        </div><!--END container-->
                    </div><!-- Hero Item End -->
                  
               
                  

                </div><!--END carousel-item-->


            </div><!--END carousel-inner-->

            <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a><!--END carousel-control-prev-->

            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a><!--END carousel-control-next-->

        </div><!--END slider-->

       
    </div><!-- Hero Section End -->



    
    <!-- Product Section Start -->
    <div class="product-section section pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20">

        <div class="container">


            @include('landingpage.layouts.yeslife-info-tabs')


            {{--<div class="row">
                <div class="col">
                    <div class="section-title-2">
                        <h1> Start saying YES to life. </h1>
                        <p>
                            Each of our products is formulated with our proprietary YES Nano Technology for greater absorption and distribution throughout the body.
                        </p>
                        <br>
                    </div>
                </div>
            </div><!-- Section Title End -->
           

            <div class="row">

                <div class="col-md-3" style="text-align: center;">
        
                    <!-- Image -->
                    <div class="product-image">
                        <!-- Image -->
                        <img src="/landingpage/assets/images/product/circle-banner-v4-001.png" alt="">
                        <h4 class="title">Highest Quality Hemp</h4>
                        
                    </div>
             
                </div><!--END col-md-3-->

                <div class="col-md-3" style="text-align: center;">
        
                    <!-- Image -->
                    <div class="product-image">
                        <!-- Image -->
                        <img src="/landingpage/assets/images/product/circle-banner-v4-002.png" alt="">
                        <h4 class="title">Most Water Soluble</h4>
                        
                    </div>
             
                </div><!--END col-md-3-->

                <div class="col-md-3" style="text-align: center;">
        
                    <!-- Image -->
                    <div class="product-image">
                        <!-- Image -->
                        <img src="/landingpage/assets/images/product/circle-banner-v4-003.png" alt="">
                        <h4 class="title">Highest Absortion</h4>
                        
                    </div>
             
                </div><!--END col-md-3-->

                <div class="col-md-3" style="text-align: center;">
        
                    <!-- Image -->
                    <div class="product-image">
                        <!-- Image -->
                        <img src="/landingpage/assets/images/product/circle-banner-v4-004.png" alt="">
                        <h4 class="title" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; ">Sourced in USA</h4>
                        
                    </div>
             
                </div><!--END col-md-3-->

            </div><!--END row--> --}}

           
            <!-- Section Title Start -->
            <div class="row">
                <div class="col">
                    <div class="section-title left mb-60 mb-xs-40">
                        <br><br><br>
                        <h1>Popular Products</h1>
                        <p>
                        	{{--Some of our customer say that they trust us and buy our product without any hesitation because they believe us and always happy to buy our product. --}}
                        </p>
                    </div><!--END section-title left mb-60 mb-xs-40-->
                </div><!--END col-->
            </div><!-- Section Title End -->
            
            <div class="row">

            	@foreach($products as $key => $v)

				    <!-- Product Item Start -->
	                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-30">
	                    
	                    <div class="product-item">

	                    	<form action="#" method="post" id="" name="form-addcart" class='add-to-cart'>

				        		{{method_field('POST')}}
							    {{ csrf_field() }}

							    <input type="hidden" name="productid" value="{{$v->pk_products}}">
				                <input type="hidden" name="productname" value="{{$v->name}}">
				                <input type="hidden" name="qty" value="1">

							    <!-- Image -->
		                        <div class="product-image">

		                            <!-- Image -->
		                            <a href="{{url('/shop/'.$v->slug)}}{{$refnourl}}" class="image">
		                            	<img style="" src="{{asset('/storagelink/'.$v->pictxa)}}"alt="">
		                            </a>

		                            <!-- Product Action -->
                                    @if( $v->qty > 0 )
                                        <div class="product-action">
                                            <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  > 
                                                <span class="fa fa-shopping-cart" ></span> 

                                            </button>
                                        </div>
                                    @else
                                        <div class="product-action" >
                                            <span class="badge badge-danger ">Out of stock</span>
                                        </div>
                                    @endif
		                           

		                        </div>
		                        <!-- Content -->

		                        <div class="product-content">
		                            <div class="head">
		                                
		                                <!-- Title -->
		                                <div class="top" style="height: 60px;">
		                                    <h4 class="title">
		                                    	<a href="{{url('/shop/'.$v->slug)}}{{$refnourl}}"> 
		                                    		{{$v->name}} 
		                                    	</a>
		                                    </h4>
		                                </div>

		                                <!-- Price & Ratting -->
		                                <div class="bottom">
		                                    
		                                    <span class="price">

		                                    	${{$v->cartdiscountedprice}}
		                                    	
		                                    	@if( $v->cartdiscountedprice < $v->cartprice )
		                                    		<span class="old">${{$v->cartprice}}</span>
		                                    	@endif

		                                    </span>


		                                    <span class="ratting">
                                                <br>
		                                    	@for( $i=0; $i<$v->ratings; $i++ )
		                                    		<i class="fa fa-star"></i>
		                                    	@endfor
		    
		                                    </span>

		                                </div><!--END bottom-->

                                       
                                        <!-- Product Action -->
                                        @if( $v->qty > 0 )
                                            <div class="product-action text-center">
                                                <br>
                                                <button type="submit" id="" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  > 
                                                    Add to cart

                                                </button>

                                                <button type="button" onclick="GlobalBuyNow('{{$v->pk_products}}', '1')" style="background-color: #ffffff;color:#222222; margin-bottom: 10px;" class="btn btn-default"  > 
                                                    Buy Now
                                                </button>

                                            </div>

                                    

                                        @else
                                            <div class="product-action" class="btn btn-default" >
                                                <span class="badge badge-danger">Out of stock</span>
                                            </div>
                                        @endif


		                            </div><!--END head-->

		                        </div><!--END product-content-->

							</form>

	                    </div><!--END product-item-->
	                
	                </div><!-- col-xl-3 col-lg-4 col-sm-6 col-12 mb-30-->


            	@endforeach


            </div><!--END row-->

       
        	<div style="text-align: center;">
        		<a href="{{url('/shop')}}{{$refnourl}}" class="btn btn-success btn-lg custom-default-btn"> Show More </a>
        	</div>

            
        </div><!--END container-->

    </div><!-- Product Section End -->



 
    <!-- Banner Section Start -->
    <div class="banner-section section pb-90 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            
            <div class="row">
                <div class="col-12">
                    <div class="banner">
                    	<a href="{{url('/shop')}}{{$refnourl}}">
                    		<img src="/landingpage/assets/images/banner/offer_page-V3.jpg" alt="">
                    	</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div><!-- Banner Section End -->



@endsection



@section('optional_scripts')

	<script type="text/javascript">

	</script>

@endsection




				    