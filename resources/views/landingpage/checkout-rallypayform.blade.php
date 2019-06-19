<!-- Payment Method  -->
<div class="col-lg-12 col-12 mb-30 d-flex">

    <div class="checkout-cart-total" >

        <h4>Card Details</h4>

        <div style="color:#ffffff;">
          <label>Card Number *</label>
          <input style="color:#666;" class="credit-card-number" type="text" id="rally_cardNumber" placeholder="XXXX XXXX XXXX XXXX" data-input="rally_cardNumber" value="{{$users['cardno']}}" maxlength="19" required="">
          <span id="errrally_cardNumber" style="color:red; font-size: 12px;"> </span>
        </div>

        <div class="row">
            <div class="col-md-6 mb-20">
              <label style="color:#ffffff;">Expiry Date *</label>
              <input style="color:#666;" class="credit-card-expiry" type="text" id="rally_expDate" placeholder="MM/YYYY" data-input="rally_expDate" maxlength="7" value="{{$users['expdate']}}">
              <span id="errrally_expDate" style="color:red; font-size: 12px;"> </span>
            </div>

          <div class="col-md-6 mb-20">
              <label style="color:#ffffff;">CVC *</label>
              <input style="color:#666;" type="text" id="rally_cvc" placeholder="XXX" data-input="rally_cvc" maxlength="4" value="{{$users['cvc']}}">
              <span id="errrally_cvc" style="color:red; font-size: 12px;"> </span>
          </div>

        </div>


        {{-- <button id="paymentSubmit" type="button">Submit</button> --}}


        <div class="" style="margin-top: -50px;">


          <a href="#" class="place-order btn btn-round custom-default-btn col-md-6" ng-click="vm.ShowCart()">
            Back to Cart 
          </a>
      
          <button type="submit" id="paymentSubmit" class="place-order btn btn-round col-md-6">Place order</button>

          
        </div>
      
    </div><!--END checkout-cart-total-->

</div><!--END col-12 mb-60-->
