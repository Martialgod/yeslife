@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Payment Method Edit')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Account Details', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Manage Payment Method'
    ])

    <!-- My Account Section Start -->
    <div class="my-account-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
                <div class="col-12" >

                    <div class="row">

                        @include('landingpage.myaccount.menu')

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-12 mb-30">

                            <div class="tab-content">

                                <div class="myaccount-content ">
                                    
                                    <h3>Payment Method / Edit</h3>

                                    <div class=" alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                                        Card Number, CVC and Expiry Date can only be updated upon checkout after our payment gateway validates the information.
                                    </div>
                                    
                                    <div class="account-details-form">

                                        @include('admin.layouts.alert')
                                        
                                        <!-- Checkout Form-->
                                        <form id="form-account-details" class="jqvalidate-form "  method="POST" action="{{url('/myaccount/paymentmethod/'.$usersccinfo->pk_usersccinfo)}}" >

                                            {{method_field('PUT')}}
                                            {{ csrf_field() }}
                                            
                                            <div class="row">

                                                
                                                <div class=" col-md-12 col-12 mb-20" style="color:#;">
                                                  <label>Card Number **</label>
                                                  <input style="color:#666;" type="text" id="rally_cardNumber" placeholder="XX-XXXX-XXXX-XX" data-input="rally_cardNumber" readonly="" disabled="" value="{{$usersccinfo->cardno}}">
                                                  <span id="errrally_cardNumber" style="color:red; font-size: 12px;"> </span>
                                                </div>


                                                
                                                <div class="row col-md-12">

                                                    <div class="col-md-6 col-12 mb-20">
                                                      <label style="color:#;">Expiry Date*</label>
                                                      <input style="color:#666;" type="text" id="rally_expDate" placeholder="MM/YYYY" data-input="rally_expDate" maxlength="7" value="{{$usersccinfo->exmonth.'/'.$usersccinfo->exyear}}" readonly="" disabled="" >
                                                      <span id="errrally_expDate" style="color:red; font-size: 12px;"> </span>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb-20">
                                                      <label style="color:#;">CVC*</label>
                                                      <input style="color:#666;" type="text" id="rally_cvc" placeholder="XXX" data-input="rally_cvc" maxlength="4" readonly="" disabled="" value="{{$usersccinfo->cvc}}">
                                                      <span id="errrally_cvc" style="color:red; font-size: 12px;"> </span>
                                                    </div>


                                                </div>


                                                <div class="row col-md-12">

                                                    <div class="col-md-6 col-12 mb-20">

                                                        <div class="form-group">
                                                            <label for="isdefault">Set as default <span class="label-required">*</span> </label>
                                                            <select name="isdefault" id="isdefault" class="form-control">
                                                                <option value="1" {{ $usersccinfo->isdefault == '1' ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $usersccinfo->isdefault == '0' ? 'selected' : '' }}>No</option>
                                                            </select>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 col-12 mb-20">

                                                        @include('admin.layouts.selectstatus', ['source'=>$usersccinfo])
                                                    </div>

                                                    
                                                </div>

                                              
                                                  
                                            </div>

                                            @include('landingpage.layouts.buttonsubmit')
                                            <br><br>


                                        </form>

                                    </div><!--END account-details-form-->

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



	


				    