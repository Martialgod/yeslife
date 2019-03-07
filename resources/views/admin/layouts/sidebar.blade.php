<!--slider menu-->
<div class="sidebar-menu">

	  	<div class="logo"> 
	  		
	  		<a href="#" class="sidebar-icon"> 
	  			<span class="fa fa-bars"></span> 
	  		</a> 
	  		
	  		<a href="#"> 
	  			<span id="logo" ></span> 
		      	<!--<img id="logo" src="" alt="Logo"/>--> 
		  	</a> 

		</div><!--END logo-->

	    <div class="menu">

	      	<ul id="menu" >

	      		@if( isset($main_menu) )

		      		@foreach ($main_menu as $key => $main)

		      			@if( $main->type == 'A' )

		      				<li class="{{ session('parent_tab') == $main->family ? 'active' : '' }}" >

					        	<a href="{{ ( $main->route ) ? route($main->route) : '#'  }}" style="text-decoration: none;">
					        		<i class="{{$main->icon}}"></i>
					        		<span>{{$main->description}}</span>

					        		@if( $main->iswithchild == '1' )
					        			<span class="fa fa-angle-right" style="float: right"></span>
					        		@endif

					        	</a>



					        	<ul>

					        		@foreach($main_menu as $key => $sub)

					        			@if( $sub->type == 'B' && $sub->family == $main->family )

							        		<li class="{{ session('child_tab') == $sub->route ? 'active' : '' }}">
							            		<a href="{{route($sub->route)}}"> 
							            			{{ $sub->description }} 
							            		</a>
							            	</li>

					        			@endif


					        		@endforeach

					          	</ul>

					        </li>


		      			@endif

		      		@endforeach


	      		@endif


		        <li class="{{ session('active_tab') == 'Home' ? 'active' : '' }}" id="menu-home" >
		        	<a href="{{url('/')}}">
		        		<img src="/landingpage/assets/images/favicon.png" alt="" style="width: 20px;" >
		        		<br>
		        		<span>Yes.Life</span>
		        	</a>
		        </li>


	      	</ul><!--END menu-->

	    </div><!--END menu-->

</div><!--END sidebar-menu-->