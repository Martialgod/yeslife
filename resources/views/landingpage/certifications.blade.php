@extends('landingpage.layouts.master')

@section('title', 'YesLife Certificates')

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
            <br><br>
            <div class="row">

                <div class="row">



                    @foreach($certifications as $k1=> $v1)

                        <div class="col-md-6">


                            <a href="{{url('/certificates/'.$v1->pk_certificatemstr)}}{{$refnourl}}" title="" target="_blank">
                                                        
                                @if( $v1->fk_products != null )
                                    <h4>Product</h4>
                                @endif
                                
                                <h4> {{$v1->productname}} </h4>

                                <h5>Lot Code</h5>
                                <hr>
                                <div style="margin-top: -50px;">

                                    <ul>

                                        @foreach($v1->gallery as $k2 => $v2)

                                            <li style="font-size: 20px; color:#58595b;">

                                                <b>

                                                    <a href="{{url('/certificates/'.$v2->fk_certificatemstr.'/'.$v2->lotcode)}}{{$refnourl}}" title="" target="_blank">
                                                        {{$v2->lotcode}}
                                                    </a> 
                                              
                                                </b>


                                            </li>

                                        @endforeach
                                        
                                    </ul>
                                    
                                </div>
                                
                            </a>
                                   

                            <br><br>

                        </div>




                    @endforeach

                </div>


                {{--<div class="col-md-8">

                    <p>
                        {!! $globalmessage->content !!}
                    </p>
                    
                </div> --}}
            
        
                <br>
                
            </div><!--END row-->
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection

