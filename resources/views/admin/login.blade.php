<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
	<title>Yes.Life Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="YesLife" />

	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/landingpage/assets/images/favicon.png">
    

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link href="/adminpage/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<!-- Custom Theme files -->
	<link href="/adminpage/css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<!--js-->
	<script src="/adminpage/js/jquery-2.1.1.min.js"></script> 
	<!--icons-css-->
	<link href="/adminpage/css/font-awesome.css" rel="stylesheet"> 
	<!--Google Fonts-->
	<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
	<!--static chart-->
</head>
<body>	
	
	<div class="login-page">
	    <div class="login-main">  	
	    	 <div class="login-head">
					<h1>Yes.Life Login</h1>
				</div>
				<div class="login-block">

					@if( isset($is_login) && $is_login == 'error' )
	                    <h5 class="text-danger" style="margin-top: -20px;">
	                        <b> Invalid Login Details! </b>
	                    </h5>
	                    <br>
	                @endif  

					<form class="form" method="POST" action="">

						{{ csrf_field() }}
						{{ method_field('POST') }}
						
						<input type="text" name="uname" placeholder="Username" required="" value="{{ isset($uname) ? $uname : '' }}" autofocus="" >
						
						<input type="password" name="password" class="lock" required=""  placeholder="Password">
						
						<div class="forgot-top-grids">
							
							{{--<div class="forgot-grid">
								<ul>
									<li>
										<input type="checkbox" id="brand1" value="">
										<label for="brand1"><span></span>Remember me</label>
									</li>
								</ul>
							</div>--}}

							{{--<div class="forgot">
								<a href="#">Forgot password?</a>
							</div>--}}

							<div class="clearfix"> </div>
						</div>

						<input type="submit" name="Sign In" value="Login">	
						
					</form>

					<h5><a href="{{url('/')}}">Go Back to Home</a></h5>

				</div>

	      </div>
	</div>
	<!--inner block end here-->
	
	<!--copy rights start here-->
	<div class="copyrights">
		 <p>© {{date('Y')}} Yes.Life. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
	</div>	
	<!--COPY rights end here-->

	<!--scrolling js-->
	<script src="/adminpage/js/jquery.nicescroll.js"></script>
	<script src="/adminpage/js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="/adminpage/js/bootstrap.js"> </script>
	<!-- mother grid end here-->

</body>
</html>


                      
						
