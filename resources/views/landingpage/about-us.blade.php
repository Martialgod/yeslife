@extends('landingpage.layouts.master')

@section('title', 'CBD Website | About Us | Yes.Life')

@section('meta')

    <meta name="robots" content="index,follow" />
    <meta name="description" content="Yes.Life is the best CBD oil company on the market. Our company mission is to facilitate health & healing in all. To that end, we offer water-soluable, micro-sized CBD oil with our YesNano technology that really works. Learn more about Yes.Life.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')


    <!-- Page Banner Section Start -->
    {{--<div class="page-banner-section section banner100px ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h1 style="color:#3295c3; font-size: 42px; text-align: center;"> 
                            About Us
                        </h1>
                    </div><!--END page-banner-->
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!--END page-banner-section section--> --}}



    @include('landingpage.layouts.banner', [
      'bannerheader'=>'About Us', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'About Us'
    ])



    <div class="about-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix ">

        <!-- About Section Shape -->
        <div class="about-shape one rellax" data-rellax-speed="-5" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-1.png" alt=""></div>
        <div class="about-shape two rellax" data-rellax-speed="3" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-2.png" alt=""></div>
       
        <div class="container" >


            <div class="about-us-right-image" style="margin-top: -70px;">

                <img src="/landingpage/assets/images/about/about-image-4.jpg" width="100%" height="800" alt="">

                <div class="about-image-overlay">

                    <div style="background-color: #58595b; height:100%;">
                        <br>
                        <h2 style="color:#fbb055;">Our Company</h2>
                        <br>
          
                        <p>
                            We focus on providing the <br> natural solutions that are  <br> known to work.
                        </p>

                        <p>
                            We focus on smart science, <br> high quality products, and <br> being honest.
                        </p>

                        <p>
                            We focus on those seeking <br> better health, no matter what <br> challenges they may face in it.  
                        </p>
                        

                        <p>
                            At Yes.Life, we focus on you  <br> saying YES to LIFE again. 
                            
                        </p>


                        <img src="/landingpage/assets/images/faviconv3.png" width="20%" alt="">
                    

                    </div>

                </div>

            </div><!--END col-md-12-->


            <!-- About Content Start -->
            <div class="row abount-content-mobile" style="display:none;" >
               
                <div class="about-content about-content-1" >
            
                    <h2 style="color:#fbb055;">Our Company</h2>
                    <br>
                    <div class="desc" >
                        
                        <p>
                            We focus on providing the natural solutions that are known to work.
                        </p>

                        <p>
                            We focus on smart science, high quality products, and being honest.
                        </p>

                        <p>
                            We focus on those seeking better health, no matter what challenges they may face in it.  
                        </p>
                        
                        <p>
                           At Yes.Life, we focus on you saying YES to LIFE again. 
                        </p>

                    </div>
                                               
                </div><!--END about-content about-content-1-->

            </div><!-- About Content End -->

            <br>
            <div class="abount-content-mobile ">

                <!--background-color: #BFC1C2; -->
                
                <div class="abount-content-mobile col-md-12" style="background-image: url(/landingpage/assets/images/about/yeslife-about-our-company.png); " >

                    <div class="abount-content-mobile" style="padding-left: 200px;">

                        <br><br>
                        <h2 class="" style="text-align: center;color:#af2424 !important;"> About our YESNANO™ TECHNOLOGY </h2>
           
                        <p style="color:;" align="justify">
                            Ordinary oils clump together, especially in the presence of water. By targeting the "packing" sizes of our CBD oils, we have managed to prevent such clumping with what we call YesNano™ Technology. We have shrunken down the packing sizes of the oils,  allowing them to mix with water and, as a result, our CBD products can both absorb into and mix with the human body! This technology provides you with the vast benefits of CBD as quickly and efficiently as possible.
                        </p>

                        <br>

                    </div>

                </div><!--END col-md-12-->
                
            </div>
            <br>

            <div class="row">

                <div class="col-md-12">
                    <img src="/landingpage/assets/images/about/yeslife-about-our-cause.jpg" alt="">
                </div>

                <div class="col-md-12 " style="">

                    <div class="col-md-1"> </div>

                    <div class="col-md-12">

                        <h2 align="center" style="color:#3a95c2;text-transform: none;">
                            It began with seeing the amazing benefits of CBD in our own lives. 
                        </h2>

                        <p align="justify">
                            Unfortunately, there was so much different information and noise out there – 
                        </p>     

                        <p align="justify">
                            “Is this true?” 
                            <br>
                            “Is this false?”
                            <br>
                            “What am I reading!?”
                        </p> 

                        <p align="justify">
                            we didn’t know what to believe. 
                            <br>
                            With so many different products at different price points to compound it all, our heads were spinning. 
                        </p>

                        <h4 align="justify" style="color:#58595b;text-transform: none;">
                            We were lost.
                        </h4>

                        <p align="justify">
                            But we needed to know. We saw enough to believe there was something to CBD, and so we began digging for the truth. After months of hard work, Yes.Life emerged.
                        </p>  

                        <h4 align="justify" style="color:#58595b;text-transform: none;">
                            <i>
                                Now, we hope to act as a light amidst the darkness of CBD misinformation and lies. Beyond this, we want to provide natural products that truly do work.
                            </i>
                        </h4>
              
                        <p align="justify">
                            <i style="color:#3a95c2;">
                                Our cause stems from making our customers’ lives better. 
                            </i>
                            We listen to your needs and empower them to discover better health through the right products – the products nature gave us first – with the help of smarter science. 
                        </p>

                        <p align="justify">
                            That’s it.
                        </p>


                        <h2>
                           <span style="color:#58595b;">Honest.</span> 
                           <span style="color:#fbb055;">Simple.</span> 
                           <span style="color:#3a95c2;">Natural.</span> 
                        </h2>

                        <br>
                        <p>
                            <img src="/landingpage/assets/images/main-logo.png" width="" alt="">
                        </p>  

                        <br>
                        
                    </div><!--END col-md-12-->
   
                </div><!--END col-md-12-->


            </div><!--END row--> 

        </div><!--END container-->
        
    </div><!-- About Section End -->


    

@endsection



@section('optional_scripts')

    <script type="text/javascript">
        
    </script>

@endsection



    


                    