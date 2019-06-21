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
      'bannerheader'=>'QUALITY AND SAFETY', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'QUALITY AND SAFETY'
    ])

    <!-- Contact Section Start -->
    <div class="contact-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix" id="main-div">
       
        <div class="container">

            <div class="" style="margin-top: -50px;font-size: 18px;" align="justify" >
                At Yes.Life above all else we value quality and safety. That is why every batch of CBD is tested for pesticides, metals, bacteria, and stability. We guarantee that every product that you use is safe for your family
            </div>

            <br>

            <div class="row">

              <div class="col-md-3">

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    @foreach($category as $key => $v)

                        <a class="nav-link {{$currentcat == $v['pk_category'] || $currentcat == 0 ? 'active' : ''}}" id="v-pills-{{$v['pk_category']}}-tab" href="{{url('/certifications?cat='.$v['pk_category'])}}" role="tab" aria-controls="v-pills-{{$v['pk_category']}}" aria-selected="true"> 
                            {{$v['description']}} 
                        </a>

                    @endforeach

                </div><!--END nav flex-column -->

              </div><!--END col-3-->

              <div class="col-md-9">

                <div class="tab-content" id="v-pills-tabContent">

                  <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      

                    <div class="accordion " id="accordionCertifications">

                        @foreach($certifications as $key=> $v1)

                            <div class="card table-responsive" style="border:none; margin-bottom: 10px;">
                                
                                <div class="card-header" id="heading{{$v1->pk_certifications}}" style="border:;border-bottom-color:#fff ;">

                                  <h5 class="mb-0" style="color:#3a95c2;">

                                    <a href="{{url('/certifications/'.$v1->pk_certificatemstr)}}{{$refnourl}}" title="" style="font-size: 20px; "> 
                                        {{$v1->productname}}
                                    </a>

                                  </h5>

                                </div>


                                <div id="collapse{{$v1->pk_certifications}}" class="collapse show" aria-labelledby="heading{{$v1->pk_certifications}}" data-parent="#accordionCertifications">
                                    
                                    <div class="card-body">


                                        @foreach($v1->gallery as $k2 => $v2)

                                            <li style="font-size: 18px; color:#58595b;">

                                                <b>

                                                    <a href="{{url('/certifications/'.$v2->fk_certificatemstr.'/'.$v2->lotcode)}}{{$refnourl}}" title="" >
                                                        {{$v2->lotcode}}
                                                    </a> 
                                              
                                                </b>


                                            </li>

                                        @endforeach
                                        
                                       
                                    </div><!--END card-body-->

                                </div><!--END collapse-->


                            </div><!--END card-->

                        @endforeach


                    </div><!--END accordion-->


                    
                  </div>{{--END tab-pane--}}

                </div>{{--END tab-content--}}

              </div>{{--END col-9--}}

            </div><!--END row-->
           

            {{--<div class="row">


                @foreach($certifications as $k1=> $v1)

                    <div class="col-md-6">


                        <a href="{{url('/certifications/'.$v1->pk_certificatemstr)}}{{$refnourl}}" title="" target="_blank">
                                                    
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

                                                <a href="{{url('/certifications/'.$v2->fk_certificatemstr.'/'.$v2->lotcode)}}{{$refnourl}}" title="" target="_blank">
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

            </div> --}}


            {{--<div class="col-md-8">

                <p>
                    {!! $globalmessage->content !!}
                </p>
                
            </div> --}}
        
        
        
        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection

