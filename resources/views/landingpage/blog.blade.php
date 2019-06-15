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
      'bannerheader'=>'<span style="text-transform:none;"> Yes.Life Blog: CBD News, Research, Info & Education </span>', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Blog'
    ])


  


    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" style="margin-top: 40px;">

        <div class="container">

            @if( count($blogs) > 0 )

                @foreach($blogs as $key=> $a)

                    <div class="row">

                        <div class="col-xl-6 col-lg-6 col-12 order-2 order-lg-1 mb-sm-50 mb-xs-50">

                            <h3 class="title">
                                <a href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" style="color:#3a95c2 !important;">
                                    {{$a->name}}
                                </a>
                            </h3>

                            <p>
                                By {{$a->sourcename}} | {{ date_format( date_create($a->sourcedate), 'd F Y' ) }} | {{$a->minstoread}} min read
                            </p>

                

                            <p style="color:#222222 !important;">

                                {!! $a->summary !!}

                            </p>

                            <p style="color:#fbb055  !important;">
                                <a href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" class="read-more" >
                                    <b> READ MORE... </b>
                                </a>
                            </p>


                            
                            
                        </div><!--END col-md-6-->

                        <div class="col-xl-6 col-lg-6 col-12 order-1 order-lg-2 mb-sm-50 mb-xs-50" style="margin-bottom: 50px;">
                            
                            <a href="{{url('/blog/'.$a->slug)}}{{$refnourl}}" class="read-more" >
                                <img width="720" height="80%" src="{{asset('/storagelink/'.$a->pictx)}}" alt="">
                            </a>

                        </div><!--END col-md-6-->

                      

                    </div><!--END row-->

                @endforeach

            @else

                <div class="row">
                    <div class="col-md-4"></div>                   
                    <div class="col-md-4">     
                        <img src="/adminpage/images/nosearchfound.png" alt="">
                    </div>
                </div>

            @endif

            <div class="row">

                <br>
                @if(count($blogs) > 0)
             
                    {{ $blogs->appends(
                        ['search' => $search,'tags'=> $tags]
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



    


                    