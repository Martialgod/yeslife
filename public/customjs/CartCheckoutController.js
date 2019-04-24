angular.module("app",["AppServices"]).constant("API_URL","/cart").config(["$httpProvider",function(t){t.defaults.headers.common["X-Requested-With"]="XMLHttpRequest"}]).controller("CartCheckoutController",["$http","API_URL","GlobalFactory",function(t,o,e){var a=this;a.statusmsg="retrieving cart...",a.isoncart=!0,$("#nodisplay-div").prop("hidden",!0),$("#cart-div").prop("hidden",!0),$("#divcheckout").prop("hidden",!0),a.mscproducts=[],a.msccoupons=[],a.couponcode=null,a.paymentapi={},a.isloggedin=$("#isloggedin").val(),a.recurringtrxno=$("#recurringtrxno").val(),a.referrer_token=$("#referrer_token").val(),a.LoadCart=function(){var o=getCartCookies();t.post("/cart",{cart:o,isloggedin:a.isloggedin,recurringtrxno:a.recurringtrxno}).then(function(t){var o=t.data;a.statusmsg="","empty"!=o?($("#nodisplay-div").prop("hidden",!0),$("#cart-div").prop("hidden",!1),a.mscproducts=o.data,a.CalculateTotal()):($("#nodisplay-div").prop("hidden",!1),$("#cart-div").prop("hidden",!0)),hideCustomizeLoading()},function(t){console.log(t),swal("Opps!","Something went wrong!<br> please see log for details","error"),hideCustomizeLoading()})},a.UpdateCart=function(t,o){if(o.selectedqty=isNaN(o.selectedqty)||null==o.selectedqty||""==o.selectedqty?1:o.selectedqty,"plus"==t?o.selectedqty++:"minus"==t&&o.selectedqty--,o.selectedqty<=0&&(o.selectedqty=1),null==a.recurringtrxno||""==a.recurringtrxno){var e={productid:o.productid,qty:o.selectedqty};document.cookie="yeslifecart_"+e.productid+"=0; path=/",addCartCookie(e)}a.CalculateTotal()},a.ApplyCoupon=function(o){o.preventDefault(),null==a.couponcode||""==a.couponcode||a.couponcode.length<=3?swal("Opps!","Coupon Code not found!","warning"):a.totalnetamount<=0?swal("Opps!","You cannot add another coupon!","warning"):(showCustomizeLoading(),t.post("/api/searchcoupon",{couponcode:a.couponcode,userid:a.isloggedin}).then(function(t){var o=t.data;if(o.length>0){var e=!1;a.msccoupons.forEach(function(t,a){t.pk_coupons!=o[0].pk_coupons||(e=!0)}),e||a.msccoupons.push(o[0])}else swal("Opps!","Coupon Code not found!","warning");a.CalculateTotal(),hideCustomizeLoading()},function(t){console.log(t),swal("Opps!","Coupon Code not found!","error"),hideCustomizeLoading()}))},a.RemoveCoupons=function(t){a.msccoupons.forEach(function(o,e){o.pk_coupons==t.pk_coupons&&a.msccoupons.splice(e,1)}),a.CalculateTotal()},a.CalculateTotal=function(){a.totalamount=0,a.totalcoupondiscount=0,a.totaltax=0,a.totalshipcost=0,a.totalnetamount=0,a.mscproducts.forEach(function(t,o){t.totalamount=parseFloat(t.selectedqty)*parseFloat(t.cartdiscountedprice),t.coupondiscount=0,t.taxamount=0,t.shipamount=0,t.netamount=0,a.msccoupons.forEach(function(o,e){"Fixed"==o.type?t.coupondiscount+=parseFloat(o.amount)/parseFloat(a.mscproducts.length):t.coupondiscount+=parseFloat(t.totalamount)*(parseFloat(o.amount)/100)}),t.netamount=parseFloat(t.totalamount)-parseFloat(t.coupondiscount),a.totalcoupondiscount+=parseFloat(t.coupondiscount),a.totalamount+=parseFloat(t.totalamount),a.totalnetamount+=parseFloat(t.netamount),t.totalamount=parseFloat(t.totalamount).toFixed(2),t.netamount=parseFloat(t.netamount).toFixed(2)}),a.totalamount=parseFloat(a.totalamount).toFixed(2),a.totalnetamount=parseFloat(a.totalnetamount).toFixed(2)},a.RemoveFromCart=function(t){a.mscproducts.forEach(function(o,e){o.productid==t.productid&&(a.mscproducts.splice(e,1),null!=a.recurringtrxno&&""!=a.recurringtrxno||removeCartCookie(t.productid))}),0==a.mscproducts.length&&($("#nodisplay-div").prop("hidden",!1),$("#cart-div").prop("hidden",!0)),a.CalculateTotal()},a.IsCartItemsValid=function(){return a.mscproducts.length<=0?(swal("Opps!","Youre cart is empty!","error"),!1):!(a.totalnetamount<=0&&(swal("Opps!","Net amount cannot be zero!","error"),1))},a.ShowCart=function(){a.isoncart=!0,$("#cart-div").prop("hidden",!1),$("#divcheckout").prop("hidden",!0)},a.ShowCheckout=function(){a.IsCartItemsValid()&&(a.isoncart=!1,$("#cart-div").prop("hidden",!0),$("#divcheckout").prop("hidden",!1))},a.SubmitCart=function(){showCustomizeLoading(),t.post("/api/save-order",{referrer_token:a.referrer_token,recurringtrxno:a.recurringtrxno,cart:a.mscproducts,coupons:a.msccoupons,total:{totalamount:a.totalamount,totalnetamount:a.totalnetamount,totalcoupondiscount:a.totalcoupondiscount,totaltax:a.totaltax,totalshipcost:a.totalshipcost},paymentapi:a.paymentapi,address:$("#form-checkout").serializeArray()}).then(function(t){console.log(t);var o=t.data;"success"==o.status?(LeadDyno.recordPurchase($("#billingemail").val(),{purchase_code:o.trxno,purchase_amount:a.totalnetamount},function(){console.log("Purchase successfully sent to LeadDyno"),null!=a.recurringtrxno&&""!=a.recurringtrxno||deleteAllCartCookies(),null!=a.referrer_token&&""!=a.referrer_token?location.href="/order/success/"+o.trxno+"?refno="+a.referrer_token:location.href="/order/success/"+o.trxno}),LeadDyno.devTools.setLogger(function(t){console.log("LeadDyno Log: "+t)})):hideCustomizeLoading()},function(t){console.log(t);var o=t.data;e.swalPostParamErrors(o),hideCustomizeLoading()})},$(document).on("submit","#form-checkout",function(t){if(t.preventDefault(),$("#form-checkout").valid()&&a.IsCartItemsValid()){if($("#isrecurring").is(":checked")){var o=e.formatDate(new Date,"yyyy-MM-dd"),r=new Date(o).getTime(),n=new Date($("#enddate").val()).getTime();if("undefined"!==$("#enddate").val()&&""!=$("#enddate").val()&&n<=r)return void swal("Opps!","Recurring end date should be greater than today!","error")}if(1!=$("#isnewaccount").prop("checked")||0!=$("#billingpassword").val().length&&$("#billingpassword").val()==$("#billingrepeatpassword").val()){if(a.rallycnumber=$("#rally_cardNumber").val().trim(),null==a.rallycnumber||""==a.rallycnumber||0==a.rallycnumber.length)return $("#errrally_cardNumber").html("This is required!"),void $("#rally_cardNumber").focus();if($("#errrally_cardNumber").html(""),isNaN(a.rallycnumber)||Math.floor(a.rallycnumber)!=a.rallycnumber)return $("#errrally_cardNumber").html("Not a valid card number!"),void $("#rally_cardNumber").focus();if($("#errrally_cardNumber").html(""),a.rallyexpDate=$("#rally_expDate").val().trim(),null==a.rallyexpDate||""==a.rallyexpDate||0==a.rallyexpDate.length)return $("#errrally_expDate").html("This is required!"),void $("#rally_expDate").focus();if($("#errrally_expDate").html(""),null==a.rallyexpDate.match(/^\d{1,2}\/\d{4}$/))return $("#errrally_expDate").html("Format should be (MM/YYYY)"),void $("#rally_expDate").focus();if($("#errrally_expDate").html(""),a.rallycvc=$("#rally_cvc").val().trim(),null==a.rallycvc||""==a.rallycvc||0==a.rallycvc.length)return $("#errrally_cvc").html("This is required!"),void $("#rally_cvc").focus();if($("#errrally_cvc").html(""),1!=/^\d{3,4}$/.test(a.rallycvc))return $("#errrally_cvc").html("Invalid CVC!"),void $("#rally_cvc").focus();swal({title:"Are you sure you want to continue?",text:"",type:"warning",showCancelButton:!0,focusCancel:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes"}).then(function(t){t.value&&(console.log("cart payment logic..."),a.procesRallyPay())})}else swal("Opps!","Password does not match!","error")}}),a.procesRallyPay=function(){var t="";t=1==!$("#billingcantfindstate").prop("checked")?$("#billingstatesdropdown").val():$("#billingstatescustom").val(),a.paymentapi={cardno:$("#rally_cardNumber").val().trim(),exmonth:a.rallyexpDate.substring(0,2),exyear:a.rallyexpDate.substring(3,a.rallyexpDate.length),cvc:$("#rally_cvc").val().trim()};var o={credit_card_number:a.paymentapi.cardno,credit_card_security_code:a.paymentapi.cvc,credit_card_expiration_month:a.paymentapi.exmonth,credit_card_expiration_year:a.paymentapi.exyear,amount:a.totalnetamount,email:$("#billingemail").val(),phone_number:$("#billingphone").val(),first_name:$("#billingfname").val(),last_name:$("#billinglname").val(),address_address1:$("#billingaddress1").val(),address_city:$("#billingcity").val(),address_state:t,address_country:$("#billingcountry option:selected").text().trim(),address_zip:$("#billingzip").val(),occupation:"",employer:"",gender:""};showCustomizeLoading(),$.ajax({type:"POST",url:"https://rallypay.com/api/v1/donations/paywithcard",headers:{"RALLY-API-TOKEN":"pk_live_c15b10d1e39a990c2165080985f5b9b9"},data:{donation:o,custom_fields:{}},success:function(t){console.log(t),hideCustomizeLoading(),a.paymentapi=t,a.SubmitCart()},error:function(t){console.log(t),console.log("error"),e.swalPostParamErrors(t.responseJSON.message),hideCustomizeLoading()}})},showCustomizeLoadingNoIcon(),setTimeout(function(){a.LoadCart()},500)}]);