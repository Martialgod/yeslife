<!DOCTYPE html>
<html>
<head>
  <title></title>

  {{--<script type="text/javascript" src="https://staging.rallypay.com/v1/staging-rallypay.js"></script> --}}

  <script type="text/javascript" src="https://rallypay.com/v1/rallypay.js"></script>

</head>
<body>

  <!-- Payment Method  -->
  <div class="col-12 mb-60">

      <div class="checkout-cart-total" >

        <form action="" method="post" accept-charset="utf-8">
      

          <h4>Card Details</h4>


          <div style="color:#;">
            <label>Firstname **</label>
            <input id="firstname" style="color:#666;" type="text" placeholder="" data-input="rally_firstName" value="Jhon">
          </div>

          <div style="color:#;">
            <label>Lastname **</label>
            <input id="lastname" style="color:#666;" type="text" placeholder="" data-input="rally_lastName" value="Doe">
          </div>

          <div style="color:#;">
            <label>Email **</label>
            <input id="email" style="color:#666;" type="text" placeholder="" value="j@mail.com" data-input="rally_email">
          </div>

          <div style="color:#;">
            <label>Phone Number **</label>
            <input id="phonenumber" style="color:#666;" type="text" placeholder="" value="03213" data-input="rally_phoneNumber">
          </div>

          <div style="color:#;">
            <label>Address **</label>
            <input id="address" style="color:#666;" type="text" placeholder="" value="Addres 1" data-input="rally_addressLine">
          </div>


          <div style="color:#;">
            <label>City **</label>
            <input id="city" style="color:#666;" type="text" placeholder="" value="City" data-input="rally_addressCity">
          </div>

          <div style="color:#;">
            <label>State **</label>
            <input id="state" style="color:#666;" type="text" placeholder="" value="State" data-input="rally_addressState">
          </div>

          <div style="color:#;">
            <label>Country **</label>
            <input id="country" style="color:#666;" type="text" placeholder="" value="USA" data-input="rally_addressCountry">
          </div>

          <div style="color:#;">
            <label>Zipcode **</label>
            <input id="zipcode" style="color:#666;" type="text" placeholder="" value="321" data-input="rally_addressZip">
          </div>

          <div style="color:#;">
            <label>Occupation </label>
            <input id="occupation" style="color:#666;" type="text" placeholder="" value="IT" data-input="rally_occupation">
          </div>

          <div style="color:#;">
            <label>Employer </label>
            <input id="employer" style="color:#666;" type="text" placeholder="" value="APR" data-input="rally_employer">
          </div>

          <div style="color:#;">
            <label>Amount **</label>
            <input id="amount" style="color:#666;" type="number" placeholder="" value="1" data-input="rally_amount">
          </div>

          <div style="color:#;">
            <label>Gender </label>
            <input id="gender" style="color:#666;" type="text" placeholder="" value="M" data-input="rally_gender">
          </div>


          <div style="color:#;">
            <label>Card Number **</label>
            <input style="color:#666;" type="text" placeholder="XX-XXXX-XXXX-XX" value="4242424242424242" data-input="rally_cardNumber">
          </div>

          <div style="color:#;">
            <label style="color:#;">CVC*</label>
            <input style="color:#666;" type="text" placeholder="XXX" value="123" data-input="rally_cvc">
          </div>

          <div style="color:#;">
            <label>Expiry Date **</label>
            <input style="color:#666;" type="text" placeholder="mm-yy" value="03/43" data-input="rally_expDate">
          </div>

          <button id="paymentSubmit" type="button">Submit</button>

        </form>


        
      </div><!--END checkout-cart-total-->

  </div><!--END col-12 mb-60-->

</body>

  <script type="text/javascript">

      Rally.setPublishableKey('pk_live_c15b10d1e39a990c2165080985f5b9b9');

  </script>

</html>

