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

		        <li class="{{ session('active_tab') == 'Home' ? 'active' : '' }}" id="menu-home" >
		        	<a href="{{route('admin.home')}}">
		        		<i class="fa fa-tachometer"></i>
		        		<span>Dashboard</span>
		        	</a>
		        </li>


		        @php 
		        	$tabproducts = ['Products', 'Category'];
		        @endphp 
		        <li class="{{ ( in_array(session('active_tab'), $tabproducts) ) ? 'active' : '' }}" >
		        	<a href="#" style="text-decoration: none;">
		        		<i class="fa fa-cube fa"></i>
		        		<span>Products</span>
		        		<span class="fa fa-angle-right" style="float: right"></span>
		        	</a>
		          	<ul>

		            	<li class="{{ session('active_tab') == 'Products' ? 'active' : '' }}">
		            		<a href="{{url('/admin/products')}}">Master List</a>
		            	</li>

		            	<li class="{{ session('active_tab') == 'Category' ? 'active' : '' }}">
		            		<a href="{{url('/admin/category')}}">Category</a>
		            	</li>	

		          	</ul>
		        </li>


		        @php 
		        	$tabusers = ['Users', 'UserType'];
		        @endphp 
		        <li class="{{ ( in_array(session('active_tab'), $tabusers) ) ? 'active' : '' }}" >
		        	<a href="#" style="text-decoration: none;">
		        		<i class="fa fa-users fa"></i>
		        		<span>Users</span>
		        		<span class="fa fa-angle-right" style="float: right"></span>
		        	</a>
		          	<ul>

		            	<li class="{{ session('active_tab') == 'Users' ? 'active' : '' }}">
		            		<a href="{{url('/admin/users')}}">Master List</a>
		            	</li>

		            	<li class="{{ session('active_tab') == 'UserType' ? 'active' : '' }}">
		            		<a href="{{url('/admin/usertype')}}">Type</a>
		            	</li>	

		          	</ul>
		        </li>

	      	</ul><!--END menu-->

	    </div><!--END menu-->

</div><!--END sidebar-menu-->