@extends('landingpage.layouts.master')

@section('title', 'YesLife Terms & Conditions')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
    

@endsection

    
@section('content-body')
    
    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Terms & Conditions', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Terms & Conditions'
    ])


    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">

        <div class="container">
            
 
            <div class="row">

                <div class="col-lg-12 col-12 mb-30">

                    <div class="blog-item-tc">

                        <div class="content"> 

                            {!! $globalmessage->content !!}

                        </div><!--END content-->

                    </div><!--END blog-item-tc-->

                </div><!--END col-lg-12 col-12 mb-30-->

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



    


                    