var isloggedin = 'no'; //global

$(document).ready(function(){

  //added in the master layout. determine if customer currently logged in
  isloggedin = $('#isloggedin').val();


});


$(document).ready(function(){

  
  $('#select2_fkusers').select2({
      width:'100%',
      //placeholder: 'Search ' +  type +  ' here...',
      ajax: {
          url: '/apisearchusers', //no module required
          delay: 500, //mili
          data: function(params){ //url params

              var query = {
                  search: params.term, //search key,
                  //stat: 1, //dislay only active persona,
              };

              // Query paramters will be ?search=[term]&is_ajax=[is_ajax]
              return query;

          },//end data

          //process result here
          processResults: function (result) {
              
              //result will return paginate object with current page & data
              //console.log(result);

              var result = result.data;
              
              var results = [];
            
              //console.log(location.href);

              //display all not applicable for the following url
              if( (location.href).indexOf('/create') === -1 ){
                results.push({
                    'id': '-1', 
                    'text': '*Display All*'//'please select a 'type
                });
              }

             

              result.forEach(function(item1, index1){

                  results.push(item1);
                  var len = results.length-1;

                  //id = constant and required in select2 for value of the selected dropdown
                  results[len].id = item1.id;
                  //text = constant and required in select2 to display in dropdown
                  results[len].text = item1.fullname + ' ( '+item1.email+' ) ';
              });


              //console.log(results);

             return {
                  //results = constant and required in select2 to display in dropdown
                  results: results
             };
          }//end processResults

      }//END ajax

  });//END select2_fkusers



});



//for user and profile admin page
$('#fk_country').on('change', function(){

  var fk_country = $('#fk_country').val();
  $('#statesdropdowndiv').show();
  $('#statescustomdiv').hide();
  $('#cantfindstate').prop('checked', false);

  $('#statescustom').val(null);

   //$.blockUI('#main-div');
   showCustomizeLoading();

    $.ajax({
       type: "GET",
       url: '/api/getstatebycountry/'+fk_country, //store on post
       data: {}, // 
       success: function(data){
            
          //console.log(data);

          var options = '';

          data.forEach(function(item1, index1){
            options = options + "<option value='"+ item1.name+"'>"  + item1.name +  "</option>";
          });

          $('#statesdropdown').html(options); //update html options

          /*if( data.length>0 ){
            //set initial select option
            $('#statesdropdown').val( data[0].name );
          }*/

          //$.unblockUI('#main-div');
          hideCustomizeLoading();

       },
       error: function(data){
          console.log(data);
          console.log('error');

          //$.unblockUI('#main-div');
          hideCustomizeLoading();

       }

    });//END $.ajax

});//END #fk_country on change


//called by users and profile admin page, cart checkout page
function apigetstates(blockdiv, dropdownid, fk_country){

  //$.blockUI(blockdiv);
  showCustomizeLoading();

  $.ajax({
      type: "GET",
      url: '/api/getstatebycountry/'+fk_country, //store on post
      data: {}, // 
      success: function(data){
          
        //console.log(data);

        var options = '';

        data.forEach(function(item1, index1){
          options = options + "<option value='"+ item1.name+"'>"  + item1.name +  "</option>";
        });

        $(dropdownid).html(options); //update html options


        //$.unblockUI(blockdiv);
        hideCustomizeLoading();

      },
      error: function(data){
        console.log(data);
        console.log('error');

        //$.unblockUI(blockdiv);
        hideCustomizeLoading();

      }

  });//END $.ajax

};//END apigetstates



//for user and profile admin page
$('#cantfindstate').on('change', function(){

  if( $(this).prop("checked") == true ){
    $('#statesdropdowndiv').hide();
    $('#statescustomdiv').show();
  }else{
    $('#statesdropdowndiv').show();
    $('#statescustomdiv').hide();
  }      

});//END #cantfindstate on change



$('#pictx').on('change', function(){

  var temppictx = $('#pictx');
  //1mb = 1,048,576 bytes
  
  //check if file size greater than 10mb
  if( temppictx[0].files.length>0 && ( (temppictx[0].files[0].size / 1048576) > 10 ) ){
      swal('Oops!', 'maximum file size for the image is 5mb', 'error');
      $('#pictx').val(null);
      return;
  }       

});//END #pictx on change


$('#pictxa').on('change', function(){

  var temppictx = $('#pictxa');
  //1mb = 1,048,576 bytes
  
  //check if file size greater than 10mb
  if( temppictx[0].files.length>0 && ( (temppictx[0].files[0].size / 1048576) > 10 ) ){
      swal('Oops!', 'maximum file size for the image is 5mb', 'error');
      $('#pictxa').val(null);
      return;
  }       

});//END #pictx on change


$('#gallery').on('change', function(){

  var temppictx = $('#gallery');
  //1mb = 1,048,576 bytes
  
  //check if file size greater than 20mb
  if( temppictx[0].files.length>0 && ( (temppictx[0].files[0].size / 1048576) > 20 ) ){
      swal('Oops!', 'maximum file size for the image is 5mb', 'error');
      $('#gallery').val(null);
      return;
  }       

});//END #gallery on change



function validateNumber(id, min){

  var val = $(id).val().trim();

  if( isNaN(val) || val == undefined || val == ''){
    $(id).val(0);
    return;
  }

  if( parseFloat(val) < parseFloat(min)  ){
    $(id).val(0);
    return;
  }


}//END validateNumber


//add class swa-confirm to the form
$(".swa-confirm").on("submit", function(e) {
    
  e.preventDefault();

  //remove trailing and leading spaces
  ($(this).find(':input').not(':input[type=file]')).each(function(){
    //bypass array for multiple select
    if(!Array.isArray($(this).val())){
      $(this).val( $.trim($(this).val() ));
    }
    //console.log($(this).val());
  });

  if( !$(this).valid() ){
    //swal('Opps!', 'Please check for required fields', 'error');
    return;
  }



  swal({
    title: 'Are you sure you want to continue?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    focusCancel: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  })
  .then(function(result){
    if (result.value) {
      //console.log('ss');
      //remove event handler submit, prevent recursion call of the submit
      //$(".swa-confirm").off("submit").submit();
      $(e.currentTarget).off("submit").submit(); 
    }
  });
  /*.then((result) => {
    if (result.value) {
      //remove event handler submit, prevent recursion call of the submit
      //$(".swa-confirm").off("submit").submit();
      $(e.currentTarget).off("submit").submit(); 
    }
  });//END swal */

});


//class name
$('.add-to-cart').submit(function(e){

  e.preventDefault();
  //console.log(e);
  var products = [];
  var temp = $(this).serializeArray();
  temp.forEach(function(item1,index1){
    products[ item1.name ] = item1.value;
  });
  //console.log(products);
  //return;

  addCartCookie(products);



});//END add-to-cart


function GlobalBuyNow(productid, qty){

  console.log(productid);
  console.log(qty);

  var products = {

    'productid': productid,
    'qty': qty,

  };

  products = initializeCartCookie(products);

  //initialize @the top of the page
  if( isloggedin != 'no'){

    //save to db to track abandoned cart
    var cart = {
      'fk_products': products.productid,
      'qty': products.qty,
      'fk_users': isloggedin,
    };

    //$.blockUI('#main-div');
    showCustomizeLoading();

    $.ajax({
       type: "POST",
       url: '/api/add-cart', //store on post; calling api.php; removes authentication
       data: cart, // 
       success: function(data){
            
          console.log(data);

          if( data == 'success' ){


          }else{

          
          }

        
          //hideCustomizeLoading();
          
          //redirect to checkout
          location.href="/cartcheckout";


       },
       error: function(data){
          console.log(data);
          console.log('error');

          hideCustomizeLoading();

       }

    });//END $.ajax
    

  }else{

    //redirect to checkout
    location.href="/cartcheckout";

  }//END if isloggedin



}//END GlobalBuyNow


function countCartCookies() {
  var count = 0;
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //count cookies with cart
    if( key[0].indexOf('yeslifecart_') !== -1 ){
      count++;
      //count+= ( !isNaN(key[1]) ) ? parseFloat(key[1]) : 0;
    }

  }//END for
  //console.log(count);
  return count;


}//END countCartCookies


function initializeCartCookie(products){

  //adding yeslifecart_ to determine this is a cart cookie
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //console.log(key[0]); //cookie name
    //check if cookie is existing
    if( key[0].indexOf('yeslifecart_'+products.productid) !== -1 ){
      products.qty = parseFloat(products.qty) +  parseFloat(key[1]);  //set qty
    }
    
  }//END for

  if( products.productid !== undefined ){
    document.cookie = "yeslifecart_"+products.productid+"="+products.qty+"; path=/";
  }
  
  //console.log( document.cookie );
  

  return products;

}//END 


function addCartCookie(products){

    //console.log(products);
    toastr.clear();

    updateCartCookieCount(products);
    
    products = initializeCartCookie(products);

    //initialize @the top of the page
    if( isloggedin != 'no'){

      //save to db to track abandoned cart
      var cart = {
        'fk_products': products.productid,
        'qty': products.qty,
        'fk_users': isloggedin,
      };

      //$.blockUI('#main-div');
      showCustomizeLoading();

      $.ajax({
         type: "POST",
         url: '/api/add-cart', //store on post; calling api.php; removes authentication
         data: cart, // 
         success: function(data){
              
            //console.log(data);

            if( data == 'success' ){


            }else{

            
            }

            $('#btnaddcart').prop('disabled', false);
            //$.unblockUI('#main-div');
            hideCustomizeLoading();

         },
         error: function(data){
            console.log(data);
            console.log('error');

            $('#btnaddcart').prop('disabled', false);
            //$.unblockUI('#main-div');
            hideCustomizeLoading();

         }

      });//END $.ajax
      

    }//END if isloggedin


}//END addCartCookie




function updateCartCookieCount(products){

  //$('#headercartcount').html(countCartCookies());

  var isfound = false;
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //console.log(key[0]);
    //check if cookie was added
    if( key[0].indexOf('yeslifecart_'+products.productid) !== -1 ){
      isfound=true;
      break;
    }
    
  }//END for

  //console.log(isfound);

  if(!isfound){
    toastr.success('item added to the cart');
    $('#headercartcount').html( parseFloat($('#headercartcount').html().trim()) + 1 );
  }else{
    toastr.success('cart updated');
  } 

}//END updateCartCookieCount


function getCartCookies() {
  var result = [];
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //remove selected product from the cart cookies
    if( key[0].indexOf('yeslifecart_') !== -1 ){
      result.push({
        'productid': key[0].trim().replace('yeslifecart_', ''), //remove yeslifecart_
        'qty': key[1]
      });
    }
    
  }//END for

  //console.log(result);

  return result;
}//END getCartCookies



function removeCartCookie(productid) {
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //remove selected product from the cart cookies
    if( key[0].indexOf('yeslifecart_'+productid) !== -1 ){
      document.cookie = key[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/"; //set expiry
    }
    
  }//END for

  toastr.clear();

  //initialize @the top of the page
  if( isloggedin != 'no'){

    //save to db to track abandoned cart
    var cart = {
      'fk_products': productid,
      'fk_users': isloggedin,
    };

    //$.blockUI('#main-div');
    showCustomizeLoading();

    $.ajax({
       type: "DELETE",
       url: '/api/remove-cart', //store on post; calling api.php; removes authentication
       data: cart, // 
       success: function(data){
            
          //console.log(data);

          if( data == 'success' ){


          }else{

          
          }

          $('#btnaddcart').prop('disabled', false);
          //$.unblockUI('#main-div');
          hideCustomizeLoading();

       },
       error: function(data){
          console.log(data);
          console.log('error');

          $('#btnaddcart').prop('disabled', false);
          //$.unblockUI('#main-div');
          hideCustomizeLoading();
       }

    });//END $.ajax
    

  }//END if isloggedin


  toastr.error('item removed from cart');

  if( getCartCookies().length > 0){
    $('#headercartcount').html( parseFloat($('#headercartcount').html().trim()) - 1 );
  }else{
    $('#headercartcount').html('0');
  }

 

  //console.log( getCartCookies() );
}//END removeCartCookie


function deleteAllCartCookies() {
  var res = document.cookie;
  var multiple = res.split(";");
  for(var i = 0; i < multiple.length; i++) {
    var key = multiple[i].split("=");
    //remove cookies with cart
    if( key[0].indexOf('yeslifecart_') !== -1 ){
      console.log(key[0]);
      document.cookie = key[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC; path=/"; //set expiry
    }
    
  }//END for

  //console.log(getCartCookies());
  $('#headercartcount').html('0');

}//END deleteAllCartCookies



/*
    returns the formated date;
    - date = reference to the date object to be formated
    - format = format representation of the date;
*/
function formatDate(date, format){
    //console.log('default date: ' + date);
   
    var tempArrMonth = ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];   

    //BEGIN switch
    switch( format ){
        
        
        case 'yyyy-MM-dd': //2016-01-13

            var d       = new Date(date); //new date object;
            var month   = '' + (d.getMonth() + 1); //Returns the month (from 0-11); zero based index;
            var day     = '' + d.getDate(); // Returns the day of the month (from 1-31)
            var year    = d.getFullYear(); //Returns the year (four digits)

            //insert '0' to month/day if less they only have 1 characted; 
            if (month.length < 2) month = '0' + month; 
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-'); //join array as string with '-' delimiter

        break;

        case 'MM/dd/YYYY h:m:s': //01-03-2018 01:02:01

            var d       = new Date(date); //new date object;
            var month   = '' + (d.getMonth() + 1); //Returns the month (from 0-11); zero based index;
            var day     = '' + d.getDate(); // Returns the day of the month (from 1-31)
            var year    = d.getFullYear(); //Returns the year (four digits)
            var hrs     = ''+d.getHours();
            var mins    = ''+d.getMinutes();
            var secs     = ''+d.getSeconds();

            //insert '0' to month/day if less they only have 1 characted; 
            if (month.length < 2) month = '0' + month; 
            if (day.length < 2) day = '0' + day;
            if (hrs.length < 2 ) hrs = '0' + hrs;
            if (mins.length < 2 ) mins = '0' + mins;
            if (secs.length < 2 ) secs = '0' + secs;

            return [month, day, year].join('/') + ' ' + [hrs, mins, secs].join(':'); //join array as string with '-' delimiter

        break; 


        default:
            return 'date not supported...';

    }
    //END switch

};//END formatDate



/*
    returns errors as string from laravel validator errors
    - date = reference to the date object to be formated
    - format = format representation of the date;
*/
function swalPostParamErrors(err){

  var errors = [];

  //users
  
  if( err.fk_users !== undefined ){
    err.fk_users.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.fname !== undefined ){
    err.fname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.lname !== undefined ){
    err.lname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.uname !== undefined ){
    err.uname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.password !== undefined ){
    err.password.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.email !== undefined ){
    err.email.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  //orders
  if( err.totalitem !== undefined ){
    err.totalitem.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.totalamount !== undefined ){
    err.totalamount.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.netamount !== undefined ){
    err.netamount.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingfname !== undefined ){
    err.billingfname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billinglname !== undefined ){
    err.billinglname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingphone !== undefined ){
    err.billinglname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingcountry !== undefined ){
    err.billingcountry.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingstate !== undefined ){
    err.billingstate.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingcity !== undefined ){
    err.billingcity.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.billingaddress1 !== undefined ){
    err.billingaddress1.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingfname !== undefined ){
    err.shippingfname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippinglname !== undefined ){
    err.shippinglname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingphone !== undefined ){
    err.shippinglname.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingcountry !== undefined ){
    err.shippingcountry.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingstate !== undefined ){
    err.shippingstate.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingcity !== undefined ){
    err.shippingcity.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.shippingaddress1 !== undefined ){
    err.shippingaddress1.forEach(function(item1, index1){
      errors.push(item1);
    });
  }


  //global address
  if( err.city !== undefined ){
    err.city.forEach(function(item1, index1){
      errors.push(item1);
    }); 
  }

  if( err.fk_country !== undefined ){
    err.fk_country.forEach(function(item1, index1){
      errors.push(item1);
    });
  }
    

  //others
  if( err.name !== undefined ){
    err.name.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.description !== undefined ){
    err.description.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.image !== undefined ){
    err.image.forEach(function(item1, index1){
      errors.push(item1);
    });
  }

  if( err.audio !== undefined ){
    err.audio.forEach(function(item1, index1){
      errors.push(item1);
    });
  }


  //rallypay errors
  if( err.address_zip !== undefined ){
    err.address_zip.forEach(function(item1, index1){
        errors.push('Address zipcode is '+item1);
    });
  }

  if( err.billing_address_zip !== undefined ){
    err.billing_address_zip.forEach(function(item1, index1){
        errors.push('Billing zipcode is '+item1);
    });
  }

  //email already defined at the top

  if( err.first_name !== undefined ){
    err.first_name.forEach(function(item1, index1){
        errors.push('Firstname is '+item1);
    });
  }

  if( err.last_name !== undefined ){
    err.last_name.forEach(function(item1, index1){
        errors.push('Lastname is '+item1);
    });
  }

  if( err.phone_number !== undefined ){
    err.phone_number.forEach(function(item1, index1){
        errors.push('Phone No. is '+item1);
    });
  }

  if( err.credit_card_number !== undefined ){
    err.credit_card_number.forEach(function(item1, index1){
        errors.push('Card Number is '+item1);
    });
  }

  if( err.base !== undefined ){
    err.base.forEach(function(item1, index1){
        errors.push(item1);
    });
  }

  var strerr = '';
  errors.forEach(function(item1, index1){
    strerr += item1+'<br>';
  });//END errors

  swal('Oops! Error(s) found', strerr, 'error');

  //console.log(errors);

};//END swalPostParamErrors




function showLoadingDiv(loadingdiv, contentdiv){
    $(loadingdiv).show();
    $(contentdiv).hide();
};

function hideLoadingDiv(loadingdiv, contentdiv){
    $(loadingdiv).hide();
    $(contentdiv).show();
};


function blockUICustom(id){

  //$.blockUI(id); 
  $.blockUI({ 
    message: '<h3> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h3>',
    overlayCSS: { opacity: .1 },
    css: {
      border:     'none',
      backgroundColor:'transparent',
    }
  });

};//END blockUICustom

function unblockUICustom(id){

  //$.unblockUI(id); 
  $.unblockUI();

};//END blockUICustom



//used in Shop page / ShopController.js
function showCustomizeLoading(id){
  $.blockUI({ 
    message: '<h2> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h2>',
    overlayCSS: { opacity: .1 },
    css: {
      border:     'none',
      backgroundColor:'transparent',
    }
  });
};//END showCustomizeLoading


//used in Shop page / ShopController.js
function showCustomizeLoadingNoIcon(id){
  var b = $.blockUI({ 
    message: '',
    overlayCSS: { opacity: .1 },
    css: {
      border:     'none',
      backgroundColor:'transparent',
    }
  });
  $('.blockOverlay', b).css('cursor', 'auto');
};//END showCustomizeLoadingNoIcon

//used in Shop page / ShopController.js
function hideCustomizeLoading(id){
  $.unblockUI();
};//END hideCustomizeLoading