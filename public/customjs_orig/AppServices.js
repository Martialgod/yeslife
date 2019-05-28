(function(){

	var app = angular.module('AppServices', ['ngSanitize']);

    app.directive('stringToNumber', function() {
      return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
          ngModel.$parsers.push(function(value) {
            return '' + value;
          });
          ngModel.$formatters.push(function(value) {
            return parseFloat(value);
          });
        }
      };
    });



    //BEGIN SQLSTATEFactory
    /*
        LARAVEL throws an entire html page  whenever it encounters PDOException
        SQLSTATEFactory will check for what kind of exception was thrown
        NOTE: we are manually checking the exception by using indeOf property

    */
    app.factory('SQLSTATEFactory', function(){
            
        var SQLSTATEFactory = {};

        SQLSTATEFactory.state = function(data){

            //console.log(data);
            
            //check if record is reference to another transaction
            var sqlstate_foreign_key = data.indexOf("SQLSTATE[23000]");
            var code_foreign_key = data.indexOf("1451");


            var sqlstate_duplicate_key = data.indexOf("SQLSTATE[23000]");
            var code_duplicate_key = data.indexOf("1062");
            var endmsg = data.indexOf();
            //console.log(data.substring(code_duplicate_key, 500))

            //check if route not found or no access
            var exception_title = data.indexOf("exception_title");
            var exception_description = data.indexOf("MethodNotAllowedHttpException");


            if( sqlstate_foreign_key !== -1 && code_foreign_key !== -1 ){
     

                swal('Oops!', 'Cannot delete selected row. <br> record is reference by another transaction', 'error');
            }

            else if( sqlstate_duplicate_key !== -1 && code_duplicate_key !== -1 ){

                swal('Oops!', 'Integrity constraint violation [1062]. <br> record already exists', 'error');
            }


            else if( exception_title !== -1 && exception_description !== -1 ){
                

                swal('Oops!', 'Access denied. <br>you do not have permession to perform this transaction', 'error');
            }

            else{
             
                swal('Oops!', 'please see logs for details', 'error');
                console.log(data);
            }
            
            
        };

        return SQLSTATEFactory;

    }) ;
    //END SQLSTATEFactory



    

    app.factory('GlobalFactory', function(){

        var factory= {};

        factory.showLoadingDiv = function(loadingdiv, contentdiv){
            $(loadingdiv).show();
            $(contentdiv).hide();
        };

        factory.hideLoadingDiv = function(loadingdiv, contentdiv){
            $(loadingdiv).hide();
            $(contentdiv).show();
        };
        

        factory.blockUIMain = function(){

            //@layouts.master
            //block ui to prevent user action while processing ajax request
            /*$('#maindiv').block({
                message: '<h4><i class="fa fa-spin fa-spinner"> </i> Just a moment...</h4>',
	            css: {
        			//backgroundColor:'transparent',
        			color: '#000',
        			border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#fff', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5,
			    }
            }); */

            //$.blockUI('#maindiv');
            $.blockUI({ 
                message: '<h2> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h2>',
                overlayCSS: { opacity: .1 },
                css: {
                  border:     'none',
                  //backgroundColor:'transparent',
                }
            });

        };//END blockUIMain

        factory.unblockUIMain = function(){

            //$('#maindiv').unblock();
            //$.unblockUI('#maindiv');
            $.unblockUI();

        };//END unblockUIMain


        factory.blockUICustom = function(id){

            //@layouts.master
            //block ui to prevent user action while processing ajax request
            /*$(id).block({
               	message: '<h4><i class="fa fa-spin fa-spinner"> </i> Just a moment...</h4>',
	            css: {
        			//backgroundColor:'transparent',
        			color: '#000',
        			border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#fff', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5,
			    }
            }); */ 

            $.blockUI({ 
                message: '<h2> <i class="fa fa-spin fa-spinner" style="color:#fff;"> </i> </h2>',
                overlayCSS: { opacity: .1 },
                css: {
                  border:     'none',
                  backgroundColor:'transparent',
                }
            });

        };//END blockUICustom

        factory.unblockUICustom = function(id){

            //$(id).unblock();
            $.unblockUI();

        };//END blockUICustom



        /*
            returns the formated date;
            - date = reference to the date object to be formated
            - format = format representation of the date;
        */
        factory.formatDate = function(date, format){
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

        };//END factory.formatDate



        /*
            returns errors as string from laravel validator errors
            - date = reference to the date object to be formated
            - format = format representation of the date;
        */
        factory.swalPostParamErrors = function(err){

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
                    errors.push('Address zipcode '+item1);
                });
            }

            if( err.billing_address_zip !== undefined ){
                err.billing_address_zip.forEach(function(item1, index1){
                    errors.push('Billing zipcode '+item1);
                });
            }

            //email already defined at the top
            
            if( err.first_name !== undefined ){
                err.first_name.forEach(function(item1, index1){
                    errors.push('Firstname '+item1);
                });
            }

            if( err.last_name !== undefined ){
                err.last_name.forEach(function(item1, index1){
                    errors.push('Lastname '+item1);
                });
            }

            if( err.phone_number !== undefined ){
                err.phone_number.forEach(function(item1, index1){
                    errors.push('Phone No. '+item1);
                });
            }

            if( err.credit_card_number !== undefined ){
                err.credit_card_number.forEach(function(item1, index1){
                    errors.push('Card Number '+item1);
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

       
        return factory;

    });//END GlobalFactory


    

})();//END file