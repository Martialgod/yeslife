<!--header start here-->
<div class="header-main">

	<div class="header-left">
		
		<div class="logo-name">
				<a href="{{url('/admin/home')}}"> 
					<img src="/adminpage/images/main-logo.png" width="100%" >
				</a> 								
		</div>

		@yield('global-search')


		<div class="clearfix"> </div>

	</div><!--END header-left -->

	<div class="header-right">

		<!--notifications of menu start -->
		<div class="profile_details_left">
			
			<ul class="nofitications-dropdown">
				
			

				<li class="dropdown head-dpdn">

					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						{{--@AppServiceProvider global variable for layouts.header--}}
	                    @if($newordercount > 0 || $abandonedcartcount > 0 )
	                    	<i class="fa fa-bell"></i>
							<span class="badge blue"> {{$newordercount + $abandonedcartcount}}  </span>
	                    @endif
						
					</a>

				
					<ul class="dropdown-menu">

						@if($newordercount > 0 )

							<li>
								<div class="notification_header">
									<a href="{{url('/admin/orders?type=new')}}" title="">
										<h3>{{$newordercount}} new order(s) today!</h3>
									</a>
								</div>
							</li>

	                    @endif

	                    @if($abandonedcartcount > 0 )

							<li>
								<div class="notification_header">
									<a href="{{url('/admin/abandonedcart')}}" title="">
										<h3>{{$abandonedcartcount}} abandoned cart(s)!</h3>
									</a>
								</div>
							</li>

	                    @endif

					
					</ul>
				
				</li><!--END dropdown head-dpdn-->


			</ul><!--END nofitications-dropdown-->

			<div class="clearfix"> </div>

		</div><!--END profile_details_left-->
		<!--notification menu end -->


		<div class="profile_details">		
			<ul>
				<li class="dropdown profile_details_drop">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile_img">	
							<span class="prfil-img">
								
							</span>

							<div class="user-name">

								@if( Auth::check() )
									<p>{{ Auth::user()->fullname  }}</p>
									<span> {{ Auth::user()->uname  }} </span>
								@endif
								
							</div>

							<i class="fa fa-angle-down lnr"></i>
							<i class="fa fa-angle-up lnr"></i>
							<div class="clearfix"></div>	

						</div><!--END profile_img-->
					</a>

					<ul class="dropdown-menu drp-mnu">
						
						{{--<li> 
							<a href="#">
								<i class="fa fa-cog"></i> Settings
							</a> 
						</li> --}}
						
						<li> 
							<a href="{{url('/admin/profile')}}">
								<i class="fa fa-user"></i> Profile
							</a> 
						</li>

						<li class="divider"></li>

						<li style="text-align: center; "> 
							
						  	{{-- <form class="form-inline " method="POST" action="{{url('/admin/logout')}}">
                                <hr>
                                {{ csrf_field() }}

                                <button class="btn btn-danger" type="submit">
                                	Logout
                                </button>

                            </form> --}}

                            <a href="{{url('/admin/logout')}}" class="btn btn-default " style="color:red;">
								Logout
							</a> 

						</li>

					</ul><!--END dropdown-menu drp-mnu-->

				</li><!--END dropdown profile_details_drop-->
			</ul>
		</div><!--END profile_details-->

		<div class="clearfix"> </div>		

	</div><!--END header-right-->

    <div class="clearfix"> </div>	

</div>
<!--heder end here-->