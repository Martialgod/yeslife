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





    <link rel="stylesheet" href="/swal/sweetalert.css">



    <!-- jquery
        ============================================ -->
    <script src="/adminpage/js/vendor/jquery-1.12.4.min.js"></script>


    <script src="/js/moment.js"></script>
 

    <script src="{{asset('/blockUI/jquery.blockUI.js')}}"></script>

    @yield('optional_styles')

</head>

<body style="background-color: #E4F3F5;">

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

      <br><br><br>
      <div class="container" id="app">
          <div class="row">
                
                <h1>Cart Page</h1>

                <div style="text-align:center;" id="divtblcartloading" >
                    <h3>
                        <i class="fa fa-spin fa-spinner"></i>Just a moment...
                    </h3>
                </div>


                <div hidden id="divtblcartcontent">

                    <form v-on:submit.prevent="confirmCheckout()"  action="#" method="POST" id="form-checkout" name="form-checkout" >

                        {{method_field('POST')}}
                        {{csrf_field()}}

                        <div class="col-md-4 alert alert-info" style="margin-right: 2px;" v-for="list in products">

                            <input type="hidden" name="productid[]" ng-model="list.productid">
                            
                            <h3>
                                @{{list.name}}
                            </h3>

                            <div class="form-group">
                                <div class="form-single nk-int-st widget-form">
                                    <label for="qty">Qty <span style="font-size: 12px; color:red;">*</span> </label>
                                    <input type="number" min="1" name="qty[]" v-model.number="list.selectedqty" v-on:keypress="validateNumber(list)">
                                </div>

                            </div>
                           
                            <b>Price: </b>@{{ list.price  | formatCurrency }}
                            <br>
                            <b>Disc%: </b>@{{list.discrate}}
                            <hr>
                            <b>Total: </b> @{{ list.netamount | formatCurrency }}
                            <br>

                            <button type="button" name="" v-on:click.prevent="removeFromCart(list)" class="btn btn-sm btn-danger"> Remove </button>

                        </div>


                        <div class="row">
                            
                        </div>

                        <hr>
                        <div style="text-align:center;" v-if="products.length>0">
                            <h3>
                              Total Net: @{{ computeTotal.totalnetamount  | formatCurrency  }}
                            </h3>

                            <br>
                            <button type="submit" class="btn btn-success notika-btn-success waves-effect">Update Cart</button>


                        </div>
                       
                    </form>

                    
                </div>


                <div style="text-align:center;" v-if="products.length==0" >
                    <h3>
                       Cart is empty
                    </h3>
                </div>


            


          </div> <!-- row end -->

         
      </div> <!-- container end -->


 
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
    
    <script src='/select2/select2.min.js' type="text/javascript" ></script>

    <script src="/customjs/GlobalScript.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>

    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="/customjs/GlobalVue.js"></script>

    <script type="text/javascript" src="customjs/CartVue.js"></script>



</body>

</html>

