<!-- Start Header Top Area -->
<div class="header-top-area">
    
    <div class="container">
        
        <div class="row">
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="{{url('/admin/home')}}" style="color:#ffffff;font-size: 25px;">
                        CBD
                    </a>

                </div>

            </div><!--END col-lg-4 col-md-4 col-sm-12 col-xs-12-->

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                <div class="header-top-menu  ">
                    
                    <ul class="nav navbar-nav notika-top-nav" >

                    
                        <li class="nav-item dropdown">
                            <a href="#" >
                                <span style="margin-right: -20px;">
                                    <i class="notika-icon notika-mail"></i>
                                </span>
                            </a>
                        </li>

                        <li class="nav-item nc-al">
                            
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                
                                <span>
                                    {{ Auth::user()->fullname  }}
                                    <i class="notika-icon notika-menu"></i>
                                </span>


                                {{-- 
                                    @AppServiceProvider global variable for layouts.header
                                --}}
                                @if($newordercount > 0)

                                    <div class="spinner4 spinner-4" ></div>
                                    <div class="ntd-ctn"  >
                                        <span>
                                            @if( $newordercount > 20 )
                                                20+
                                            @else
                                                {{$newordercount }}
                                            @endif
                                            
                                        </span>
                                    </div>

                                @endif
                              
                             
                                
                            </a>

                            <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">

                                
                                 {{-- 
                                    @AppServiceProvider global variable for layouts.header
                                --}}
                                
                            
                                @if($newordercount > 0)

                                    <div class="hd-message-info">
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-mg-ctn">
                                                    <p>
                                                        <a href="{{url('/admin/orders?type=new')}}">
                                                            
                                                            <span style="color:red;">
                                                                {{$newordercount}}
                                                            </span>
                                                            New Order(s)

                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                                    </div><!--END hd-message-info-->

                                @endif


                                <div class="hd-message-info">
                                    <a href="#">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                <p>
                                                    <a href="{{url('/admin/category')}}">
                                                      
                                                        Product Category

                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <hr>
                                </div><!--END hd-message-info-->

                                

                                <div class="hd-message-info">
                                    <div class="hd-message-sn">
                                        <div class="hd-mg-ctn">
                                            <h3></h3>
                                            <p style="text-align: ;">
                                                <a href="{{url('/admin/profile')}}" style="text-decoration: none;">
                                                    Update Profile
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                </div><!--END hd-message-info-->


                                <div class="hd-mg-va" style="text-align: center">
                                    <form class="form-inline " method="POST" action="{{url('/admin/logout')}}">
                                        
                                        {{ csrf_field() }}

                                        <button class="btn btn-danger " type="submit">Logout</button>

                                    </form>
                                        
                                </div><!--END hd-mg-va-->

                            </div><!--END dropdown-menu message-dd notification-dd animated zoomIn-->

                        </li><!--END nav-item nc-al-->

                    </ul><!--END nav navbar-nav notika-top-nav-->

                </div><!--END header-top-menu-->

            </div><!--END col-lg-8 col-md-8 col-sm-12 col-xs-12-->

        </div><!--END row-->

    </div><!--END container-->

</div>
<!-- End Header Top Area -->

<!-- End Header Top Area -->
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            
                            <li>
                                <a href="{{url('/admin/home')}}">
                                    Home
                                </a>
                            </li>

                            <li>
                                <a  href="{{url('/admin/products')}}">
                                    Products
                                </a>
                            </li>

                         
                            <li>
                                <a  href="{{url('/admin/orders')}}">
                                    Orders
                                </a>
                            </li>



                            @if( Auth::id() == 1000 )

                                <li>
                                    <a  href="{{url('/admin/users')}}">
                                        Users
                                    </a>
                                </li>

                            @endif

                            
                        </ul>
                    </nav><!--END dropdown-->
                </div><!--END mobile-menu-->
            </div><!--END col-lg-12 col-md-12 col-sm-12 col-xs-12-->
        </div><!--END row-->
    </div><!--END container-->
</div><!--END mobile-menu-area-->


<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    
                    <li class="{{ session('active_tab') == 'Home' ? 'active' : '' }}">
                        <a href="{{url('/admin/home')}}">
                            <i class="notika-icon notika-house"></i> Home
                        </a>
                    </li>


                    <li class="{{ session('active_tab') == 'Products' ? 'active' : '' }}">
                        <a href="{{url('/admin/products')}}">
                            <i class="fa fa-shopping-cart fa"></i> Products
                        </a>
                    </li>
              


              
                    <li class="{{ session('active_tab') == 'Orders' ? 'active' : '' }}">
                        <a href="{{url('/admin/orders')}}">
                            <i class="fa fa-opencart fa" aria-hidden="true"></i> Orders
                        </a>
                    </li>
              

                   

                    @if( Auth::id() == 1000 )

                        <li class="{{ session('active_tab') == 'Users' ? 'active' : '' }}">
                            <a href="{{url('/admin/users')}}">
                                <i class="notika-icon notika-support"></i>Users
                            </a>
                        </li>

                    @endif


                </ul>

            </div><!--END col-lg-12 col-md-12 col-sm-12 col-xs-12-->
        </div><!--END row-->
    </div><!--END container-->
</div>
<!-- Main Menu area End-->