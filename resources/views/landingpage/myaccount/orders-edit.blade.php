@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Orders Edit')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


    @include('landingpage.layouts.banner', [
      'bannerheader'=>'Manage Orders', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Manage Orders'
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

                                    <h3>Orders / Edit  </h3>


                                    @include('admin.layouts.alert')
                                    
                                    <!-- Checkout Form-->
                                    <form id="" class="jqvalidate-form swa-confirm" method="POST" action="{{url('/myaccount/orders', $orders->trxno)}}" >

                                        {{method_field('PUT')}}
                                        {{ csrf_field() }}


                                        @if( $orders->isapproved == 0 && $orders->fk_recurring != null && $orders->stat == 1 )
                                            <br>
                                            <div class="row alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                                                This is a recurring transaction that needs your approval. Note that the actual amount displayed may vary upon checkout...
                                            </div>

                                        @elseif( $orders->isdeclined == 1 )

                                            <br>
                                            <div class="row alert alert-danger" style="font-size: 12px; margin-top: -20px;">
                                                This is a recurring transaction which you have declined...
                                            </div>

  
                                        @endif

                                        <div class="row">
                                            <div class="col-md-6">


                                                <p>
                                                    <b>Bill To: </b> 
                                                    <br>
                                                    {{$orders->billto}}
                                                </p>

                                                <p>
                                                    <b>Ship To: </b> 
                                                    <br>
                                                    {{$orders->shipto}}

                                                </p>

                                                
                                            </div>

                                            <div class="col-md-6">

                                                <p>
                                                    <b>Confirmation Number: </b>
                                                    <br>
                                                    {{ $orders->trxno }}
                                                </p>

                                               <p>
                                                    <b>Date: </b>
                                                    <br>
                                                    {{ date_format( date_create($orders->created_at) , 'M d, Y' ) }}
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
                                                        <th>Total</th>
                                                  </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($orderdtls as $a)

                                                        <tr>
                                                            <td> {{$a->name}}  </td>

                                                            <td> {{$a->qty}} </td>

                                                            <td> ${{$a->unitprice}} </td>

                                                            <td> ${{$a->totalamount}} </td>

                                                        </tr>

                                                    @endforeach



                                                    @if(count($coupons) > 0)

                                                        @foreach($coupons as $c)

                                                            <tr>
                                                            
                                                                <td>Coupons</td>
                                                                <td></td>
                                                                <td>{{$c->code}}</td>
                                                                <td>
                                                                    <span style="color:red" >
                                                                        @if($c->type == 'Fixed')
                                                                            - ${{$c->amount}} 
                                                                        @else  
                                                                            - {{$c->amount}}% 
                                                                        @endif 
                                                                        
                                                                    </span>
                                                                </td>

                                                            </tr>

                                                        @endforeach


                                                        <tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td><b>Sub Total</b></td>
                                                                <td><b>${{$orders->totalamount - $orders->totalcoupon}}</b></td>
                                                                
                                                            </tr>
                                                        </tr>

                                                    @endif

                                                 
                                                    <tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>Sales Tax</b></td>
                                                            <td><b>${{$orders->totaltax}}</b></td>
                                                           
                                                        </tr>
                                                    </tr>

                                                    <tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>Shipping Cost</b></td>
                                                            <td><b>${{$orders->totalshipcost}}</b></td>
                                                           
                                                        </tr>
                                                    </tr>


                                                    <tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>Grand Total</b></td>
                                                            <td><b>${{$orders->netamount}}</b></td>
                                                        </tr>
                                                    </tr>


                                                    
                                                  
                                                </tbody>


                                            </table><!--END table table-hover-->

                                        </div><!--END table-responsive-->


                                        @if( $orders->isapproved == 0 && $orders->fk_recurring != null && $orders->stat == 1 )
                                            <div class="row pull-left">
                                                <br>
                                          
                                                <input type="submit" name="Decline" value="Decline" class="btn btn-round custom-default-btn"> 
                                             
                                            </div>

                                            <div class="row pull-right">
                                                <a href="{{url('/cartcheckout/')}}?recurring={{$orders->trxno}}" class="btn btn-round custom-default-btn">Approve</a>
                                                
                                            </div>

                                            <br>
  
                                        @endif



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



	


				    