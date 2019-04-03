$(document).on('change','#billingcountry',function(){


    var fk_country = $('#billingcountry').val();
    //$('#billingstatesdropdowndiv').show();
    $('#billingstatesdropdowndiv').prop('hidden', false);
    //$('#billingstatescustomdiv').hide();
    $('#billingstatescustomdiv').prop('hidden', true);
    $('#billingcantfindstate').prop('checked', false);

    $('#billingstatescustom').val(null);

    //GlobalScript.js
    apigetstates('#checkout-div', '#billingstatesdropdown', fk_country);

});//END #billingcountry on change

$(document).on('change','#billingcantfindstate',function(){
  
   if( $(this).prop("checked") == true ){
    //$('#billingstatesdropdowndiv').hide();
    $('#billingstatesdropdowndiv').prop('hidden', true);
    //$('#billingstatescustomdiv').show();
    $('#billingstatescustomdiv').prop('hidden', false);
  }else{
    //$('#billingstatesdropdowndiv').show();
    $('#billingstatesdropdowndiv').prop('hidden', false);
    //$('#billingstatescustomdiv').hide();
    $('#billingstatescustomdiv').prop('hidden', true);
  }   


});//END #billingcantfindstate on change



$(document).on('change','#shippingcountry',function(){

    var fk_country = $('#shippingcountry').val();
    //$('#shippingstatesdropdowndiv').show();
    //$('#shippingstatescustomdiv').hide();
    $('#shippingstatesdropdowndiv').prop('hidden', false);
    $('#shippingstatescustomdiv').prop('hidden', true);
    $('#shippingcantfindstate').prop('checked', false);

    $('#shippingstatescustom').val(null);

    //GlobalScript.js
    apigetstates('#checkout-div', '#shippingstatesdropdown', fk_country);


});//END #shippingcountry on change

$(document).on('change','#shippingcantfindstate',function(){
  
    if( $(this).prop("checked") == true ){
        //$('#shippingstatesdropdowndiv').hide();
        //$('#shippingstatescustomdiv').show();
        $('#shippingstatesdropdowndiv').prop('hidden', true);
        $('#shippingstatescustomdiv').prop('hidden', false);
    }else{
        //$('#shippingstatesdropdowndiv').show();
        //$('#shippingstatescustomdiv').hide();
        $('#shippingstatesdropdowndiv').prop('hidden', false);
        $('#shippingstatescustomdiv').prop('hidden', true);
    }      

});//END #billingcantfindstate on change


$(document).on('change','#isnewaccount',function(){

    if( $(this).prop("checked") == true ){
        //$('#isnewaccountdiv').show();
        $('#isnewaccountdiv').prop('hidden', false);
    }else{
        //$('#isnewaccountdiv').hide();
        $('#isnewaccountdiv').prop('hidden', true);
    }      

});//END #billingcantfindstate on change



$(document).on('change', '#isrecurring', function(){
    if( $('#isrecurring').is(":checked") )
    {
        // it is checked
        $('#isrecurringdiv').prop('hidden', false);
    }
    else{
        $('#isrecurringdiv').prop('hidden', true);
    }
});


$(document).on('change', '#shiptodifferentaddress', function(){
    if( $('#shiptodifferentaddress').is(":checked") )
    {
        // it is checked
        //$('#divshippingaddress').show();
        $('#divshippingaddress').prop('hidden', false);
    }
    else{
        //$('#divshippingaddress').hide();
        $('#divshippingaddress').prop('hidden', true);
    }
});


$(document).ready(function(){
    $(".jqvalidate-form").validate({
        onfocusout: injectTrim($.validator.defaults.onfocusout)
    });

});

