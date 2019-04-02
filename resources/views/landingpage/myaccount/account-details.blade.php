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
      'bannerheader'=>'Account Details', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Details'
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
                                    
                                    <h3>Account Details</h3>

                                    <!-- Checkout Form-->
                                    <form id="form-account-details" class="jqvalidate-form "  method="POST" action="{{url('/myaccount/details')}}" enctype="multipart/form-data">

                                        {{method_field('PUT')}}
                                        {{ csrf_field() }}
                                        
                                    
                                        <div class="">{{--account-details-form--}}

                                            @include('admin.layouts.alert')
                                            
                                            
                                            <div class="row">

                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label for="picta">Profile Photo </label> <br>
                                                    <input type="file" class="" id="pictx" name="pictx" placeholder=""  value="">

                                                    @if( $users->pictx )
                                                        <br><br>
                                                        <div class="card" style="width:100px;height:50px" id="spanqpix">
                                                            <img src="{{asset('/storagelink/'.$users->pictx)}}" alt="" style="width:80px;height:50px">
                                                        </div>
                                                        <br>
                                                        <input type="checkbox" name="removepictx" id="removepictx"  >
                                                        <label for="removepictx">Remove Photo</label> <br>
                                                        
                                                    @endif

                                                </div>

                                            


                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="title">Salutation</label>
                                                    <select name="title" id="title" class="form-control">

                                                        <option value="Mr." {{ ($users->title == 'Mr.') ? 'selected' :'' }}> 
                                                            Mr.
                                                        </option>

                                                        <option value="Mrs." {{ ($users->title == 'Mrs.') ? 'selected' :'' }}> 
                                                            Mrs.
                                                        </option>

                                                        <option value="Miss." {{ ($users->title == 'Miss.') ? 'selected' :'' }}> 
                                                            Miss.
                                                        </option>

                                                        <option value="Company" {{ ($users->title == 'Company') ? 'selected' :'' }}> 
                                                            Company
                                                        </option>
                                                       
                                                    </select>
                                                  
                                                </div>

                                                
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="uname">Username <span class="label-required">*</span> </label>
                                                    <input type="text" class="form-control" id="uname" name="uname" placeholder="" required="" value="{{$users->uname}}" maxlength="255">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="fname">Firstname <span class="label-required">*</span></label>
                                                    <input type="text" class="form-control" id="fname" name="fname" placeholder=""  value="{{$users->fname}}" required="" maxlength="255">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="lname">Lastname <span class="label-required">*</span> </label>
                                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="" required="" value="{{$users->lname}}" maxlength="255">
                                                </div>


                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="email">Email</label><span class="label-required">*</span>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="" required="" value="{{$users->email}}" maxlength="191" readonly="">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="phone">Phone</label> <span class="label-required">*</span>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{$users->phone}}" maxlength="255" required="">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="website">Website</label>
                                                    <input type="text" class="form-control" id="website" name="website" placeholder="" value="{{$users->website}}" maxlength="255">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="companyname">Company Name</label>
                                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="" value="{{$users->companyname}}" maxlength="255">
                                                </div>

                                                <div class="col-12 mb-30">
                                                    <label for="currentpw">Current Password 
                                                        <span style="font-size: 12px; color:red;">
                                                            * 
                                                            @php

                                                                $dp = ''; //default password for social login

                                                                if( $socialpw == $users->affiliate_token ){

                                                                    $dp = $users->affiliate_token; 

                                                                    //echo "autofill if you login through your social media account...";

                                                                }


                                                            @endphp
                                                            
                                                        </span>  
                                                    </label>
                                                    <input type="password" class="form-control" id="currentpw" name="currentpw" placeholder="" required="" value="{{$dp}}" maxlength="15">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="password">New Password </label> 
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="" ="" value="" maxlength="15">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" ="" value="" maxlength="15">
                                                </div>

                                                  
                                            </div>

                                        </div><!--END account-details-form-->


                                        <div style="font-size:0.8em;color:#; text-align: left; " class="form-group">
            
                                            <label> 
                                                <input type="checkbox" id="issubscribed" name="issubscribed" {{ $users->issubscribed == '1' ? 'checked' : '' }} >
                                                Email me for latest news, products, promotions, offers and discount?

                                            </label>    

                                            <label> 
                                                <input type="checkbox" id="istext" name="istext" {{ $users->istext == '1' ? 'checked' : '' }} >
                                                Send me a text for latest news, products, promotions, offers and discount?

                                            </label>    

                                        </div>  


                                        @include('landingpage.layouts.buttonsubmit')
                                        <br><br>



                                    </form>


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



	


				    