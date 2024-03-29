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
                        1-833-TRY-LIFE / 1-833-879-5433 
                    </p>
                    <p>
                        info@yes.life <br> https://yes.life
                    </p>

                    {{--<div class="row col-md-12">

                        @include('landingpage.layouts.facebookshare')

                        &nbsp;&nbsp;&nbsp;

                        @include('landingpage.layouts.twittershare')

                    </div>--}}

                  

                </div><!--END footer-widget-->

            </div><!--END col mb-40-->
            
            <div class="col mb-40">
                <div class="footer-widget">
                    <h3 class="title">Quick Links</h3>
                    <ul>
                        <li><a href="{{url('/about-us')}}{{$refnourl}}">About Us</a></li>
                        <li><a href="#">Benefits</a></li>
                        <li><a href="{{url('/shop')}}{{$refnourl}}">Shop</a></li>
                        <li><a href="{{url('/blog')}}{{$refnourl}}">Blogs</a></li>
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
                        <li><a href="{{url('/terms-conditions#return-policy')}}{{$refnourl}}">Return Policy</a></li>
                        <li><a href="#">Promotional Offers</a></li>
                        <li><a href="{{url('/faqs')}}{{$refnourl}}">FAQs</a></li>

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

                    <span>

                        <a href="https://www.facebook.com/iamyeslife" target="_blank">
                            {{--<i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; Facebook --}}
                            <img src="/landingpage/assets/images/social/fb-blue.png" width="30px"></img> 
                        </a>

                        <a href="https://twitter.com/iamyeslife" target="_blank">
                            {{--<i class="fa fa-twitter" aria-hidden="true"></i> &nbsp; Twitter --}}
                            <img src="/landingpage/assets/images/social/twitter-blue.png" width="30px"></img>
                        </a>

                        <a href="https://www.pinterest.com/iamyeslife/" target="_blank">
                           {{--<i class="fa fa-pinterest-p" aria-hidden="true"></i> &nbsp;  Pinterest--}}
                           <img src="/landingpage/assets/images/social/pinterest-blue.png" width="30px"></img>
                        </a>

                    </span>

                

                    <span>
                        
                        <a href="https://www.youtube.com/channel/UCT1-KDYOP0RsLRlwucHUIYA" target="_blank">
                            {{--<i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp; Youtube--}}
                            <img src="/landingpage/assets/images/social/youtube-blue.png" width="30px"></img>
                        </a>

                        <a href="https://www.linkedin.com/company/i-am-yes-life/" target="_blank">
                            {{--<i class="fa fa-linkedin" aria-hidden="true"></i> &nbsp; Linkedin--}}
                            <img src="/landingpage/assets/images/social/linkedin-blue.png" width="30px"></img>
                        </a>

                        <a href="https://www.instagram.com/iamyeslife/ " target="_blank">
                            {{--<i class="fa fa-instagram" aria-hidden="true"></i> &nbsp; Instagram--}}
                            <img src="/landingpage/assets/images/social/insta-blue.png" width="30px"></img>
                        </a>


                    </span>

                    <h3 class="title">Share On</h3>


                    <div class="row col-md-12">

                        @include('landingpage.layouts.facebookshare')

                        &nbsp;&nbsp;&nbsp;

                        @include('landingpage.layouts.twittershare')

                    </div>
                    
                    {{--<ul>

                        <li style="height: 20px;">

                            <a href="https://www.facebook.com/iamyeslife" target="_blank">
                                <i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; Facebook 
                            </a>


                        </li>

                        <li style="height: 20px;">
                            <a href="https://twitter.com/iamyeslife" target="_blank">
                                <i class="fa fa-twitter" aria-hidden="true"></i> &nbsp; Twitter
                                
                            </a>
                        </li>

                        <li style="height: 20px;">
                            <a href="https://www.pinterest.com/iamyeslife/" target="_blank">
                               <i class="fa fa-pinterest-p" aria-hidden="true"></i> &nbsp;  Pinterest
                            </a>
                        </li>

                        <li style="height: 20px;">
                            <a href="https://www.youtube.com/channel/UCT1-KDYOP0RsLRlwucHUIYA" target="_blank">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp; Youtube
                            </a>
                        </li>

                        <li style="height: 20px;">
                            <a href="https://www.linkedin.com/company/i-am-yes-life/" target="_blank">
                                <i class="fa fa-linkedin" aria-hidden="true"></i> &nbsp; Linkedin
                            </a>
                        </li>


                        <li style="height: 20px;">
                            <a href="https://www.instagram.com/iamyeslife/ " target="_blank">
                                <i class="fa fa-instagram" aria-hidden="true"></i> &nbsp; Instagram
                            </a>
                        </li>
                    </ul> --}}

                </div>
            </div>

            
        </div>
    </div>
</div><!-- Footer Top Section End -->
