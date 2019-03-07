@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Payment Method')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Payment Method', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Payment Method'
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
                                    
                                    <h3>Payment Method</h3>

                                    @if( count($usersccinfo) > 0 )

                                        <div class="cart-table table-responsive mb-30" >
                                            
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>Card No.</th>
                                                        <th>CVC</th>
                                                        <th>Expiry</th>
                                                        <th>Default</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach($usersccinfo as $v)

                                                        <tr>
                                                            
                                                            <td> {{$v->cardno}} </td>

                                                            <td> {{$v->cvc}} </td>

                                                            <td> {{$v->exmonth.'/'.$v->exyear}} </td>

                                                            <td>
                                                                @if( $v->isdefault == 1 )
                                                                    <span class="fa fa-check fa"></span>
                                                                @endif
                                                            </td>

                                                            <td style="color:{{ $v->stat == '1' ? 'green' : 'red'}} ;"> 
                                                                &nbsp;
                                                                {{ ($v->stat) ? 'Active' : 'In-Active'}} 

                                                            </td>

                                                            <td>
                                                                <a href="{{url('/myaccount/paymentmethod/'.$v->pk_usersccinfo)}}" class="btn btn-round custom-default-btn">Manage</a>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                
                                                </tbody>

                                            </table>


                                        </div><!--END myaccount-table table-responsive text-center-->

                                            
                                        <br>

                                        @if(count($usersccinfo) > 0)
                                            <div class="text-center" >
                                                {{ $usersccinfo->appends([])->links() }}
                                            </div>
                                        @endif


                                    @else

                                        <p class="saved-message">
                                            No Payment Method yet.
                                            <br>
                                            You can only add your payment method upon checkout after our payment gateway validates the information...
                                        </p>

                                    @endif

                                   

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



	


				    