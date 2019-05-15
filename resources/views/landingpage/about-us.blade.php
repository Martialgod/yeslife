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


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'About Yes.Life', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'About Us '
    ])

    <div class="about-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
       
        <!-- About Section Shape -->
        <div class="about-shape one rellax" data-rellax-speed="-5" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-1.png" alt=""></div>
        <div class="about-shape two rellax" data-rellax-speed="3" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-2.png" alt=""></div>
       
        <div class="container">
            <div class="row">


                <div class="row col-md-12">

                    <!-- About Image Start -->
                    <div class="col-lg-6 col-12 order-1 order-lg-2 mb-30">
                        <div class="about-image masonry-grid row row-7">
                            <div class="col-6 col"><img src="/landingpage/assets/images/about/about-1-1.jpg" alt=""></div>
                            <div class="col-6 col"><img src="/landingpage/assets/images/about/about-1-2.jpg" alt=""></div>
                            <div class="col-6 col"><img src="/landingpage/assets/images/about/about-1-3.jpg" alt=""></div>
                            <div class="col-6 col"><img src="/landingpage/assets/images/about/about-1-4.jpg" alt=""></div>
                        </div><!--END about-image masonry-grid row row-7-->
                    </div><!-- About Image End -->

                    
                    <!-- About Content Start -->
                    <div class="col-lg-6 col-12 mr-auto order-2 order-lg-1 mb-30">
                        <div class="about-content about-content-1">
                            <h2>Our Company</h2>
                            <div class="desc">
                                
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
                    
                  
                </div><!--END row-->




                <div class="col-md-12 ">
                    <br><br>
                    <h2>Our Cause</h2>
                    <br>
                    <p style="font-family: Univers">
                        It began with seeing the amazing benefits of CBD in our own lives. Unfortunately, there was so much different information and noise out there – “Is this true?” – “Is this false?” – “What am I reading!?” – we didn’t know what to believe. With so many different products at different price points to compound it all, our heads were spinning. We were lost.
                        
                    </p>      

                    <p>
                        But we needed to know. We saw enough to believe there was something to CBD, and so we began digging for the truth. After months of hard work, YES.LIFE emerged. Now, we hope to act as a light amidst the darkness of CBD misinformation and lies. Beyond this, we want to provide natural products that truly do work.
                    </p>  

                    <p>
                        Our cause stems from making our customers’ lives better. We listen to their needs and empower them to discover better health through the right products – the products nature gave us first – with the help of smarter science. 
                    </p>

                    <p>
                        That’s it.
                    </p>

                    <p>
                       
                        Honest. Simple. Natural.
                        
                    </p>  

                    <p>
                        Yes.Life
                    </p>  
   

                    
                </div><!--END col-md-12-->


                <div class="col-md-12" >
                    <br><br>
                    <h2 style="text-align: center;"> About our YES Nano Technology </h2>
                    <br>
                    <p>
                        Ordinary oils clump together, especially in the presence of water. By targeting the "packing" sizes of our CBD oils, we have managed to prevent such clumping with what we call YES Nano technology. We have shrunken down the packing sizes of the oils,  allowing them to mix with water and, as a result, our CBD products can both absorb into and mix with the human body! This technology provides you with the vast benefits of CBD as quickly and efficiently as possible
                    </p>
                </div>


                
            </div><!--END row-->
        </div><!--END container-->
        
    </div><!-- About Section End -->

    

@endsection



@section('optional_scripts')

    <script type="text/javascript">
        
    </script>

@endsection



    


                    