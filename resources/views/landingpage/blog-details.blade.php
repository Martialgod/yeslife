@extends('landingpage.layouts.master')

@section('title', 'YesLife Blog - '.$blogs->name)

@section('meta')

    <meta name="robots" content="yeslife,cbd,blog" />
    <meta name="description" content="yeslife,cbd,blog">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')
    

    @include('landingpage.layouts.banner', [
      'bannerheader'=> 'Blog', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> $blogs->name
    ])



    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">

        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-12 order-1 mb-sm-50 mb-xs-50">
                    
                    <div class="single-blog-item">

                        <div class="image" >
                            <img src="{{asset('/storagelink/'.$blogs->pictx)}}" style="width: 870px; height: 462px;" alt="">
                        </div>
                        
                        <div class="content">

                            <ul class="blog-meta">
                                <li style="color:#222222 !important;">
                                    By - {{$blogs->sourcename}}
                                </li>
                                <li style="color:#222222 !important;">
                                    {{ date_format( date_create($blogs->sourcedate), 'd M, Y' ) }}
                                </li>
                            </ul>

                            <div class="desc">

                                {!! $blogs->content !!}

                            </div><!--END desc-->

                            <div class="blog-footer">

                      
                                <div class="share">

                                    <span>Share:</span> 

                                    <!-- Load Facebook SDK for JavaScript -->
                                    <div id="fb-root"></div>
                                    <script>
                                        (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                                        fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                    </script>

                                    @if( Auth::check() )

                                        <!-- Your share button code -->
                                        <div class="fb-share-button" data-href="{{url()->current()}}?refno={{Auth::user()->affiliate_token}}" data-layout="button_count" data-size="large">
                                        </div>

                                    @else

                                        {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
                                        <!-- Your share button code -->
                                        <div class="fb-share-button" data-href="{{url()->current()}}{{$refnourl}}" data-layout="button_count" data-size="large">
                                        </div>

                                    @endif



                                    @if( Auth::check() )

                                        @php 
                                            $twittershareurl = url('/').'&refno='.Auth::user()->affiliate_token;
                                        
                                        @endphp 

                                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="{{$blogs->name}}" data-url="{{url()->current()}}?refno={{Auth::user()->affiliate_token}}" data-hashtags="yeslife,CBD" > 
                                            Tweet
                                        </a>

                                    @else

                                        {{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
                                        <!-- Your share button code -->
                                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="{{$blogs->name}}" data-url="{{url()->current()}}{{$refnourl}}" data-hashtags="yeslife,CBD"> 
                                            Tweet 
                                        </a>

                                    @endif




                                </div>

                                <div class="tags">
                             
                                </div>


                            </div><!--END blog-footer-->

                        </div><!--END content-->

                    </div><!--END single-blog-item-->
                    
                    <div class="blog-navigation">
                        <a href="#" class="prev-blog"><i class="fa fa-long-arrow-left"></i>Previous</a>
                        <a href="#" class="next-blog"><i class="fa fa-long-arrow-right"></i>Next</a>
                    </div>
                    
                    <div class="comment-wrap pt-90 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50">
                        
                        <h3>Comments</h3>
                        
                        <ul class="comment-list">
                            <li>
                                <div class="comment">
                                    <div class="image"><img src="assets/images/comment/comment-1.jpg" alt=""></div>
                                    <div class="content">
                                        <h5>Alvaro Santos</h5>
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <span class="time">10 August, 2018  |  10 Min ago</span>
                                            <a href="#" class="reply">reply</a>
                                        </div>
                                        <div class="decs">
                                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and ising pain  borand I will give you a complete account of the system</p>
                                        </div>
                                    </div>
                                </div>
                                <ul class="child-comment">
                                    <li>
                                        <div class="comment">
                                            <div class="image"><img src="assets/images/comment/comment-2.jpg" alt=""></div>
                                            <div class="content">
                                                <h5>Silvia Anderson</h5>
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <span class="time">10 August, 2018  |  25 Min ago</span>
                                                    <a href="#" class="reply">reply</a>
                                                </div>
                                                <div class="decs">
                                                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and ising pain  borand I will give you a complete account of the system</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="comment">
                                    <div class="image"><img src="assets/images/comment/comment-3.jpg" alt=""></div>
                                    <div class="content">
                                        <h5>Nicolus Christopher</h5>
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <span class="time">10 August, 2018  |  35 Min ago</span>
                                            <a href="#" class="reply">reply</a>
                                        </div>
                                        <div class="decs">
                                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and ising pain  borand I will give you a complete account of the system</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        
                        <h3>Leave a Comment</h3>
                        
                        <div class="comment-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 col-12"><input type="text" placeholder="Name"></div>
                                    <div class="col-md-6 col-12"><input type="email" placeholder="Email"></div>
                                    <div class="col-12"><textarea placeholder="Message"></textarea></div>
                                    <div class="col-12"><button>SEND NOW</button></div>
                                </div>
                            </form>
                        </div>
                        
                    </div><!--END comment-wrap pt-90 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50-->

                </div><!--END col-lg-8 col-12 order-1 mb-sm-50 mb-xs-50-->

                <div class="col-lg-4 col-12 order-2 pl-30 pl-sm-15 pl-md-15 pl-xs-15">

                    <div class="sidebar">
                        <h4 class="sidebar-title">Search</h4>
                        <div class="sidebar-search">
                            <form action="#">
                                <input type="text" placeholder="Enter key words">
                                <input type="submit" value="search">
                            </form>
                        </div>
                    </div>
                    
                    <div class="sidebar">
                        <h4 class="sidebar-title">Recent Post</h4>
                        <ul class="sidebar-post-list">
                            <li class="sidebar-post">
                                <a href="blog-details.html" class="image"><img src="assets/images/blog/sidebar-blog-1.jpg" alt=""></a>
                                <div class="content">
                                    <h4 class="title"><a href="#">New CBD Oil</a></h4>
                                    <p>Some of our customer say’s that they trus </p>
                                </div>
                            </li>
                            <li class="sidebar-post">
                                <a href="blog-details.html" class="image"><img src="assets/images/blog/sidebar-blog-2.jpg" alt=""></a>
                                <div class="content">
                                    <h4 class="title"><a href="#">CBD Oil Benefits</a></h4>
                                    <p>Some of our customer say’s that they trus </p>
                                </div>
                            </li>
                            <li class="sidebar-post">
                                <a href="blog-details.html" class="image"><img src="assets/images/blog/sidebar-blog-3.jpg" alt=""></a>
                                <div class="content">
                                    <h4 class="title"><a href="#">Side Effects of CBD Oil</a></h4>
                                    <p>Some of our customer say’s that they trus </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div><!--END col-lg-4 col-12 order-2 pl-30 pl-sm-15 pl-md-15 pl-xs-15-->
              
                
            </div><!--END row-->



        </div><!--END container-->

    </div><!-- Blog Section End -->


@endsection



@section('optional_scripts')

    <script type="text/javascript">
        
    </script>


    <script>
        

    </script>

@endsection



    


                    