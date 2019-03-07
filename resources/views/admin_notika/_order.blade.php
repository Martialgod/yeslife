@extends('admin.layouts.master')

@section('title', 'Admin Users Create Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('products.index')}}" data-toggle="tooltip" title="">
                <i class="fa fa-shopping-cart fa"></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('products.index')}}" class="text-success">
                    Sample Stripe Order
                </a>
            </h2> 



            <form action="/save-order" method="POST" >
              {{csrf_field()}}
              <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_lw165XaVufkl2HcIiEySdxJo"
                data-amount=""
                data-name="Serolf"
                data-description="Widget"
                data-billing-address="true"
                data-shipping-address="true"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
              </script>

              <script>
                  // Hide default stripe button, be careful there if you
                  // have more than 1 button of that class
                  document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
              </script>
              <button type="submit" class="btn btn-info">Proceed Checkout</button>

            </form>





            <br><br><br> 
            Enter Qty
            <input type="number" id="qty" name="qty" value="1" class="form-control">
            <hr>

            <form id="saveform" action="/save-order" method="POST">

                {{csrf_field()}}
            
                <script src="https://checkout.stripe.com/checkout.js"  data-billing-address="true"
                data-shipping-address="true"></script>

                <button id="customButton" type="submit"  class="btn btn-default">Purchase</button>

                <script>

         

                    var handler = StripeCheckout.configure({
                      key: 'pk_test_lw165XaVufkl2HcIiEySdxJo',
                      image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                      locale: 'auto',
                 
                      token: function(token, args) {
                        // You can access the token ID with `token.id`.
                        // Get the token ID to your server-side code for use.
                        console.log(token);
                        console.log(args);
                        //$('#saveform').submit();
                      }
                    });

                    document.getElementById('customButton').addEventListener('click', function(e) {
                      // Open Checkout with further options:
                      handler.open({
                        name: 'Serolf',
                        description: '',
                        amount: parseFloat(document.getElementById('qty').value),
                        zipCode: true,
                        billingAddress: true,
                        shippingAddress: true,
                      });
                      e.preventDefault();
                    });

                    // Close Checkout on page navigation:
                    window.addEventListener('popstate', function() {
                      handler.close();
                    });

                </script>

      


            </form>


            <br><br><br><br>

            <!-- Load Stripe.js on your website. -->
            <script src="https://js.stripe.com/v3" ></script>

            <div id="payment-request-button">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Create a button that your customers click to complete their purchase. -->
            <button id="checkout-button" class="btn btn-default">Buil-in Checkout</button>
            <div id="error-message"></div>

            <script>
              
              var stripe = Stripe('pk_test_lw165XaVufkl2HcIiEySdxJo', {
                betas: ['checkout_beta_4'],
              });

   

              var checkoutButton = document.getElementById('checkout-button');
              checkoutButton.addEventListener('click', function () {
                // When the customer clicks on the button, redirect
                // them to Checkout.
                stripe.redirectToCheckout({
                  items: [
                        {sku: 'sku_EBuKheXh8NBijo', quantity: parseFloat(document.getElementById('qty').value) },
                        {sku: 'sku_EBujOKSLaERkYT', quantity: parseFloat(document.getElementById('qty').value) }
                  ],

                  // Note that it is not guaranteed your customers will be redirected to this
                  // URL *100%* of the time, it's possible that they could e.g. close the
                  // tab between form submission and the redirect.
                  successUrl: 'http://cbd.local/order/4',
                  cancelUrl: 'http://cbd.local/order/4',
                })
                
                .then(function (result, args) {
                    console.log(result);
                    console.log(args);
                  if (result.error) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer.
                    var displayError = document.getElementById('error-message');
                    displayError.textContent = result.error.message;
                  }
                });
              });
            </script>

           
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    