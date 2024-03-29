@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Rewards')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')


@endsection

    
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Rewards', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Rewards'
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

                                    

                                    @include('landingpage.myaccount.totalrewards')


                                    <hr>
                            

                                    @if(count($rewards) > 0)


                                        <div class="cart-table table-responsive mb-30" >
                                            
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Referral</th>
                                                        <th>Order#</th>
                                                        <th>Remarks</th>
                                                        <th>Points</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach($rewards as $v)

                                                        <tr>
                                                            
                                                            <td>
                                                                {{$v->actionname}}
                                                            </td>

                                                            <td>{{$v->downline}}</td>

                                                            <td>

                                                                @if($v->fk_rewardactions == '1003')
                                                                    {{$v->trxno}}
                                                                @else
                                                                    <a href="{{url('/myaccount/orders/'.$v->trxno)}}" title="">
                                                                        {{$v->trxno}}
                                                                    </a>
                                                                @endif

                                                              

                                                                
                                                                
                                                            </td>

                                                            <td>
                                                                {{$v->remarks}}
                                                            </td>

                                                            <td>
                                                                {{$v->points}}
                                                            </td>
                                                            
                                                           

                                                        </tr>

                                                    @endforeach


                                                
                                                </tbody>

                                            </table>

                                        

                                        </div><!--END myaccount-table table-responsive text-center-->

                                            
                                        <br>

                                        @if(count($rewards) > 0)
                                            <div class="text-center" >
                                                {{ $rewards->appends([])->links() }}
                                            </div>
                                        @endif


                                    @else

                                        {{--@include('landingpage.layouts.nodisplay')--}}

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

