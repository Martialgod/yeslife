<!doctype html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="POD, voicebox, callcenter, agents, trainer" />
    <meta name="keywords" content="POD, voicebox, callcenter, agents, trainer" />
    <meta name="author" content="FiercecomInc" />
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="/adminpage/img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/bootstrap.min.css">
    <!-- font awesome CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/font-awesome.min.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/owl.carousel.css">
    <link rel="stylesheet" href="/adminpage/css/owl.theme.css">
    <link rel="stylesheet" href="/adminpage/css/owl.transitions.css">
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/normalize.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/notika-custom-icon.css">
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/wave/waves.min.css">
    <link rel="stylesheet" href="/adminpage/css/wave/button.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/main.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="/adminpage/js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- bootstrap select CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/bootstrap-select/bootstrap-select.css">

    <link href="/select2/select2.min.css" type="text/css" rel="stylesheet" /> 



    <style type="text/css">

        .bglight{
            /*background-image:url('/adminpage/img/bglight.jpg'); */
        }

        label{
            font-size: 12px;
        }

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #00c292; /*#337ab7;*/
            border-color: #00c292;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #00c292; /*#337ab7;*/
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .center-container {
          float: left;
          position: relative;
          left: 50%;
        }
        .center-fixer-container {
          float: left;
          position: relative;
          left: -50%;
        }

    </style>


    <style type="text/css">
        
        .audiojs{
           width:230px;
           height:35px;
        }

        .audiojs .scrubber {
            background: none repeat scroll 0 0 #5A5A5A;
            border-bottom: 0 none;
            border-left: 0 none;
            border-top: 1px solid #3F3F3F;
            float: left;
            height: 14px;
            margin: 10px;
            overflow: hidden;
            position: relative;
            width: 75px;
        }

        .audiojs .time {
            border-left: 1px solid #000000;
            color: #DDDDDD;
            float: left;
            height: 36px;
            line-height: 36px;
            margin: 0; 
            padding: 0 6px 0 9px; 
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5);
        }

        .audiojs {
            font-family: monospace;
            font-size: 10px; 
        }

    </style>



    <link rel="stylesheet" href="/swal/sweetalert.css">



    <!-- jquery
        ============================================ -->
    <script src="/adminpage/js/vendor/jquery-1.12.4.min.js"></script>


    <script src="/js/moment.js"></script>
 

    <script src="{{asset('/blockUI/jquery.blockUI.js')}}"></script>

    <script src="{{asset('/angular1.6.6/angular.min.js')}}"></script>

    <script src="{{asset('/customjs/AppServices.js')}}"></script>

    @yield('optional_styles')

</head>

<body style="background-color: #E4F3F5;">

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    @include('admin.layouts.header')

    @include('admin.layouts.breadcrumb')

    @yield('content')

    @include('admin.layouts.footer')


 
    <!-- bootstrap JS
        ============================================ -->
    <script src="/adminpage/js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="/adminpage/js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="/adminpage/js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="/adminpage/js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="/adminpage/js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="/adminpage/js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
        ============================================ -->
    <script src="/adminpage/js/counterup/jquery.counterup.min.js"></script>
    <script src="/adminpage/js/counterup/waypoints.min.js"></script>
    <script src="/adminpage/js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="/adminpage/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="/adminpage/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="/adminpage/js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
        ============================================ -->
    <script src="/adminpage/js/flot/jquery.flot.js"></script>
    <script src="/adminpage/js/flot/jquery.flot.resize.js"></script>
    <script src="/adminpage/js/flot/flot-active.js"></script>
    <!-- knob JS
        ============================================ -->
    <script src="/adminpage/js/knob/jquery.knob.js"></script>
    <script src="/adminpage/js/knob/jquery.appear.js"></script>
    <script src="/adminpage/js/knob/knob-active.js"></script>
    <!--  wave JS
        ============================================ -->
    <script src="/adminpage/js/wave/waves.min.js"></script>
    <script src="/adminpage/js/wave/wave-active.js"></script>
    <!-- icheck JS
        ============================================ -->
    <script src="/adminpage/js/icheck/icheck.min.js"></script>
    <script src="/adminpage/js/icheck/icheck-active.js"></script>
    <!--  Chat JS
        ============================================ -->
    <script src="/adminpage/js/chat/jquery.chat.js"></script>
    <!--  todo JS
        ============================================ -->
    <script src="/adminpage/js/todo/jquery.todo.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="/adminpage/js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="/adminpage/js/main.js"></script>

    <!-- bootstrap select JS
        ============================================ -->
    <script src="/adminpage/js/bootstrap-select/bootstrap-select.js"></script>
    
    <!-- tawk chat JS
        ============================================ -->
    {{-- <script src="/adminpage/js/tawk-chat.js"></script> --}}

    <!--printThis-->
    <script src='/printThis/printThis.js' type="text/javascript" ></script>


    @yield('optional_scripts')

    <!--<script src="/swal/sweetalert.min.js"></script>-->
    <script src="/swal/sweetalert2.all.js"></script>
    <script src="/swal/promise.min.js"></script>

    <script src="/jscolor-2.0.5/jscolor.js"></script>

    <script src="/audiojs/audiojs/audio.min.js"></script>
    
    <script src="/customjs/GlobalScript.js"></script>

    <script src='/select2/select2.min.js' type="text/javascript" ></script>


    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
      audiojs.events.ready(function() {
        var as = audiojs.createAll();
      });
    </script>


</body>

</html>