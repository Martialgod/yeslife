{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

<!-- Footer Top Section Start -->
<div class="footer-top-section section bg-dark">
    <div class="container">
        <div class="footer-widget-wrap row">
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <img src="/landingpage/assets/images/b&w-top-logo_slide.png" alt="">
                    <p>
                        We provide the best CBD oil in almost all US states.
                    </p>
                    <p>
                        3855 S 500 W Suite D 
                        South Salt Lake, UT 84115
                        United Staes
                    </p>
                    <p>
                        <a href="#"> 1-833-TRY-LIFE  </a> / <a href="#"> 1-833-879-5433 </a>
                    </p>
                    <p>
                        <a href="#">info@yes.life</a> <br> <a href="https://yes.life">https://yes.life</a>
                    </p>

                    <div class="row col-md-12">
                                        
                        @include('landingpage.layouts.facebookshare')

                        &nbsp;&nbsp;&nbsp;

                        @include('landingpage.layouts.twittershare')

                    </div>

                  

                </div><!--END footer-widget-->

            </div><!--END col mb-40-->
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Quick Link</h3>
                    <ul>
                        <li><a href="{{url('/about-us')}}{{$refnourl}}">About CBD</a></li>
                        <li><a href="#">Benefits</a></li>
                        <li><a href="{{url('/shop')}}{{$refnourl}}">Shop</a></li>
                        <li><a href="{{url('/blog')}}{{$refnourl}}">Blog</a></li>
                        <li><a href="{{url('/cartcheckout')}}{{$refnourl}}">Cart</a></li>
                        <li><a href="{{url('/contact-us')}}{{$refnourl}}">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Information</h3>
                    <ul>
                        <li><a href="{{url('/myaccount/home')}}">My Account</a></li>
                        <li><a href="{{url('/privacy-policy')}}{{$refnourl}}">Privacy Policy</a></li>
                        <li><a href="{{url('/terms-conditions')}}{{$refnourl}}">Terms & Conditions</a></li>
                        <li><a href="#">Return Policy</a></li>
                        <li><a href="#">Promotional Offers</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Follow us</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/iamyeslife" target="_blank">Facebook</a></li>
                        <li><a href="https://twitter.com/iamyeslife" target="_blank">Twitter</a></li>
                        {{--<li><a href="#">Linkedin</a></li>
                        <li><a href="#">Google Plus</a></li>--}}
                        <li><a href="https://www.pinterest.com/iamyeslife/" target="_blank">Pinterest</a>
                        <li><a href="https://www.youtube.com/channel/UCT1-KDYOP0RsLRlwucHUIYA" target="_blank">Youtube</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div><!-- Footer Top Section End -->
