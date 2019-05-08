<!-- Subscribe Section Start -->
<div class="subscribe-section section position-relative pt-70 pb-70 pt-md-60 pb-md-60 pt-sm-50 pb-sm-50 pt-xs-50 pb-xs-50 fix" id="subscription-div">
   
    <div class="container">
        
        <div class="row align-items-center">
            
            <div class="col-12">
                
                <div class="subscribe-wrap">
                    
                    <h3>Special <span>Offers</span> for Subscription</h3>
                    <h1>GET INSTANT DISCOUNT FOR MEMBERSHIP</h1>
                    <p>Subscribe to our newsletter and get all fresh information about our latest products, promotions, offers and discounts.</p>
                    
                    {{--id:mc-form  class:--}}
                    <form id="form-subscription" id="form-subscription" class="subscribe-form"  method="POST" action="#" >

                        {{method_field('POST')}}
                        {{ csrf_field() }}

                        {{--initialize @App/Providers/AppServiceProvider.php--}}
                        <input type="hidden" readonly="" id="refno_subs" name="refno_subs" value="{{session('yeslife_referrer_id')}}">

                        <input id="subemail" name="subemail" type="email" required="" placeholder="Enter your email here" />
                        <button id="mc-submit">submit</button>

                    </form>

                 

                    <!-- mailchimp-alerts Start -->
                    <div class="mailchimp-alerts text-centre">
                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                        <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                        <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                    </div><!-- mailchimp-alerts end -->

                </div><!--END subscribe-wrap-->

            </div><!--END col-12-->
            
        </div><!--END row align-items-center-->

    </div><!--END container-->

</div><!-- Subscribe Section End -->