@extends('landingpage.layouts.master')

@section('title', 'CBD News, Research, Information & Education | Yes.Life')

@section('meta')

    <meta name="robots" content="index,follow" />
    <meta name="description" content="Get CBD news, info & education as well as easy to digest summaries of the latest hemp CBD research only on the Yes.Life blog.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')
    

    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Yes.Life Blog: CBD News, Research, Info & Education', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Blog'
    ])


  


    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">

        <div class="container">

            <div class="row">

                <div class="col-xl-9 col-lg-8 col-12 order-2 order-lg-2 mb-sm-50 mb-xs-50">


                    <div class="row">

                        @if( count($blogs) > 0 )

                            @foreach( $blogs as $key=> $a )

                                <div class="col-lg-12 col-12 mb-30" >

                                    {{-- 
                                        #f7eadc
                                        border: #3295c3 1px solid;border-bottom-style: solid;border-bottom-color: #fbb055;border-left-color:#fbb055; 
                                    --}}
                                    <div class="blog-item" style="background-color:#b1eaf9">
                                       
                                        {{--<a class="image" href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" style="background-image: url(storagelink/{{$a->pictx}});" >

                                            <img src="{{asset('/storagelink/'.$a->pictx)}}" alt="">

                                        </a> 3a95c2--}}

                                        <a class="image" href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" style="background-image: url(/landingpage/assets/images/faviconv2-02.png); background-color:#3a95c2;background-size:100%;"  >

                                            <img src="/landingpage/assets/images/faviconv2-02.png" alt="">

                                        </a>

                                      
                                        <div class="content">

                                            <h3 class="title">
                                                <a href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" style="color:#222222 !important;">
                                                    {{$a->name}}
                                                </a>
                                            </h3>

                                            <ul class="blog-meta" >
                                                <li style="color:#222222 !important;">
                                                    By - {{$a->sourcename}}
                                                </li>
                                                <li style="color:#222222 !important;">
                                                    {{ date_format( date_create($a->sourcedate), 'd M, Y' ) }}
                                                </li>
                                            </ul>

                                            <p style="color:#222222 !important;">

                                                {!! $a->summary !!}

                                            </p>



                                            <a href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" class="read-more" style="color:#222222 !important;">read more...</a>

                                        </div><!--END content-->

                                    </div><!--END blog-item-->

                                </div><!--END col-lg-6 col-12 mb-30-->



                            @endforeach
                            
                        @else

                            <div class="col-md-2"></div>                   
                            <div class="">     
                                <img src="/adminpage/images/nosearchfound.png" alt="">
                            </div>

                        @endif
                      
                        
                    </div><!--END row-->


                    <div class="">

                        @if(count($blogs) > 0)
                     
                            {{ $blogs->appends(
                                ['search' => $search,'tags'=> $tags]
                            )->links() }}
                         
                        @endif
                   
                    </div>


                </div><!--END col-lg-8 col-12 order-1 mb-sm-50 mb-xs-50-->



                <div class="col-xl-3 col-lg-4 col-12 order-1 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">
                    
                    @include('landingpage.blog-search')

                    @include('landingpage.blog-tags')


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



    


                    