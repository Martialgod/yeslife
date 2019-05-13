var isloggedin="no",referrer_token=null;function isEmpty(o){for(var i in o)if(o.hasOwnProperty(i))return!1;return!0}function apigetstates(o,i,n){showCustomizeLoading(),$.ajax({type:"GET",url:"/api/getstatebycountry/"+n,data:{},success:function(o){var n="";o.forEach(function(o,i){n=n+"<option value='"+o.name+"'>"+o.name+"</option>"}),$(i).html(n),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}function validateNumber(o,i){var n=$(o).val().trim();isNaN(n)||null==n||""==n?$(o).val(0):parseFloat(n)<parseFloat(i)&&$(o).val(0)}function GlobalBuyNow(o,i){var n={productid:o,qty:i};if(n=initializeCartCookie(n),"no"!=isloggedin){var t={fk_products:n.productid,qty:n.qty,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"POST",url:"/api/add-cart",data:t,success:function(o){location.href=null!=referrer_token?"/cartcheckout?refno="+referrer_token:"/cartcheckout"},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}else location.href=null!=referrer_token?"/cartcheckout?refno="+referrer_token:"/cartcheckout"}function countCartCookies(){for(var o=0,i=document.cookie.split(";"),n=0;n<i.length;n++){var t=i[n].split("=");-1!==t[0].indexOf("yeslifecart_")&&(o+=isNaN(t[1])?0:parseFloat(t[1]))}return o}function initializeCartCookie(o){for(var i=document.cookie.split(";"),n=0;n<i.length;n++){var t=i[n].split("=");-1!==t[0].indexOf("yeslifecart_"+o.productid)&&(o.qty=parseFloat(o.qty)+parseFloat(t[1]))}return void 0!==o.productid&&(document.cookie="yeslifecart_"+o.productid+"="+o.qty+"; path=/"),updateCartCookieCount(o),o}function addCartCookie(o){if(toastr.clear(),o=initializeCartCookie(o),"no"!=isloggedin){var i={fk_products:o.productid,qty:o.qty,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"POST",url:"/api/add-cart",data:i,success:function(o){$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()}})}}function updateCartCookieCount(o){$("#headercartcount").html(countCartCookies())}function getCartCookies(){for(var o=[],i=document.cookie.split(";"),n=0;n<i.length;n++){var t=i[n].split("=");-1!==t[0].indexOf("yeslifecart_")&&o.push({productid:t[0].trim().replace("yeslifecart_",""),qty:t[1]})}return o}function removeCartCookie(o){for(var i=document.cookie.split(";"),n=0;n<i.length;n++){var t=i[n].split("=");-1!==t[0].indexOf("yeslifecart_"+o)&&(document.cookie=t[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/")}if(toastr.clear(),"no"!=isloggedin){var e={fk_products:o,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"DELETE",url:"/api/remove-cart",data:e,success:function(o){$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()}})}$("#headercartcount").html(countCartCookies())}function deleteAllCartCookies(){for(var o=document.cookie.split(";"),i=0;i<o.length;i++){var n=o[i].split("=");-1!==n[0].indexOf("yeslifecart_")&&(console.log(n[0]),document.cookie=n[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/")}$("#headercartcount").html("0")}function formatDate(o,i){switch(i){case"yyyy-MM-dd":var n=""+((a=new Date(o)).getMonth()+1),t=""+a.getDate(),e=a.getFullYear();return n.length<2&&(n="0"+n),t.length<2&&(t="0"+t),[e,n,t].join("-");case"MM/dd/YYYY h:m:s":n=""+((a=new Date(o)).getMonth()+1),t=""+a.getDate(),e=a.getFullYear();var a,r=""+a.getHours(),s=""+a.getMinutes(),c=""+a.getSeconds();return n.length<2&&(n="0"+n),t.length<2&&(t="0"+t),r.length<2&&(r="0"+r),s.length<2&&(s="0"+s),c.length<2&&(c="0"+c),[n,t,e].join("/")+" "+[r,s,c].join(":");default:return"date not supported..."}}function swalPostParamErrors(o){var i=[];void 0!==o.fk_users&&o.fk_users.forEach(function(o,n){i.push(o)}),void 0!==o.fname&&o.fname.forEach(function(o,n){i.push(o)}),void 0!==o.lname&&o.lname.forEach(function(o,n){i.push(o)}),void 0!==o.uname&&o.uname.forEach(function(o,n){i.push(o)}),void 0!==o.password&&o.password.forEach(function(o,n){i.push(o)}),void 0!==o.email&&o.email.forEach(function(o,n){i.push(o)}),void 0!==o.totalitem&&o.totalitem.forEach(function(o,n){i.push(o)}),void 0!==o.totalamount&&o.totalamount.forEach(function(o,n){i.push(o)}),void 0!==o.netamount&&o.netamount.forEach(function(o,n){i.push(o)}),void 0!==o.billingfname&&o.billingfname.forEach(function(o,n){i.push(o)}),void 0!==o.billinglname&&o.billinglname.forEach(function(o,n){i.push(o)}),void 0!==o.billingphone&&o.billinglname.forEach(function(o,n){i.push(o)}),void 0!==o.billingcountry&&o.billingcountry.forEach(function(o,n){i.push(o)}),void 0!==o.billingstate&&o.billingstate.forEach(function(o,n){i.push(o)}),void 0!==o.billingcity&&o.billingcity.forEach(function(o,n){i.push(o)}),void 0!==o.billingaddress1&&o.billingaddress1.forEach(function(o,n){i.push(o)}),void 0!==o.shippingfname&&o.shippingfname.forEach(function(o,n){i.push(o)}),void 0!==o.shippinglname&&o.shippinglname.forEach(function(o,n){i.push(o)}),void 0!==o.shippingphone&&o.shippinglname.forEach(function(o,n){i.push(o)}),void 0!==o.shippingcountry&&o.shippingcountry.forEach(function(o,n){i.push(o)}),void 0!==o.shippingstate&&o.shippingstate.forEach(function(o,n){i.push(o)}),void 0!==o.shippingcity&&o.shippingcity.forEach(function(o,n){i.push(o)}),void 0!==o.shippingaddress1&&o.shippingaddress1.forEach(function(o,n){i.push(o)}),void 0!==o.city&&o.city.forEach(function(o,n){i.push(o)}),void 0!==o.fk_country&&o.fk_country.forEach(function(o,n){i.push(o)}),void 0!==o.name&&o.name.forEach(function(o,n){i.push(o)}),void 0!==o.description&&o.description.forEach(function(o,n){i.push(o)}),void 0!==o.image&&o.image.forEach(function(o,n){i.push(o)}),void 0!==o.audio&&o.audio.forEach(function(o,n){i.push(o)}),void 0!==o.address_zip&&o.address_zip.forEach(function(o,n){i.push("Address zipcode is "+o)}),void 0!==o.billing_address_zip&&o.billing_address_zip.forEach(function(o,n){i.push("Billing zipcode is "+o)}),void 0!==o.first_name&&o.first_name.forEach(function(o,n){i.push("Firstname is "+o)}),void 0!==o.last_name&&o.last_name.forEach(function(o,n){i.push("Lastname is "+o)}),void 0!==o.phone_number&&o.phone_number.forEach(function(o,n){i.push("Phone No. is "+o)}),void 0!==o.credit_card_number&&o.credit_card_number.forEach(function(o,n){i.push("Card Number is "+o)}),void 0!==o.base&&o.base.forEach(function(o,n){i.push(o)});var n="";i.forEach(function(o,i){n+=o+"<br>"}),swal("Oops! Error(s) found",n,"error")}function showLoadingDiv(o,i){$(o).show(),$(i).hide()}function hideLoadingDiv(o,i){$(o).hide(),$(i).show()}function blockUICustom(o){$.blockUI({message:'<h3> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h3>',overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}})}function unblockUICustom(o){$.unblockUI()}function showCustomizeLoading(o){$.blockUI({message:'<h2> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h2>',overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}})}function showCustomizeLoadingNoIcon(o){var i=$.blockUI({message:"",overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}});$(".blockOverlay",i).css("cursor","auto")}function hideCustomizeLoading(o){$.unblockUI()}$(document).ready(function(){isloggedin=$("#isloggedin").val(),referrer_token=$("#referrer_token").val()}),$(document).ready(function(){"no"==$("#isloggedin").val()&&updateCartCookieCount()}),$(document).ready(function(){$("#select2_fkusers").select2({width:"100%",ajax:{url:"/apisearchusers",delay:500,data:function(o){return{search:o.term}},processResults:function(o){o=o.data;var i=[];return-1===location.href.indexOf("/create")&&i.push({id:"-1",text:"*Display All*"}),o.forEach(function(o,n){i.push(o);var t=i.length-1;i[t].id=o.id,i[t].text=o.fullname+" ( "+o.email+" ) "}),{results:i}}}})}),$("#fk_country").on("change",function(){var o=$("#fk_country").val();$("#statesdropdowndiv").show(),$("#statescustomdiv").hide(),$("#cantfindstate").prop("checked",!1),$("#statescustom").val(null),showCustomizeLoading(),$.ajax({type:"GET",url:"/api/getstatebycountry/"+o,data:{},success:function(o){var i="";o.forEach(function(o,n){i=i+"<option value='"+o.name+"'>"+o.name+"</option>"}),$("#statesdropdown").html(i),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}),$("#cantfindstate").on("change",function(){1==$(this).prop("checked")?($("#statesdropdowndiv").hide(),$("#statescustomdiv").show()):($("#statesdropdowndiv").show(),$("#statescustomdiv").hide())}),$("#pictx").on("change",function(){var o=$("#pictx");if(o[0].files.length>0&&o[0].files[0].size/1048576>10)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#pictx").val(null)}),$("#pictxa").on("change",function(){var o=$("#pictxa");if(o[0].files.length>0&&o[0].files[0].size/1048576>10)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#pictxa").val(null)}),$("#gallery").on("change",function(){var o=$("#gallery");if(o[0].files.length>0&&o[0].files[0].size/1048576>20)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#gallery").val(null)}),$(".swa-confirm").on("submit",function(o){o.preventDefault(),$(this).find(":input").not(":input[type=file]").each(function(){Array.isArray($(this).val())||$(this).val($.trim($(this).val()))}),$(this).valid()&&swal({title:"Are you sure you want to continue?",text:"",type:"warning",showCancelButton:!0,focusCancel:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes"}).then(function(i){i.value&&$(o.currentTarget).off("submit").submit()})}),$(".add-to-cart").submit(function(o){o.preventDefault();var i=[];$(this).serializeArray().forEach(function(o,n){i[o.name]=o.value}),addCartCookie(i)});