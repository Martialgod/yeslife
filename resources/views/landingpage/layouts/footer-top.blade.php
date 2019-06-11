{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

<!-- Footer Top Section Start -->
<div class="footer-top-section section bg-dark">
    <div class="container">
        <div class="footer-widget-wrap row">
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <img src="/landingpage/assets/images/b&w-top-logo_slide.png" alt="">
                    <p>
                        We ship anywhere in US
                    </p>
                    <p>
                        3855 S 500 W Suite D <br> 
                        South Salt Lake, UT 84115
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
                    <h3 class="title">Quick Links</h3>
                    <ul>
                        <li><a href="{{url('/about-us')}}{{$refnourl}}">About Us</a></li>
                        <li><a href="#">Benefits</a></li>
                        <li><a href="{{url('/shop')}}{{$refnourl}}">Shop</a></li>
                        <li><a href="{{url('/blog')}}{{$refnourl}}">Blog</a></li>
                        <li><a href="{{url('/cartcheckout')}}{{$refnourl}}">My Cart</a></li>
                        <li><a href="{{url('/contact-us')}}{{$refnourl}}">Contact Us</a></li>
                        <li><a href="{{url('/myaccount/home')}}">My Account</a></li>
                    </ul>
                </div>
            </div>
            
    

            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Information</h3>
                    <ul>
                        <li><a href="{{url('/privacy-policy')}}{{$refnourl}}">Privacy Policy</a></li>
                        <li><a href="{{url('/terms-conditions')}}{{$refnourl}}">Terms & Conditions</a></li>
                        <li><a href="{{url('/certifications')}}{{$refnourl}}">Certifications</a></li>
                        <li><a href="#">Return Policy</a></li>
                        <li><a href="#">Promotional Offers</a></li>
                        <li><a href="{{url('/faq')}}{{$refnourl}}">FAQ</a></li>

                    </ul>
                </div>
            </div>


            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">PROGRAMS</h3>
                    <ul>
                        @php
                            if( !$refnourl ){
                                $tempdist = '?subject=Distributor Inquiry';
                            }else{
                                $tempdist = $refnourl . '&subject=Distributor Inquiry';
                            }
                        @endphp

                        <li><a href="{{url('/contact-us')}}{{$tempdist}}">Become a distributor</a></li>
                    </ul>
                </div>
            </div>
            
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Follow us</h3>
                    <ul>

                        <li>
                            <a href="https://www.facebook.com/iamyeslife" target="_blank">
                                <i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; Facebook
                            </a>
                        </li>

                        <li>
                            <a href="https://twitter.com/iamyeslife" target="_blank">
                                <i class="fa fa-twitter" aria-hidden="true"></i> &nbsp; Twitter
                            </a>
                        </li>

                        <li>
                            <a href="https://www.pinterest.com/iamyeslife/" target="_blank">
                               <i class="fa fa-pinterest-p" aria-hidden="true"></i> &nbsp;  Pinterest
                            </a>
                        </li>

                        <li>
                            <a href="https://www.youtube.com/channel/UCT1-KDYOP0RsLRlwucHUIYA" target="_blank">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp; Youtube
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            
        </div>
    </div>
</div><!-- Footer Top Section End -->
