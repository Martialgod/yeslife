{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}

<!-- Header Section Start -->
<div class="header-section section bg-theme" style="">
    <div class="container">
        <div class="row">
            
            <!-- Header Logo -->
            <div class="col">
                <div class="header-logo">
                    <a href="{{url('/')}}{{$refnourl}}">
                        <img src="/landingpage/assets/images/main-logo.png" alt="">
                    </a>
                </div>
            </div>
            
            <!-- Main Menu -->
            <div class="col d-none d-lg-block">
                <nav class="main-menu">
                    <ul>
                        <li><a href="{{url('/')}}{{$refnourl}}">HOME</a></li>
                        <li><a href="{{url('/about-us')}}{{$refnourl}}">ABOUT</a></li>

                        @if( Auth::check() && (Auth::user()->fk_usertype == '1000' || Auth::user()->fk_usertype == '1010') )

                            <li><a href="#">SHOP</a>
                                <ul class="sub-menu">
                                    <li><a href="{{url('/shop')}}{{$refnourl}}">Normal Shop</a></li>
                                    <li>
                                        <a href="{{url('/shop-business-partners')}}{{$refnourl}}">
                                            Business Partners
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @else

                            <li><a href="{{url('/shop')}}{{$refnourl}}">SHOP</a></li>

                        @endif
                        

                        <li><a href="{{url('/blog')}}{{$refnourl}}">BLOG</a></li>
                        <li><a href="{{url('/contact-us')}}{{$refnourl}}">CONTACT</a></li>
                    </ul>
                </nav>
            </div>

                   
            <!-- Header Action -->
            <div class="col">

                <div class="header-action" style="margin-top: 5px;">

                    <!-- Cart Wrap Start-->
                    <div class="header-cart-wrap" style="margin-right: 10px;font-size: 20px;" >

                        <a href="{{url('/cartcheckout')}}{{$refnourl}}" title="">
                            <button type="button" class="btn btn-info custom-default-btn" >

                                <i class="fa fa-shopping-cart" style="color:#faaf54;" aria-hidden="true"></i>

                                <span class="badge badge-warning" style="margin-left: -10px;font-size: 10px;" id="headercartcount" > 
                                    
                                    {{--@AppServiceProvider global variable for layouts.header--}}
                                    {{$yeslifecartcount}} 

                                </span>

                                <span class="sr-only">cart</span>
                             
                             
                            </button>
                        </a>
                        
                        
                    </div>

                    {{-- 
                        check for admin login-as virtual user 
                        Generated @AppServiceProvider.php
                    --}}
                    @if( session('yeslife_virtual_user_id') )

                        <div class="dropdown" >

                            <button class="btn btn-secondary dropdown-toggle custom-default-btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                {{$virtualuser->fname}} - (Virtual User)
                                <span class="fa fa-user fa"></span>

                            </button>
                              
                            <div style="text-align: center;" class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    
                                <a href="#" title="" class="dropdown-item">
                                    {{$virtualuser->email}}
                                </a>

                                <div class="dropdown-divider"></div>
                                <div style="">

                                    <a href="{{url('/logout')}}" title="" class="dropdown-item">
                                        Logout
                                    </a>
                                    
                                </div>


                            </div><!--END dropdown-menu-->

                        </div><!--END dropdown-->


                    @elseif( Auth::check() )

                        <div class="dropdown" >

                            <button class="btn btn-secondary dropdown-toggle custom-default-btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                {{ Auth::user()->fname  }} 
                                <span class="fa fa-user fa"></span>

                            </button>
                              
                            <div style="text-align: center;" class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    
                                <a href="{{url('/myaccount/home')}}" title="" class="dropdown-item">
                                    My Account
                                </a>

                                <div class="dropdown-divider"></div>

                                <div style="">

                                    {{-- <form class="form-inline " method="POST" action="{{url('/logout')}}">
                                        <hr>
                                        {{ csrf_field() }}

                                        <button class="col-md-12 btn btn-default btn-sm" style="background-color: #ffffff;color:red; border-style: none;" type="submit">
                                            Logout
                                        </button>

                                    </form> --}}

                                    <a href="{{url('/logout')}}" title="" class="dropdown-item">
                                        Logout
                                    </a>
                                    
                                </div>


                            </div><!--END dropdown-menu-->

                        </div><!--END dropdown-->


                    @else
                       
                        <a href="{{url('/myaccount')}}{{$refnourl}}" title="" >

                            <button style="background-color: #ffffff;color:#222222;" class="btn btn-secondary ">

                                Sign In

                            </button>

                        </a>

                    @endif

                  
                    
                    
                </div>
                            
                        
            </div><!-- Cart Wrap End-->
     
                    
  
            <div class="col-12 d-block d-lg-none" style="padding-top: 10px;">
                <div class="mobile-menu"></div>

            </div>

            
        </div>
    </div>


    
</div><!-- Header Section End -->
