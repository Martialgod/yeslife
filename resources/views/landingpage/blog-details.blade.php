@extends('landingpage.layouts.master')

@section('title',$blogs->name.' | Yes.Life') 
@section('meta')

    <meta name="robots" content="index, follow")>
    <meta name="description" content="{{$blogs->summary}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta property="og:image" content="{{asset('/storagelink/'.$blogs->pictx)}}" />



@endsection

@section('optional_styles')
    

    <script src="/customjs/BlogDetailsController.js?v={{time()}}" type="text/javascript"></script>


@endsection

    
@section('content-body')
    

    @include('landingpage.layouts.banner', [
      'bannerheader'=> 'Blogs', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Blog'
    ])

    <!-- Page Banner Section Start -->
    {{--<div class="page-banner-section section banner100px" >
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h2 style="color:#3295c3; font-size: 42px;"> Blog </h2>
                        <ul class="page-breadcrumb">
                            <li style="color:#3295c3;">
                                <a href="/{{$refnourl}}">Home</a>
                            </li>
                            <li style="color:#3295c3;"><b> Blog </b></li>
                        </ul>
                    </div><!--END page-banner-->
                    
                </div><!--END col-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- Page Banner Section End --> --}}




    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" ng-app="app" ng-controller="BlogDetailsController as vm" >

        <div class="container">

            <div class="row">

                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-sm-50 mb-xs-50">
                    
                    <div class="single-blog-item">

                        <input type="hidden" id="postid" name="postid" value="{{$blogs->pk_posts}}">

                        <div class="image" >
                            <img src="{{asset('/storagelink/'.$blogs->pictx)}}"  alt="">
                        </div>
                        
                        <div class="content">

                            <div>
                               <h1 style="font-size: 30px;"> {{$blogs->name}} </h1>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                   
                                    <p>
                                        By {{$blogs->sourcename}} | {{ date_format( date_create($blogs->sourcedate), 'd F Y' ) }} | {{$blogs->minstoread}} min read
                                    </p>
                                    
                                </div><!--END col-md-6-->


                                <div class="col-md-6">
 
                                    <div class="row">

                                        <div class="col-md-3">
                                            Share on: 
                                        </div><!--END col-md-4 -->
                                        
                                        <div class="col-md-3">
                                      
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


                                        </div><!--END col-md-4 -->

                                        <div class="col-md-3">

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
                                            
                                        </div><!--END col-md-4 -->

                                    </div><!--END row-->

                                </div><!--END col-md-6-->

                            </div><!--END row-->


                            <br>

                            <div class="desc">

                                {!! $blogs->content !!}

                            </div><!--END desc-->

                            <div class="blog-footer">

                                <div class="tags">
                                    <span>Tags:</span> 
                                    @foreach($tags as $v)
                                        {!! $v !!}
                                    @endforeach
                                    
                                </div>


                            </div><!--END blog-footer-->

                        </div><!--END content-->

                    </div><!--END single-blog-item-->

                    
                    <div class="blog-navigation">

                        @if( $cursor['prev'] )

                            <a href="{{url('/blog/'.$cursor['prev']->slug)}}" class="next-blog">
                                 <i class="fa fa-long-arrow-left"></i>Previous
                            </a>

                        @else 

                            <span class="next-blog">
                               ..
                            </span>

                        @endif


                        @if( $cursor['next'] )

                            <a href="{{url('/blog/'.$cursor['next']->slug)}}" class="next-blog">
                                <i class="fa fa-long-arrow-right"></i>Next
                            </a>

                        @else 

                            <span class="next-blog">
                               ..
                            </span>

                        @endif
                    
                      
                       
                    </div>
                    
                    <div class="comment-wrap pt-90 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50">
                        
                        <h3>Comments</h3>
                        
                        <ul class="comment-list">

                            <li ng-repeat="list in vm.mscreviews">
                                
                                <div class="comment">
                                    
                                    {{--<div class="image">
                                        <img src="assets/images/comment/comment-1.jpg" alt="">
                                    </div> --}}

                                    <div class="content">
                                        
                                        <h5> @{{list.name}} </h5>
                                        
                                        <div class="d-flex flex-wrap justify-content-between">

                                            <span class="time"> @{{list.created_at_formatted}} | @{{list.timeago}} </span>

                                        </div><!--END d-flex flex-wrap justify-content-between-->
                                        
                                        <div class="decs">
                                            <p>
                                                @{{list.comments}}
                                            </p>
                                        </div><!--END decs-->

                                    </div><!--END content-->

                                </div><!--END comment-->

                            </li>

                            <li ng-if="vm.mscreviews.length<=0" >
                                No comments yet...
                            </li>
                      
                        </ul>


                        <div class="row mt-20" style="" ng-if="vm.mscreviews.length>0">
            
                            <div class="">

                                <ul class="page-pagination">
                                    
                                    <li>
                                        <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.prev" ng-click="vm.LoadReviews(vm.navlinks.prev)">
                                            <i class="fa fa-angle-left"></i>
                                            Back
                                        </button>
                                    </li>

                                    <li>..</li>

                                    <li>
                                        <button class="btn btn-default btn-sm custom-default-btn" ng-disabled="!vm.navlinks.next" ng-click="vm.LoadReviews(vm.navlinks.next)">
                                            <i class="fa fa-angle-right"></i>
                                            Next
                                        </button>
                                    </li>

                                </ul><!--END page-pagination-->

                            </div><!--END col-->

                        </div><!--END row mt-20-->

                        <br><br>
                        
                        <h3>Leave a Comment</h3>
                        
                        <div class="comment-form">


                            <form method="POST" id="form-reviews" ng-submit="vm.PostReviews($event)" class="jqvalidate-form">

                                {{method_field('POST')}}
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <input type="text" id="name" name="name" placeholder="Name" required="" maxlength="255" >
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <input type="email" id="email" name="email" placeholder="Email" required="" maxlength="255" >
                                    </div>

                                    <div class="col-12">
                                        <textarea placeholder="Message" id="comments" name="comments" required="" ></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit">POST</button>
                                    </div>

                                </div>

                            </form>


                        </div><!--END comment-form-->
                        
                    </div><!--END comment-wrap pt-90 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50-->

                </div><!--END col-lg-8 col-12 order-1 mb-sm-50 mb-xs-50-->

                <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">
                    
                    @include('landingpage.blog-search')

                    @include('landingpage.blog-recent-posts')
        

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



    


                    