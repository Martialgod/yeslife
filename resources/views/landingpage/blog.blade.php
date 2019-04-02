@extends('landingpage.layouts.master')

@section('title', 'YesLife Blog')

@section('meta')

    <meta name="robots" content="yeslife,cbd,blog" />
    <meta name="description" content="yeslife,cbd,blog">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')
    

    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Blog', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Blog'
    ])



    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">

        <div class="container">

            <div class="row">

                @if( count($blogs) > 0 )

                    @foreach( $blogs as $key=> $a )

                        <div class="col-lg-6 col-12 mb-30" >

                            <div class="blog-item" style="background-color: #e1f5e7;">
                               
                                <a class="image" href="{{url('/blog/'.$a->slug)}}" style="background-image: url(storagelink/{{$a->pictx}}); width: 243px; height: 285px;" >
                                    <img src="{{asset('/storagelink/'.$a->pictx)}}" style="width: 243px; height: 285px;" alt="">
                                </a>

                              
                                <div class="content">

                                    <h3 class="title">
                                        <a href="{{url('/blog/'.$a->slug)}}" style="color:#222222 !important;">
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

                                    <a href="{{url('/blog/'.$a->slug)}}" class="read-more" style="color:#222222 !important;">read more...</a>

                                </div><!--END content-->

                            </div><!--END blog-item-->

                        </div><!--END col-lg-6 col-12 mb-30-->



                    @endforeach
                    
                @else

                    <div class="col-md-4"></div>                   
                    <div class="">     
                        <img src="/adminpage/images/nosearchfound.png" alt="">
                    </div>

                @endif
              
                
            </div><!--END row-->


            <div class="">

                @if(count($blogs) > 0)
             
                    {{ $blogs->appends(
                        ['search' => $search,]
                    )->links() }}
                 
                @endif
           
            </div>

        

        </div><!--END container-->

    </div><!-- Blog Section End -->


@endsection



@section('optional_scripts')

    <script type="text/javascript">
        
    </script>


    <script>
        

    </script>

@endsection



    


                    