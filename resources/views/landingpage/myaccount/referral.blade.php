@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Referral')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')


@endsection

    
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Referral', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Referral'
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

                                    

                                    <h3>Referral</h3>

                                    <div class="row col-md-12">

                                        @include('landingpage.layouts.facebookshare')   

                                        &nbsp;&nbsp;&nbsp;

                                        @include('landingpage.layouts.twittershare')
                                        
                                    </div>

                                    <br>
                                    Invite anyone using your referral link

                                    <a href="{{url('/')}}?refno={{Auth::user()->affiliate_token}}" title="" target="_blank" style="color:#0e76bc;">
                                        https://yes.life?refno={{Auth::user()->affiliate_token}}
                                    </a>

                                    <hr>
                            

                                    @if(count($downline) > 0)


                                        <div class="cart-table table-responsive mb-30" >
                                            
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Register</th>
                                                        <th>Referrals</th>
                                                        <th>Purchases</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach($downline as $v)

                                                        <tr>
                                                            
                                                            <td>
                                                                {{$v->fullname}}
                                                            </td>


                                                            <td>
                                                                {{$v->email}}
                                                            </td>

                                                            <td>
                                                                {{$v->address}}
                                                            </td>
                                                            
                                                            <td>
                                                               {{$v->date}}
                                                            </td>
                                                            
                                                            <td>
                                                                {{$v->referralcount}}
                                                            </td>

                                                            <td>
                                                                {{$v->purchasecount}}
                                                            </td>


                                                        </tr>

                                                    @endforeach
                                                
                                                </tbody>

                                            </table>


                                        </div><!--END myaccount-table table-responsive text-center-->

                                            
                                        <br>

                                        @if(count($downline) > 0)
                                            <div class="text-center" >
                                                {{ $downline->appends([])->links() }}
                                            </div>
                                        @endif


                                    @else

                                        {{--@include('landingpage.layouts.nodisplay')--}}

                                    @endif

                                    <a href="{{url('/myaccount/rewards')}}" title="">
                                        
                                        @include('landingpage.myaccount.totalrewards')

                                    </a>
                                   

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

