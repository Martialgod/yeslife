$(document).ready(function(){
   

    $('#form-subscription').on('submit', function(e){
            
        //already validated using jquery validate; form with class jqvalidate-form
        //initialize @layout master.blade.php

        e.preventDefault();

        //jquery validate
        if(!$('#form-subscription').valid()){
            return;
        }

        //$.blockUI('#subscription-div');
        blockUICustom('#subscription-div');

        $.ajax({
            type: "POST",
            url: '/api/subscribe', //store on post
            data: {
                'data': $(this).serializeArray()
            }, // 
            success: function(data){
                
                console.log(data);

                if( data == 'success' ){

                    // Display a success toast, with a title
                    swal('Success!', 'thank you for your subscription!', 'success');
                    
                    $('#subemail').val('');

                }else{

                    swal('Opps!', 'Something went wrong! Please Try Again', 'error');
                    
                }

                //$.unblockUI('#subscription-div');
                unblockUICustom('#subscription-div');

            },
            error: function(data){
                console.log(data);
                console.log('error');

                //$.unblockUI('#subscription-div');
                unblockUICustom('#subscription-div');

            }

        });//END $.ajax


    });//END #form-subscription

});