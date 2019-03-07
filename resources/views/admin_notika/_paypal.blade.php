 <div id="paypal-button-container"></div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        // Render the PayPal button
        paypal.Button.render({
        // Set your environment
        env: 'sandbox', // sandbox | production

        // Specify the style of the button
        style: {
          layout: 'vertical',  // horizontal | vertical
          size:   'medium',    // medium | large | responsive
          shape:  'rect',      // pill | rect
          color:  'gold'       // gold | blue | silver | white | black
        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV
        funding: {
          allowed: [
            paypal.FUNDING.CARD,
            paypal.FUNDING.CREDIT
          ],
          disallowed: []
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
          sandbox: 'ATatyWc_gw-xz0tB08oBPFSQrU6sJSdeJjLDwuxdLW3kDOjuMBWttBqrj5WZezq80rQFlvSKPtJtw8LU',
          //production: '<insert production client id>'
        },

        payment: function (data, actions) {
          return actions.payment.create({
            payment: {
              transactions: [
                {
                  amount: {
                    total: '0.01',
                    currency: 'USD'
                  }
                }
              ]
            }
          });
        },

        onAuthorize: function (data, actions) {
          return actions.payment.execute()
            .then(function () {
                console.log(data);
                console.log(actions);
                window.alert('Payment Complete!');
            });
        }
        }, '#paypal-button-container');
    </script>
