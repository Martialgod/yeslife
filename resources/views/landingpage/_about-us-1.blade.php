@extends('landingpage.layouts.master')

@section('title', 'YesLife About Us')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'About Us', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'About Us'
    ])

    <div class="about-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
       
        <!-- About Section Shape -->
        <div class="about-shape one rellax" data-rellax-speed="-5" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-1.png" alt=""></div>
        <div class="about-shape two rellax" data-rellax-speed="3" data-rellax-percentage="0.5"><img src="/landingpage/assets/images/shape/about-shape-2.png" alt=""></div>
       
        <div class="container">
            <div class="row align-items-center">
                
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
                        <h3>More About Yes.Life</h2>
                        <h1>Know What You're Buying</h1>
                        <div class="desc">
                            <h2 style="color:#333;">What is CBD?</h2>
                            <p>Each one of us are born with an Endocannabinoid System (ECS) in our bodies which regulates every metabolic process 
                            in the body, such as pain sensation, immunity, stress management, temperature regulation, sleep, and more.</p> 
                            <p>Just like muscles need protein to become stronger, your Endocannabinoid System also needs nutrients (called cannabinoids) 
                            to function properly to reduce pain, inflammation, anxieties, or other maladies in the body.  That's where Cannabidiol (or CBD) 
                            comes in - a very healthy nutrient.</p> 
                            <p>According to many researchers, CBD may be the single most important cannabinoid ever discovered.</p>
                        </div>
                        <div class="desc">
                            <h2 style="color:#333;">THC vs CBD</h2>
                            <p>THC (Δ9-tetrahydrocannabinol) is the psychoactive portion of cannabis and is commonly found in marijuana in higher amounts and 
                            is very low (if any) in the hemp plant.  
                            <p>CBD is “a cannabinoid devoid of psychoactive effect.” In other words, you can't get "high" from CBD! After THC
                            (Δ9-tetrahydrocannabinol), CBD is by far the most studied natural cannabinoid, and it is gaining in popularity faster than THC because 
                            of its healthy properties without the drug side attached to it.</p>
                        </div>
                        <div class="desc">
                            <h2 style="color:#333;">Why Hemp (NOT Marijuana)?</h2>
                            <p>Although hemp and marijuana are both cannabis, they have distinctive biochemical compositions and uses. Marijuana is very high in THC and 
                            much lower in CBD, while Hemp is the opposite, especially industrial hemp, where CBD is very high and THC is so low that you’re not worried 
                            about getting a "high" from it.</p> 

                            <p>In fact, industrial hemp has over 25,000 different applications and is one of the healthiest plants on the planet.  You find hemp protein 
                            in many of the top rated health food stores, which can provide 15g of protein per scoop. You can find hemp seeds in stores like Costco, which 
                            provide extraordinary amounts of healthy omega oils. There are also hemp tinctures found nationwide that help your body get other essential 
                            nutrients it needs to function properly.</p> 
                        </div>                                  
                    </div><!--END about-content about-content-1-->
                </div><!-- About Content End -->
                
            </div><!--END row align-items-center-->
        </div><!--END container-->
        
    </div><!-- About Section End -->

    

@endsection



@section('optional_scripts')

    <script type="text/javascript">
        
    </script>

@endsection



    


                    