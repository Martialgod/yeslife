<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CBD | Admin Login Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/normalize.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/wave/waves.min.css">
    <!-- Notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/notika-custom-icon.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/main.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/style.css?v={{time()}}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="/adminpage/css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="/adminpage/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Login Register area Start-->
    
    <form class="form" method="POST" action="" >
         
        <div class="login-content">
    
                {{ csrf_field() }}

                <!-- Login -->
                <div class="nk-block toggled" id="l-login">
                    
                    <div class="nk-form">

                        <h1>Admin Login Page</h1>
                        <br>


                        <div class="input-group mg-t-15">
                            <span class="input-group-addon nk-ic-st-pro">
                                <i class="fa fa-user fa-fa"></i>
                            </span>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Username" id="uname" name="uname" aria-describedby="emailHelp" placeholder="Enter Username" maxlength="15" required="" value="{{ isset($uname) ? $uname : '' }}" >
                            </div>
                        </div>
                        
                  
                        <div class="input-group mg-t-15">
                            <span class="input-group-addon nk-ic-st-pro">
                                <i class="fa fa-lock fa-fa"></i>
                            </span>
                            <div class="nk-int-st">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" value="">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-login btn-success btn-float">
                           <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
                        </button>


                        @if( isset($is_login) && $is_login == 'error'  )
                            <div class="text-danger">
                                <br>
                                <b> Invalid Login Details! </b>
                            </div>
                           
                        @endif  

                    </div>

                </div><!--END nk-block toggled-->
                

        </div><!--END login-content-->

    </form>


    <!-- Login Register area End-->
    <!-- jquery
        ============================================ -->
    <script src="/adminpage/js/vendor/jquery-1.12.4.min.js"></script>
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
    <!--  Chat JS
        ============================================ -->
    <script src="/adminpage/js/chat/jquery.chat.js"></script>
    <!--  wave JS
        ============================================ -->
    <script src="/adminpage/js/wave/waves.min.js"></script>
    <script src="/adminpage/js/wave/wave-active.js"></script>
    <!-- icheck JS
        ============================================ -->
    <script src="/adminpage/js/icheck/icheck.min.js"></script>
    <script src="/adminpage/js/icheck/icheck-active.js"></script>
    <!--  todo JS
        ============================================ -->
    <script src="/adminpage/js/todo/jquery.todo.js"></script>
    <!-- Login JS
        ============================================ -->
    <script src="/adminpage/js/login/login-action.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="/adminpage/js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="/adminpage/js/main.js"></script>
</body>

</html>