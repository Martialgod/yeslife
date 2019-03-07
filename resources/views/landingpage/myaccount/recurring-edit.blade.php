@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Recurring Orders Edit')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Manage Recurring', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Manage Recurring'
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

                                    <h3>Recurring Orders / Edit  </h3>

                                    <div class="account-details-form">

                                        @include('admin.layouts.alert')
                                        
                                        <!-- Checkout Form-->
                                        <form id="" class="jqvalidate-form " method="POST" action="{{url('/myaccount/recurring', $orders->trxno)}}" >

                                            {{method_field('PUT')}}
                                            {{ csrf_field() }}

                                            <br>
                                            <div class="alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                                                Note that the actual amount displayed may vary upon checkout...
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">


                                                    <p>
                                                        <b>Bill To: </b> 
                                                        <br>
                                                        {{$orders->billto}}
                                                    </p>
                                                    
                                                </div>

                                                <div class="col-md-6">

                                                    <p>
                                                        <b>Ship To: </b> 
                                                        <br>
                                                        {{$orders->shipto}}

                                                    </p>
                                                    
                                                </div>

                                                
                                            </div><!--END row-->

                                            <div class="row"></div>

                                            <br>

                                            <div class="cart-table table-responsive mb-30">
            
                                                <table class="table">
                                                    
                                                    <thead>

                                                        <tr>
                                                            <th>Items</th>
                                                            <th>Qty</th>
                                                            <th>Unit Price</th>
                                                            {{--<th>Ship</th>
                                                            <th>Tax</th>--}}
                                                            <th>Total</th>

                                                      </tr>

                                                    </thead>

                                                    <tbody>

                                                        @foreach($orderdtls as $a)

                                                            <tr>
                                                                <td> {{$a->name}}  </td>

                                                                <td> {{$a->qty}} </td>

                                                                <td> ${{$a->unitprice}} </td>

                                                                {{--<td> ${{$a->shipamount}} </td>

                                                                <td> ${{$a->taxamount}} </td>--}}

                                                                <td> ${{$a->totalamount}} </td>

                                                            </tr>

                                                          

                                                        @endforeach
                                                      
                                                    </tbody>


                                                </table><!--END table table-hover-->

                                            </div><!--END table-responsive-->

                                            <div class="row">


                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label> I want my order every*</label>
                                                    <select required="" name="intervalno" id="intervalno" class="form-control">
                                                        @for($i=1;$i<=31; $i++)
                                                          <option value="{{$i}}" {{ $orders->intervalno == $i ? 'selected' : '' }} > {{$i}} </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Day(s) / Month(s) / Year(s)* </label>
                                                    <select required="" name="intervalunit" id="intervalunit" class="form-control">
                                                        <option value="Day" {{$orders->intervalunit == 'Day' ? 'selected' : ''}}> Day(s) </option>
                                                        <option value="Month" {{$orders->intervalunit == 'Month' ? 'selected' : ''}}> Month(s) </option>
                                                        <option value="Years" {{$orders->intervalunit == 'Year' ? 'selected' : ''}}> Year(s) </option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    @php 
                                                        
                                                        $formatenddate = null;

                                                        if( $orders->enddate ){
                                                            $formatenddate = date_format( date_create($orders->enddate) , 'Y-m-d' );
                                                        }
                                                        

                                                    @endphp
                                               
  
                                                    <label>And it should end on</label>
                                                    <input type="date" name="enddate" id="enddate" class="form-control" value="{{$formatenddate}}" >
                          
                                                </div>

                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" placeholder="Remarks" id="remarks" name="remarks" maxlength="500">{{$orders->recurringremarks}}</textarea>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    @include('admin.layouts.selectstatus', ['source'=>$orders])
                                                </div>

                                                  
                                            </div>

                                            @include('landingpage.layouts.buttonsubmit')
                                            <br><br>


                                        </form>

                                        <hr>
                                        <h3>Order History  </h3>

                                        @include('landingpage.myaccount.orders-table', ['sourcearr'=> $history])


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



	


				    