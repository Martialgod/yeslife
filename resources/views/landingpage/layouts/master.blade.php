<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <!-- Google Search Console  -->
    <meta name="google-site-verification" 
    content="SAaIoQrbzeyiUzsaMGLSY_3HEqRnGcS08eLh9MI8RDk" />

    <meta name="p:domain_verify" content="efbec8bf918ea4d0f429df5435959c51"/>

    <meta name="msvalidate.01" content="1D5F67923C25997C33F9A152A689FFEA" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M82X8X4');</script>
    <!-- End Google Tag Manager -->



    <!--leaddyno affiliate code -->
    <script type="text/javascript" src="https://static.leaddyno.com/js"></script>
    <script>
      LeadDyno.key = "4e4aa7fc362a674eec1a9780884d24f3799edc09";
      LeadDyno.recordVisit();
      LeadDyno.autoWatch();
    </script>


    <title>@yield('title')</title>

    @yield('meta')

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/landingpage/assets/images/faviconv3.png">
    
    <!-- CSS
    ============================================ -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/landingpage/assets/css/bootstrap.min.css">
    
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/landingpage/assets/css/font-awesome.min.css">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/landingpage/assets/css/plugins.css">
    
    <!-- Helper CSS -->
    <link rel="stylesheet" href="/landingpage/assets/css/helper.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/landingpage/assets/css/style.css?v={{time()}}">

    <link rel="stylesheet" href="/swal/sweetalert.css">

    <link rel="stylesheet" href="/toastr/toastr.min.css">

    <!-- jQuery JS -->
    <script src="/landingpage/assets/js/vendor/jquery-1.12.4.min.js"></script>
    
    <!-- Modernizer JS -->
    <script src="/landingpage/assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <script src="{{asset('/blockUI/jquery.blockUI.js')}}"></script>

    <script src="{{asset('/angular1.6.6/angular.min.js')}}"></script>
    <script src="{{asset('/angular1.6.6/angular-sanitize.min.js')}}"></script>

    <script src="{{asset('/customjs/AppServices.js')}}?v={{time()}}"></script>

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
      

        .custom-default-btn{
            background-color: #ffffff;
            color:#222222;
        }

  

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                z-index: 3;
                color: /*#fff; */
                cursor: default;
                background-color: #ffffff; /*#337ab7;*/
                border-color: #00c292;
            }
            .pagination>li>a, .pagination>li>span {
                position: relative;
                float: left;
                padding: 6px 12px;
                margin-left: -1px;
                line-height: 1.42857143;
                color: /*#ffffff; /*#337ab7;*/
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


            .toast-broadcast {
                background-color: #ffffff;
                color: #000;
                font-size: 14px;
            }

            .toast-broadcast .toast-title {
              color: #000;
            }

            .toast-broadcast .toast-message {
              color: #000;
            }





    </style>


    @yield('optional_styles')



</head>

<body style="" ><!--#f5f7f9-->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M82X8X4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    {{--
        Generated @AppServiceProvider.php
        required to all page; determine if user is currently logged in. 
        @GlobalScript.js addCartCookie,  if user is logged in then save cart to DB encase 
        customer abandons the cart. The system will have a record to followup through email
    --}}

    <div class="form-group" hidden >
        <input type="hidden" id="isloggedin" value="{{$isloggedin}}">
    </div>

    {{--
        @AppServiceProvider.php
    --}}
    <span hidden >
        <i id="toastrbroadcastcount" hidden>{{$toastrbroadcastcount}}</i>
        <i id="toastrbroadcasttitle" hidden>{!!$toastrbroadcastmstr!!}</i>
        <i id="toastrbroadcastmessage" hidden>{!!$toastrbroadcastdtls!!}</i>
    </span>

    <div class="main-wrapper">



        @include('landingpage.layouts.header')


        @yield('content-body')



        @include('landingpage.layouts.subscription')
        
        
        {{--<form action="https://app.leaddyno.com/provision" method="post">
          Enter Email: <input name="email"/ required="">
          <input type="hidden" name="key" value="4e4aa7fc362a674eec1a9780884d24f3799edc09"/>
          <input type="submit" value="Join Our Affiliate Program"/>
        </form> --}}
    


        @include('landingpage.layouts.services')

        
        @include('landingpage.layouts.footer-top')
        

        @include('landingpage.layouts.footer-bottom')


    </div>


    <!-- JS
    ============================================ -->

    <!-- Popper JS -->
    <script src="/landingpage/assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/landingpage/assets/js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="/landingpage/assets/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="/landingpage/assets/js/main.js"></script>


    <script src="/toastr/toastr.min.js"></script>

    <!--<script src="/swal/sweetalert.min.js"></script>-->
    <script src="/swal/sweetalert2.all.js"></script>
    <script src="/swal/promise.min.js"></script>

    <script src="/js/moment.js"></script>
 
    <script src="/customjs/GlobalScript.js?v={{time()}}"></script>

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

        
        $(document).ready(function(){
            $(".jqvalidate-form").validate({
                onfocusout: injectTrim($.validator.defaults.onfocusout)
            });

            $(".jqvalidate-form-2").validate({
                onfocusout: injectTrim($.validator.defaults.onfocusout)
            });

        });


        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 1000,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        }


        $(document).ready(function(){

            //reset cart count based on cookie if user is not loggedin
            //if loggedin then cart count is equals to db qty
            if( $("#isloggedin").val() == 'no' ){

                updateCartCookieCount();//GlobalScript.js

            }
           
            //deleteAllCartCookies();
            //console.log( getCartCookies() );
        });


    </script>




    <script src="/customjs/Subscription.js?v={{time()}}" type="text/javascript"></script>

    {{--twitter share --}}
    <script>window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));</script>



    @yield('optional_scripts')


</body>

    @yield('rallyapikey')

</html>