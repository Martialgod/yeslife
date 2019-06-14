@extends('landingpage.layouts.master')

@section('title', 'FAQ | Yes.Life')

@section('meta')

    <meta name="robots" content="index, follow" />
    <meta name="description" content="FAQ Yes.Life, one of the web's best cbd oil sellers. Let us help answer any and all questions you have. We're here to help you regain & maintain a happy & healthy life.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	
    
@endsection

	
@section('content-body')

	@include('landingpage.layouts.banner', [
      'bannerheader'=>'<span style="text-transform:none;">FAQs</span>', 
      'bannerurl'=> '/',
      'bannerback'=> 'Home',
      'bannercontent'=> 'FAQs'
    ])

    <!-- Contact Section Start -->
    <div class="blog-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50" id="main-div">
       
        <div class="container banner-free-sample">

            <div class="float-right" style="margin-top: -70px;">
               <div class="sidebar-search"> 

                    <form action="" method="get" >
                        
                        <input type="text" placeholder="Search here..." name="search" value={{$search}}>
                        <input type="submit" value="search">
                        <br><br>
                       
                    </form>
                            
                   

                </div>
            </div>

    
            <div class="accordion " id="accordionFAQ">

                @foreach($faqs as $key=> $v)

                    <div class="card  table-responsive" style="border:none; width: 100%">
                        <div class="card-header" id="heading{{$v->pk_faqs}}" style="border:;border-bottom-color:#fbb055 ;">
                          <h5 class="mb-0" style="color:#3a95c2;">
                            <a class="btn btn-link " data-toggle="collapse" data-target="#collapse{{$v->pk_faqs}}" aria-expanded="true" aria-controls="collapse{{$v->pk_faqs}}">

                                <img src="/landingpage/assets/images/mini-logo-green.png" alt="">&nbsp;
                                {{$v->question}}

                            </a>
                          </h5>
                        </div>

                        <div id="collapse{{$v->pk_faqs}}" class="collapse " aria-labelledby="heading{{$v->pk_faqs}}" data-parent="#accordionFAQ">
                            <div class="card-body">
                                {!! $v->answer !!}
                            </div>
                        </div>

                    </div><!--END card-->

                @endforeach


            </div><!--END accordion-->


            <br>
            @if(count($faqs)>0)
                <div class="card-body table-responsive" style="background-color: #f5f5f5">
                    {!! $faqreferences->content !!}
                </div>
            @endif
            
                        

        </div><!--END container-->
        
    </div><!-- Contact Section End -->
    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    