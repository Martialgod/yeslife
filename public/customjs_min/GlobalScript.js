var isloggedin="no",referrer_token=null;function isEmpty(o){for(var t in o)if(o.hasOwnProperty(t))return!1;return!0}function apigetstates(o,t,i){showCustomizeLoading(),$.ajax({type:"GET",url:"/api/getstatebycountry/"+i,data:{},success:function(o){var i="";o.forEach(function(o,t){i=i+"<option value='"+o.name+"'>"+o.name+"</option>"}),$(t).html(i),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}function validateNumber(o,t){var i=$(o).val().trim();isNaN(i)||null==i||""==i?$(o).val(0):parseFloat(i)<parseFloat(t)&&$(o).val(0)}function toastr_item_added_to_cart(){toastr.success("Item added to your cart","",{iconClass:"toast-success"}).css("width","100%")}function GlobalBuyNow(o,t){var i={productid:o,qty:t};if(i=initializeCartCookie(i),"no"!=isloggedin){var n={fk_products:i.productid,qty:i.qty,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"POST",url:"/api/add-cart",data:n,success:function(o){location.href=null!=referrer_token?"/cartcheckout?refno="+referrer_token:"/cartcheckout"},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}else location.href=null!=referrer_token?"/cartcheckout?refno="+referrer_token:"/cartcheckout"}function countCartCookies(){for(var o=0,t=document.cookie.split(";"),i=0;i<t.length;i++){var n=t[i].split("=");-1!==n[0].indexOf("yeslifecart_")&&(o+=isNaN(n[1])?0:parseFloat(n[1]))}return o}function initializeCartCookie(o){for(var t=document.cookie.split(";"),i=0;i<t.length;i++){var n=t[i].split("=");-1!==n[0].indexOf("yeslifecart_"+o.productid)&&(o.qty=parseFloat(o.qty)+parseFloat(n[1]))}return void 0!==o.productid&&(document.cookie="yeslifecart_"+o.productid+"="+o.qty+"; path=/"),updateCartCookieCount(o),o}function addCartCookie(o){if(toastr.clear(),o=initializeCartCookie(o),"no"!=isloggedin){var t={fk_products:o.productid,qty:o.qty,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"POST",url:"/api/add-cart",data:t,success:function(o){$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()}})}}function updateCartCookieCount(o){$("#headercartcount").html(countCartCookies())}function getCartCookies(){for(var o=[],t=document.cookie.split(";"),i=0;i<t.length;i++){var n=t[i].split("=");-1!==n[0].indexOf("yeslifecart_")&&o.push({productid:n[0].trim().replace("yeslifecart_",""),qty:n[1]})}return o}function removeCartCookie(o){for(var t=document.cookie.split(";"),i=0;i<t.length;i++){var n=t[i].split("=");-1!==n[0].indexOf("yeslifecart_"+o)&&(document.cookie=n[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/")}if(toastr.clear(),"no"!=isloggedin){var e={fk_products:o,fk_users:isloggedin};showCustomizeLoading(),$.ajax({type:"DELETE",url:"/api/remove-cart",data:e,success:function(o){$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),$("#btnaddcart").prop("disabled",!1),hideCustomizeLoading()}})}$("#headercartcount").html(countCartCookies())}function deleteAllCartCookies(){for(var o=document.cookie.split(";"),t=0;t<o.length;t++){var i=o[t].split("=");-1!==i[0].indexOf("yeslifecart_")&&(document.cookie=i[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/")}$("#headercartcount").html("0")}function formatDate(o,t){switch(t){case"yyyy-MM-dd":var i=""+((a=new Date(o)).getMonth()+1),n=""+a.getDate(),e=a.getFullYear();return i.length<2&&(i="0"+i),n.length<2&&(n="0"+n),[e,i,n].join("-");case"MM/dd/YYYY h:m:s":i=""+((a=new Date(o)).getMonth()+1),n=""+a.getDate(),e=a.getFullYear();var a,r=""+a.getHours(),s=""+a.getMinutes(),c=""+a.getSeconds();return i.length<2&&(i="0"+i),n.length<2&&(n="0"+n),r.length<2&&(r="0"+r),s.length<2&&(s="0"+s),c.length<2&&(c="0"+c),[i,n,e].join("/")+" "+[r,s,c].join(":");default:return"date not supported..."}}function swalPostParamErrors(o){var t=[];void 0!==o.fk_users&&o.fk_users.forEach(function(o,i){t.push(o)}),void 0!==o.fname&&o.fname.forEach(function(o,i){t.push(o)}),void 0!==o.lname&&o.lname.forEach(function(o,i){t.push(o)}),void 0!==o.uname&&o.uname.forEach(function(o,i){t.push(o)}),void 0!==o.password&&o.password.forEach(function(o,i){t.push(o)}),void 0!==o.email&&o.email.forEach(function(o,i){t.push(o)}),void 0!==o.totalitem&&o.totalitem.forEach(function(o,i){t.push(o)}),void 0!==o.totalamount&&o.totalamount.forEach(function(o,i){t.push(o)}),void 0!==o.netamount&&o.netamount.forEach(function(o,i){t.push(o)}),void 0!==o.billingfname&&o.billingfname.forEach(function(o,i){t.push(o)}),void 0!==o.billinglname&&o.billinglname.forEach(function(o,i){t.push(o)}),void 0!==o.billingphone&&o.billinglname.forEach(function(o,i){t.push(o)}),void 0!==o.billingcountry&&o.billingcountry.forEach(function(o,i){t.push(o)}),void 0!==o.billingstate&&o.billingstate.forEach(function(o,i){t.push(o)}),void 0!==o.billingcity&&o.billingcity.forEach(function(o,i){t.push(o)}),void 0!==o.billingaddress1&&o.billingaddress1.forEach(function(o,i){t.push(o)}),void 0!==o.shippingfname&&o.shippingfname.forEach(function(o,i){t.push(o)}),void 0!==o.shippinglname&&o.shippinglname.forEach(function(o,i){t.push(o)}),void 0!==o.shippingphone&&o.shippinglname.forEach(function(o,i){t.push(o)}),void 0!==o.shippingcountry&&o.shippingcountry.forEach(function(o,i){t.push(o)}),void 0!==o.shippingstate&&o.shippingstate.forEach(function(o,i){t.push(o)}),void 0!==o.shippingcity&&o.shippingcity.forEach(function(o,i){t.push(o)}),void 0!==o.shippingaddress1&&o.shippingaddress1.forEach(function(o,i){t.push(o)}),void 0!==o.city&&o.city.forEach(function(o,i){t.push(o)}),void 0!==o.fk_country&&o.fk_country.forEach(function(o,i){t.push(o)}),void 0!==o.name&&o.name.forEach(function(o,i){t.push(o)}),void 0!==o.description&&o.description.forEach(function(o,i){t.push(o)}),void 0!==o.image&&o.image.forEach(function(o,i){t.push(o)}),void 0!==o.audio&&o.audio.forEach(function(o,i){t.push(o)}),void 0!==o.address_zip&&o.address_zip.forEach(function(o,i){t.push("Address zipcode "+o)}),void 0!==o.billing_address_zip&&o.billing_address_zip.forEach(function(o,i){t.push("Billing zipcode "+o)}),void 0!==o.first_name&&o.first_name.forEach(function(o,i){t.push("Firstname "+o)}),void 0!==o.last_name&&o.last_name.forEach(function(o,i){t.push("Lastname "+o)}),void 0!==o.phone_number&&o.phone_number.forEach(function(o,i){t.push("Phone No. "+o)}),void 0!==o.credit_card_number&&o.credit_card_number.forEach(function(o,t){}),void 0!==o.base&&o.base.forEach(function(o,i){t.push(o)});var i="";t.forEach(function(o,t){i+=o+"<br>"}),swal("Oops! Error(s) found",i,"error")}function showLoadingDiv(o,t){$(o).show(),$(t).hide()}function hideLoadingDiv(o,t){$(o).hide(),$(t).show()}function blockUICustom(o){$.blockUI({message:'<h3> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h3>',overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}})}function unblockUICustom(o){$.unblockUI()}function showCustomizeLoading(o){$.blockUI({message:'<h2> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h2>',overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}})}function showCustomizeLoadingNoIcon(o){var t=$.blockUI({message:"",overlayCSS:{opacity:.1},css:{border:"none",backgroundColor:"transparent"}});$(".blockOverlay",t).css("cursor","auto")}function hideCustomizeLoading(o){$.unblockUI()}$(document).ready(function(){isloggedin=$("#isloggedin").val(),referrer_token=$("#referrer_token").val()}),$(document).ready(function(){"no"==$("#isloggedin").val()&&updateCartCookieCount()}),$(document).ready(function(){$("#select2_fkusers").select2({width:"100%",ajax:{url:"/apisearchusers",delay:500,data:function(o){return{search:o.term}},processResults:function(o){o=o.data;var t=[];return-1===location.href.indexOf("/create")&&t.push({id:"-1",text:"*Display All*"}),o.forEach(function(o,i){t.push(o);var n=t.length-1;t[n].id=o.id,t[n].text=o.fullname+" ( "+o.email+" ) "}),{results:t}}}})}),$("#fk_country").on("change",function(){var o=$("#fk_country").val();$("#statesdropdowndiv").show(),$("#statescustomdiv").hide(),$("#cantfindstate").prop("checked",!1),$("#statescustom").val(null),showCustomizeLoading(),$.ajax({type:"GET",url:"/api/getstatebycountry/"+o,data:{},success:function(o){var t="";o.forEach(function(o,i){t=t+"<option value='"+o.name+"'>"+o.name+"</option>"}),$("#statesdropdown").html(t),hideCustomizeLoading()},error:function(o){console.log(o),console.log("error"),hideCustomizeLoading()}})}),$("#cantfindstate").on("change",function(){1==$(this).prop("checked")?($("#statesdropdowndiv").hide(),$("#statescustomdiv").show()):($("#statesdropdowndiv").show(),$("#statescustomdiv").hide())}),$("#pictx").on("change",function(){var o=$("#pictx");if(o[0].files.length>0&&o[0].files[0].size/1048576>10)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#pictx").val(null)}),$("#pictxa").on("change",function(){var o=$("#pictxa");if(o[0].files.length>0&&o[0].files[0].size/1048576>10)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#pictxa").val(null)}),$("#gallery").on("change",function(){var o=$("#gallery");if(o[0].files.length>0&&o[0].files[0].size/1048576>20)return swal("Oops!","maximum file size for the image is 5mb","error"),void $("#gallery").val(null)}),$(".swa-confirm").on("submit",function(o){o.preventDefault(),$(this).find(":input").not(":input[type=file]").each(function(){Array.isArray($(this).val())||$(this).val($.trim($(this).val()))}),$(this).valid()&&swal({title:"Are you sure you want to continue?",text:"",type:"warning",showCancelButton:!0,focusCancel:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes"}).then(function(t){t.value&&$(o.currentTarget).off("submit").submit()})}),$(".add-to-cart").submit(function(o){o.preventDefault();var t=[];$(this).serializeArray().forEach(function(o,i){t[o.name]=o.value}),addCartCookie(t),toastr_item_added_to_cart()});