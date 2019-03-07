@extends('landingpage.layouts.master')

@section('title', 'YesLife My Account Reviews')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')


	@include('landingpage.layouts.banner', [
      'bannerheader'=>'Reviews', 
      'bannerurl'=> '/myaccount/home',
      'bannerback'=> 'My Account',
      'bannercontent'=> 'Reviews'
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

                                    <h3>Reviews   </h3>

                                    @if(count($reviews) > 0)


                                        <div class="cart-table table-responsive mb-30" >
                                            
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>Products</th>
                                                        <th>Ratings</th>
                                                        <th>Comments</th>
                                                        <th>Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach($reviews as $v)

                                                        <tr>
                                                            
                                                            <td> 

                                                                {{$v->productname}} 
                                                                
                                                            </td>

                                                            <td> 
                                                                @for( $i=0; $i<$v->star; $i++ )
                                                                    <i class="fa fa-star"></i>
                                                                @endfor
                                                            </td>


                                                            <td> {{$v->comments}} </td>


                                                            <td>
                                                                {{ $v->created_at_formatted }}
                                                            </td>

                                                            <td>
                                                                <a href="{{url('/shop/'.$v->slug)}}" class="btn btn-round custom-default-btn">Update</a>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                
                                                </tbody>

                                            </table>


                                        </div><!--END myaccount-table table-responsive text-center-->

                                            
                                        <br>

                                        @if(count($reviews) > 0)
                                            <div class="text-center" >
                                                {{ $reviews->appends([])->links() }}
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



	


				    