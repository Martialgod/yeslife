@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Home')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'My Account', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Dashboard'
    ])

    <!-- My Account Section Start -->
    <div class="my-account-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">

                        @include('landingpage.myaccount.menu')

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-12 mb-30">

                            <div class="tab-content">

                                <div class="myaccount-content ">
                                    
                                    <h3>Dashboard</h3>

                                    <div class="welcome">
                                        <p>Hello, <strong> {{ Auth::user()->fullname }} </strong> </p>
                                    </div>

                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                        recent orders, manage your shipping and billing addresses and edit your
                                        password and account details.</p>

                                </div><!--END myaccount-content-->

                            </div><!--END tab-content-->

                        </div><!-- col-lg-9 col-12 mb-30 -->

                    </div><!--END row-->

                </div><!--END col-12-->
            </div><!--END row-->
        </div><!--END container-->
    </div><!-- My Account Section End -->

    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


				    