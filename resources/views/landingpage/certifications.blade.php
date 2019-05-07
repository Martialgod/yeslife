@extends('landingpage.layouts.master')

@section('title', 'YesLife Certifications')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
	
@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Certifications', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'Certifications'
    ])

    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div">
       
        <div class="container">
            
            <div class="row">

                <div class="col-md-4">

                    @foreach($certifications as $k1=> $v1)

                        <div class="col-md-12">

                            @if( $v1->fk_products != null )
                                <h4>Product</h4>
                            @endif
                            

                            <h5> {{$v1->productname}} </h5>

                            <h6>Lot Code</h6>
                            
                            <ul>

                                @foreach($v1->gallery as $k2 => $v2)

                                    <li>
                                        <a href="{{url('/certifications/'.$v2->fk_certificatemstr.'/'.$v2->lotcode)}}{{$refnourl}}" title="" target="_blank">
                                            {{$v2->lotcode}}
                                        </a>
                                    </li>


                                @endforeach
                                
                            </ul>
                                   

                            <hr>
                                

                        </div>


                    @endforeach

                </div>


                <div class="col-md-8">

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>

                    

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>

                    
                </div>
            
        
                <br>
                
            </div><!--END row-->
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection

