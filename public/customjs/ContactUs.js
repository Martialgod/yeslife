$(document).ready(function(){


    $('#form-contact').on('submit', function(e){
            
        //already validated using jquery validate; form with class jqvalidate-form
        //initialize @layout master.blade.php

        e.preventDefault();

        //jquery validate
        if(!$('#form-contact').valid()){
            return;
        }

        //$.blockUI('#main-div');
        showCustomizeLoading(); //@GlobalScript.js


        $.ajax({
            type: "POST",
            url: '/api/contact-us', //store on post
            data: {
                'data': $(this).serializeArray()
            }, // 
            success: function(data){
                
                //console.log(data);

                if( data == 'success' ){

                    // Display a success toast, with a title
                    swal('Success!', 'thank you for reaching us!', 'success');
                    
                    $('#subject').val('');
                    $('#message').val('');

                }else{

                    swal('Opps!', 'Something went wrong! Please Try Again', 'error');
                    
                }

                //$.unblockUI('#main-div');
                hideCustomizeLoading(); //@GlobalScript.js

            },
            error: function(data){
                console.log(data);
                console.log('error');

                //$.unblockUI('#main-div');
                hideCustomizeLoading(); //@GlobalScript.js

            }

        });//END $.ajax


    });//END #form-contact


});