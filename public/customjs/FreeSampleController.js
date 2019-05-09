angular.module("app",["AppServices"]).constant("API_URL","/free-sample").config(["$httpProvider",function(t){t.defaults.headers.common["X-Requested-With"]="XMLHttpRequest"}]).controller("FreeSampleController",["$http","API_URL","GlobalFactory",function(t,e,a){var o=this;o.productid=$("#productid").val(),o.mscproducts=[],o.paymentapi={},o.referrer_token=$("#referrer_token").val(),o.yeslife_referrer_id=$("#yeslife_referrer_id").val(),o.LoadCart=function(){t.get("/free-sample/showproduct/"+o.productid).then(function(t){var e=t.data;o.statusmsg="",e.data.length>0?(o.mscproducts=e.data,o.CalculateTotal()):swal("Opps!","No sample is available at this moment!","error"),hideCustomizeLoading()},function(t){console.log(t),swal("Opps!","Something went wrong!<br> please see log for details","error"),hideCustomizeLoading()})},o.CalculateTotal=function(){o.totalamount=0,o.totalcoupondiscount=0,o.totaltax=0,o.totalshipcost=0,o.totalnetamount=0,o.mscproducts.forEach(function(t,e){t.selectedqty=1,t.totalamount=0,t.coupondiscount=0,t.taxamount=0,t.shipamount=0,t.shipamount+=parseFloat(t.shippingcost),t.netamount=0,o.totalamount+=parseFloat(t.shippingcost),o.totalshipcost+=parseFloat(t.shippingcost),o.totalnetamount+=parseFloat(t.shippingcost),t.totalamount=parseFloat(t.totalamount).toFixed(2),t.shipamount=parseFloat(t.shipamount).toFixed(2),t.netamount=parseFloat(t.netamount).toFixed(2)}),o.totalamount=parseFloat(o.totalamount).toFixed(2),o.totalshipcost=parseFloat(o.totalshipcost).toFixed(2),o.totalnetamount=parseFloat(o.totalnetamount).toFixed(2)},o.SubmitCart=function(){showCustomizeLoading(),t.post("/api/save-order",{referrer_token:o.referrer_token,yeslife_referrer_id:o.yeslife_referrer_id,recurringtrxno:null,cart:o.mscproducts,coupons:[],total:{totalamount:o.totalamount,totalnetamount:o.totalnetamount,totalcoupondiscount:o.totalcoupondiscount,totaltax:o.totaltax,totalshipcost:o.totalshipcost},paymentapi:o.paymentapi,address:$("#form-checkout").serializeArray()}).then(function(t){console.log(t);var e=t.data;"success"==e.status?(LeadDyno.recordPurchase($("#billingemail").val(),{purchase_code:e.trxno,purchase_amount:o.totalnetamount},function(){console.log("Purchase successfully sent to LeadDyno"),null!=o.referrer_token&&""!=o.referrer_token?location.href="/order/success/"+e.trxno+"?refno="+o.referrer_token:location.href="/order/success/"+e.trxno}),LeadDyno.devTools.setLogger(function(t){console.log("LeadDyno Log: "+t)})):hideCustomizeLoading()},function(t){console.log(t);var e=t.data;a.swalPostParamErrors(e),hideCustomizeLoading()})},$(document).on("submit","#form-checkout",function(t){if(t.preventDefault(),$("#form-checkout").valid()){if(o.totalnetamount<=0)return swal("Opps!","Net amount cannot be zero!","error"),!1;if(1!=$("#isnewaccount").prop("checked")||0!=$("#billingpassword").val().length&&$("#billingpassword").val()==$("#billingrepeatpassword").val()){if(o.rallycnumber=$("#rally_cardNumber").val().trim(),null==o.rallycnumber||""==o.rallycnumber||0==o.rallycnumber.length)return $("#errrally_cardNumber").html("This is required!"),void $("#rally_cardNumber").focus();if($("#errrally_cardNumber").html(""),isNaN(o.rallycnumber)||Math.floor(o.rallycnumber)!=o.rallycnumber)return $("#errrally_cardNumber").html("Not a valid card number!"),void $("#rally_cardNumber").focus();if($("#errrally_cardNumber").html(""),o.rallyexpDate=$("#rally_expDate").val().trim(),null==o.rallyexpDate||""==o.rallyexpDate||0==o.rallyexpDate.length)return $("#errrally_expDate").html("This is required!"),void $("#rally_expDate").focus();if($("#errrally_expDate").html(""),null==o.rallyexpDate.match(/^\d{1,2}\/\d{4}$/))return $("#errrally_expDate").html("Format should be (MM/YYYY)"),void $("#rally_expDate").focus();if($("#errrally_expDate").html(""),o.rallycvc=$("#rally_cvc").val().trim(),null==o.rallycvc||""==o.rallycvc||0==o.rallycvc.length)return $("#errrally_cvc").html("This is required!"),void $("#rally_cvc").focus();if($("#errrally_cvc").html(""),1!=/^\d{3,4}$/.test(o.rallycvc))return $("#errrally_cvc").html("Invalid CVC!"),void $("#rally_cvc").focus();swal({title:"Are you sure you want to continue?",text:"",type:"warning",showCancelButton:!0,focusCancel:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes"}).then(function(t){t.value&&o.isFirstTimer()})}else swal("Opps!","Password does not match!","error")}}),o.isFirstTimer=function(){showCustomizeLoading(),t.get("/free-sample/isfirsttimer/"+$("#billingemail").val()+"/"+o.productid).then(function(t){var e=t.data;hideCustomizeLoading(),"yes"==e?o.procesRallyPay():swal("Opps!","It seems you already avail our free sample","error")},function(t){console.log(t),swal("Opps!","Something went wrong!<br> please see log for details","error"),hideCustomizeLoading()})},o.procesRallyPay=function(){var t="";t=1==!$("#billingcantfindstate").prop("checked")?$("#billingstatesdropdown").val():$("#billingstatescustom").val(),o.paymentapi={cardno:$("#rally_cardNumber").val().trim(),exmonth:o.rallyexpDate.substring(0,2),exyear:o.rallyexpDate.substring(3,o.rallyexpDate.length),cvc:$("#rally_cvc").val().trim()};var e={credit_card_number:o.paymentapi.cardno,credit_card_security_code:o.paymentapi.cvc,credit_card_expiration_month:o.paymentapi.exmonth,credit_card_expiration_year:o.paymentapi.exyear,amount:o.totalnetamount,email:$("#billingemail").val(),phone_number:$("#billingphone").val(),first_name:$("#billingfname").val(),last_name:$("#billinglname").val(),address_address1:$("#billingaddress1").val(),address_city:$("#billingcity").val(),address_state:t,address_country:$("#billingcountry option:selected").text().trim(),address_zip:$("#billingzip").val(),occupation:"",employer:"",gender:""};showCustomizeLoading(),$.ajax({type:"POST",url:"https://rallypay.com/api/v1/donations/paywithcard",headers:{"RALLY-API-TOKEN":"pk_live_c15b10d1e39a990c2165080985f5b9b9"},data:{donation:e,custom_fields:{}},success:function(t){console.log(t),hideCustomizeLoading(),o.paymentapi=t,o.SubmitCart()},error:function(t){console.log(t),console.log("error"),a.swalPostParamErrors(t.responseJSON.message),hideCustomizeLoading()}})},showCustomizeLoadingNoIcon(),setTimeout(function(){o.LoadCart()},500)}]);