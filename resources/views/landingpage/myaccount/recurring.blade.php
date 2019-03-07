@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Recurring Orders')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Recurring', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Recurring'
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

                                <div class="myaccount-content">

                                    <h3>Recurring Orders  </h3>

                                    @if(count($orders) > 0)

                                        <div class="cart-table table-responsive mb-30">
                                            
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>Track No.</th>
                                                        <th>Duration</th>
                                                        <th>Interval</th>
                                                        <th>Items</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach($orders as $v)

                                                        <tr>
                                                            
                                                            <td> 

                                                                {{$v->trxno}} 

                                                            </td>

                                                            <td>

                                                                <span data-toggle="tooltip" title="Start and End Date" style="cursor: help;" >
                                                                    {{ date_format( date_create($v->startdate) , 'M d, Y' ) }}
                                                                    <br>
                                                                    @if( $v->enddate )
                                                                        {{ date_format( date_create($v->enddate) , 'M d, Y' ) }}
                                                                    @else 
                                                                        ...
                                                                    @endif
                                                                </span>
                                                                
                                                              
                                                            </td>

                                                             <td> 

                                                                {{$v->intervalno.' '.$v->intervalunit}} 

                                                            </td>


                                                            <td> {{$v->totalitem}} </td>

                                                            <td> {{$v->totalamount}} </td>

                                                            <td> 
                                                                {{ ($v->stat) ? 'Active' : 'In-Active'}} 
                                                            </td>

                                                            <td>
                                                                <a href="{{url('/myaccount/recurring/'.$v->trxno)}}" class="btn btn-round custom-default-btn">Manage</a>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                
                                                </tbody>

                                            </table>


                                        </div><!--END myaccount-table table-responsive text-center-->

                                            
                                        <br>

                                        @if(count($orders) > 0)
                                            <div class="text-center" >
                                                {{ $orders->appends([])->links() }}
                                            </div>
                                        @endif

                                    

                                    @else

                                        @include('landingpage.layouts.nodisplay')

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



	


				    