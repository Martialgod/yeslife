<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>

	<title> @yield('title') </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="YesLife Admin Home Page" />

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
	<!--//skycons-icons-->


	<link href="/adminpage/css/hover.css" rel="stylesheet" media="all">


    <link rel="stylesheet" href="/swal/sweetalert.css">

   	<link href="/select2/select2.min.css" rel="stylesheet" type="text/css" />



    <style type="text/css" media="screen">
    	
    	.label-required{
    		font-size: 12px; color:red;
    	}
    	
    	.pagination-margin-top{
    		margin-top: -20px;
    	}

    	.error{
    		color:red;
    	}
  

    </style>


    <script src="{{asset('/blockUI/jquery.blockUI.js')}}"></script>

    <script src="{{asset('/angular1.6.6/angular.min.js')}}"></script>
    <script src="{{asset('/angular1.6.6/angular-sanitize.min.js')}}"></script>

    <script src="{{asset('/customjs/AppServices.js')}}?v={{time()}}"></script>



	@yield('optional_styles')

</head>

<body>	

	<div class="page-container">

	   <div class="left-content">

		   	<div class="mother-grid-inner">

			   	@include('admin.layouts.header')
		            
				<!-- script-for sticky-nav -->
				<script>
				$(document).ready(function() {
					 var navoffeset=$(".header-main").offset().top;
					 $(window).scroll(function(){
						var scrollpos=$(window).scrollTop(); 
						if(scrollpos >=navoffeset){
							$(".header-main").addClass("fixed");
						}else{
							$(".header-main").removeClass("fixed");
						}
					 });
					 
				});
				</script>
				<!-- /script-for sticky-nav -->



				<!--inner block start here-->
				<div class="inner-block">

					<div class="blank">

						@yield('content-header')

						{{--class="blankpage-main" --}}
						<div style="margin-top: -10px;">

							@yield('content-body')
						

						</div><!--END blankpage-main-->

					</div><!--END blank-->

				</div>
				<!--inner block end here-->


				<!--copy rights start here-->
				<div class="copyrights">
					 <p>© {{date('Y')}} YesLife. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
				</div>	
				<!--COPY rights end here-->

			</div><!--END mother-grid-inner-->

		</div><!--END left-content-->

		@include('admin.layouts.sidebar')


		<div class="clearfix"> </div>
		<!--slide bar menu end here-->

	</div><!--END page-container-->



	<script>
		var toggle = true;
		            
		$(".sidebar-icon").click(function() {                
		  if (toggle)
		  {
		    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
		    $("#menu span").css({"position":"absolute"});
		  }
		  else
		  {
		    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
		    setTimeout(function() {
		      $("#menu span").css({"position":"relative"});
		    }, 400);
		  }               
	        toggle = !toggle;
	    });
	</script>


	<!--scrolling js-->
	<script src="/adminpage/js/jquery.nicescroll.js"></script>
	<script src="/adminpage/js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="/adminpage/js/bootstrap.js"> </script>
	<!-- mother grid end here-->


	<!--<script src="/swal/sweetalert.min.js"></script>-->
    <script src="/swal/sweetalert2.all.js"></script>
    <script src="/swal/promise.min.js"></script>

    <script src="/js/moment.js"></script>
 
    <script src="/customjs/GlobalScript.js?v={{time()}}"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script> --}}

    <script src="/jqueryvalidate1.19.0/dist/jquery.validate.min.js"></script>
    <script src="/jqueryvalidate1.19.0/dist/additional-methods.min.js"></script>

    <!--select2-->
    <script src="/select2/select2.min.js"></script>



   	<script type="text/javascript">
        
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });


        function injectTrim(handler) {
          return function (element, event) {
            if (element.tagName === "TEXTAREA" || (element.tagName === "INPUT" 
                                               && element.type !== "password")) {
              element.value = $.trim(element.value);
            }
            return handler.call(this, element, event);
          };
        };

        $(".jqvalidate-form").validate({
            onfocusout: injectTrim($.validator.defaults.onfocusout)
        });


    </script>



    @yield('optional_scripts')

</body>

</html>


                      
						
