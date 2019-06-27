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

    @php


        if( strpos(url()->current(), '/order/success') ){
            //trigger google analytics ecommerce tracking in order success page
            $tempItems = [];
            foreach( $orderdtls as $key=> $v ){

                $tempItems[] ="{
                    'sku': '$v->fk_products',
                    'name': '$v->name',
                    'category': '$v->category',
                    'price': $v->unitprice,
                    'quantity': $v->qty
                }";

            }

            $tempItems = implode(',', $tempItems);

            echo "<script> ";

            echo "window.dataLayer = window.dataLayer || []; ";

            echo 'dataLayer.push({';

            echo "'event':'TransactionComplete',
                      'transactionId': '$orders->trxno',
                      'transactionAffiliation': 'YES.life',
                      'transactionTotal': $orders->netamount,
                      'transactionTax': $orders->totaltax,
                      'transactionShipping': $orders->totalshipcost,
                      'transactionProducts': [$tempItems]";


            echo '});';


            echo " </script>";

        }


    @endphp


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

        //LeadDyno.devTools.reset();

    </script>

    <script data-obct type="text/javascript">
        /** DO NOT MODIFY THIS CODE**/
        !function(_window, _document) {
          var OB_ADV_ID='00f8c14969788d63b6869a2e8a86d80aee';
          if (_window.obApi) {var toArray = function(object) {return Object.prototype.toString.call(object) === '[object Array]' ? object : [object];};_window.obApi.marketerId = toArray(_window.obApi.marketerId).concat(toArray(OB_ADV_ID));return;}
          var api = _window.obApi = function() {api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);};api.version = '1.1';api.loaded = true;api.marketerId = OB_ADV_ID;api.queue = [];var tag = _document.createElement('script');tag.async = true;tag.src = '//amplify.outbrain.com/cp/obtp.js';tag.type = 'text/javascript';var script = _document.getElementsByTagName('script')[0];script.parentNode.insertBefore(tag, script);}(window, document);
        obApi('track', 'PAGE_VIEW');
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

    <script type="text/javascript">
        
    </script>



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

            .toast-success {
                background-color: #2da365;
                color: #000;
                font-size: 14px;
            }

            .toast-broadcast .toast-title {
              color: #000;
            }

            .toast-broadcast .toast-message {
              color: #000;
            }

            .banner100px{
                margin-bottom: -80px;
            }


           .cd-top--is-visible { 
              visibility: visible;
              opacity: 1;
            }

            .cd-top--fade-out {
              opacity: .5;
            }

           /* #backToTop{
                position: fixed;
                bottom: 50px;
                float: right;
                left: 92%;
                width: auto;
                font-size: 14px;
                background-color: transparent;
                padding: 2px;
                border-radius: 4px;
                z-index: 1000;
                color:#8a8c8e;

            }*/

            #backToTop {
              display: inline-block;
              background-color: #FF9800;
              width: 50px;
              height: 50px;
              text-align: center;
              border-radius: 4px;
              position: fixed;
              bottom: 30px;
              right: 30px;
              transition: background-color .3s, 
                opacity .5s, visibility .5s;
              opacity: 0;
              visibility: hidden;
              z-index: 1000;
            }
            #backToTop::after {
              content: "\f077";
              font-family: FontAwesome;
              font-weight: normal;
              font-style: normal;
              font-size: 2em;
              line-height: 50px;
              color: #fff;
            }
            #backToTop:hover {
              cursor: pointer;
              background-color: #333;
            }
            #backToTop:active {
              background-color: #555;
            }
            #backToTop.show {
              opacity: 1;
              visibility: visible;
            }



    </style>

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/fd43a58c0196c02d18943fb38/ae8e24929525fceb390d21e38.js");</script>


    @yield('optional_styles')



</head>

<body style="" ><!--#f5f7f9-->

    <!-- all your content here --> 
   <!-- <button id="backToTop" class=cd-top text-replace js-cd-top" hidden> 
        <i class="fa fa-long-arrow-up fa-3x" aria-hidden="true"></i>TOP 
    </button> -->

    <a id="backToTop"></a>

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

        {{--optional, for referral links--}}
        <input type="hidden" readonly="" id="referrer_token" name="referrer_token" value="{{ ($referrer) ? $referrer->affiliate_token : ''}}">
        
        {{--initialize @App/Providers/AppServiceProvider.php--}}
        <input type="hidden" readonly="" id="yeslife_referrer_id" name="yeslife_referrer_id" value="{{session('yeslife_referrer_id')}}">

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



        $(document).on( "click",".fb-share",  function(e){
            //here sweet alert closes when I press this button. 
            openFbPopup(); 
        });

    </script>


    <script type="text/javascript">

        /*$(document).ready(function(){
            $('#backToTop').prop('hidden', false);
            $('#backToTop').fadeOut(0); 
        });
        // ===== Scroll to Top ==== 
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 500) {        // If page is scrolled more than 50px
                $('#backToTop').fadeIn(200);    // Fade in the arrow
            } else {
                $('#backToTop').fadeOut(200);   // Else fade out the arrow
            }
        });

        $('#backToTop').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });*/

        var btn = $('#backToTop');

        $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            btn.addClass('show');
          } else {
            btn.removeClass('show');
          }
        });

        btn.on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({scrollTop:0}, '300');
        });


    </script>

    

    {{--@if( session('yeslife_legal_age') != 'yes' )

        <script type="text/javascript">
        
            sweetAlert({
                title: "",
                text: "You must be 18 years or older to order CBD products. If you are of legal age click Enter.",
                type: null,
                confirmButtonText: "ENTER",
                confirmButtonColor: '#3a95c2',
                html: "You must be 18 years or older to order CBD products. If you are of legal age click Enter.",
                //closeOnConfirm: false, //It does close the popup when I click on close button
                //closeOnCancel: false,
                allowOutsideClick: false, 
                allowEscapeKey: false
            }).then(function(result){
                if (result.value) {
                   location.href="/session/legal-age";
                }
            }); 


        </script>


    @endif --}}
    



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