@extends('landingpage.layouts.master')

@section('title', 'YesLife Certificates Show')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
	
@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Certificates', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Certificates'
    ])

    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div">
       
        <div class="container">
            
            <div class="row">

                <div class="col-md-12" style="text-align: center !important;">
       
                    <h3> {{$certifications->productname}} </h3>

                    @foreach($gallery as $key => $v)

                        <br><br>

                        <h4>Lot Code</h4>

                        <span style="font-size: 20px; color:#58595b;"> {{$v->lotcode}} </span>

                        <br><br>
                        
                        @if( strpos($v->pictx, '.pdf') !== false )

                            <object data="{{asset('/storagelink/'.$v->pictx)}}" type="application/pdf" width="100%" height="600px"> 
                                <p>
                                    It appears you don't have a PDF plugin for this browser.
                                    No biggie... you can 
                                    <a href="{{asset('/storagelink/'.$v->pictx)}}">click here to
                                    download the PDF file.</a>
                                </p>  
                            </object>


                        @else

                           <img src="{{asset('/storagelink/'.$v->pictx)}}" alt="">


                        @endif

                    @endforeach


                </div>

            </div><!--END row-->
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection

