(function(){

	var app = angular.module('app', ['AppServices'])
		.constant('API_URL', '/free-sample')//define constant API_URL to be used in linking angular and laravel
		//to enable laravel request()->ajax()
		.config(['$httpProvider', function($httpProvider){
				$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
			}]); 



	app.controller('FreeSampleController', ['$http', 'API_URL', 'GlobalFactory', function($http, API_URL, GlobalFactory){

		var vm = this;


		vm.productid = $('#productid').val();
		//console.log(vm.productid);
		
		vm.mscproducts = [];

		vm.paymentapi = {};

		
		//determine referral token
		vm.referrer_token = $('#referrer_token').val();
		vm.yeslife_referrer_id = $('#yeslife_referrer_id').val();
		//console.log(vm.yeslife_referrer_id);

		vm.LoadCart = function(){
	
	
			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			//showCustomizeLoading(); //@GlobalScript.js

			$http.get('/free-sample/showproduct/'+vm.productid)
            .then(function(response){

                //console.log(response);
                var data = response.data;
                //console.log(data);

                vm.statusmsg = '';

                if( data.data.length > 0 ){

                	vm.mscproducts = data.data;

                	vm.CalculateTotal();


                }else{

                	swal('Opps!', 'No sample is available at this moment!', 'error');

                }//END data != 'not found'

               
                

               	//console.log(vm.mscproducts);

                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            },function(response){

                console.log(response);

                swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                
                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            });//END $http

		};//END LoadCart



		vm.CalculateTotal = function(){

			vm.totalamount = 0;
			vm.totalcoupondiscount = 0;
			vm.totaltax = 0;
			vm.totalshipcost = 0;
			vm.totalnetamount = 0;


            vm.mscproducts.forEach(function(item1, index1){

            	item1.selectedqty = 1;

            	item1.totalamount = 0;

    			item1.coupondiscount  = 0;

    			item1.taxamount = 0;

    			item1.shipamount = 0;

    			item1.shipamount += parseFloat(item1.shippingcost);

    			item1.netamount = 0; //free

				vm.totalamount += parseFloat(item1.shippingcost);

				vm.totalshipcost += parseFloat(item1.shippingcost);

				vm.totalnetamount += parseFloat(item1.shippingcost);

				//format to 2decimal places
				item1.totalamount = parseFloat(item1.totalamount).toFixed(2);
				item1.shipamount = parseFloat(item1.shipamount).toFixed(2);
    			item1.netamount = parseFloat(item1.netamount).toFixed(2);

            });//END vm.mscproducts

            //console.log( vm.totalamount );
            //console.log( vm.totalnetamount );

            //vm.totalnetamount = parseFloat(vm.totalamount) - parseFloat(vm.totalcoupondiscount);

            //format to 2decimal places
            vm.totalamount = parseFloat(vm.totalamount).toFixed(2);
            vm.totalshipcost = parseFloat(vm.totalshipcost).toFixed(2);
            vm.totalnetamount = parseFloat(vm.totalnetamount).toFixed(2);

            //console.log(vm.mscproducts);

		};//END CalculateTotal
		



		vm.SubmitCart = function(){

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			showCustomizeLoading(); //@GlobalScript.js

			$http.post('/api/save-order', {
				'referrer_token': vm.referrer_token,
				'yeslife_referrer_id': vm.yeslife_referrer_id,
				'recurringtrxno': null,
				'cart': vm.mscproducts, 
				'coupons': [],
				'total': {
					'totalamount': vm.totalamount,
					'totalnetamount': vm.totalnetamount,
					'totalcoupondiscount': vm.totalcoupondiscount,
					'totaltax':	vm.totaltax,
					'totalshipcost': vm.totalshipcost
				},
				'paymentapi': vm.paymentapi, //value are being processed in vm.procesRallyPay()
				'address': $('#form-checkout').serializeArray()
			})
            .then(function(response){

                console.log(response);
                var data = response.data;

                //bypass checkout
                //hideCustomizeLoading();  return;

                if( data.status == 'success' ){

                	LeadDyno.recordPurchase( $('#billingemail').val(), {
                		purchase_code: data.trxno, 
                		purchase_amount: vm.totalnetamount, 
                		/*line_items: {
                			sku: 'sku1', quantity: 1, description: 'test', amount: 15
                		}*/
                	}, function(){


                		console.log("Purchase successfully sent to LeadDyno");

	                	//go to checkout success page;
	                	if( vm.referrer_token != null && vm.referrer_token != '' ){
	                		location.href = '/order/success/'+data.trxno+'?refno='+vm.referrer_token;
	                	}else{
	                		location.href = '/order/success/'+data.trxno;
	                	}//END if vm.referrer_token

                	});	

			        LeadDyno.devTools.setLogger(function(message) {
			            console.log("LeadDyno Log: " + message);
			        }); 
			         
                	/*LeadDyno.recordCancellation('opic.billsmonitoring@gmail.com', function() {
			            console.log("Cancellation successfully sent to LeadDyno");
			        });*/

                	//hideCustomizeLoading(); //@GlobalScript.js
                	//return;


					
                }else{
                	//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                	hideCustomizeLoading(); //@GlobalScript.js
               
                }//END data.status == 'success'

                

            },function(response){

                console.log(response);

                var data = response.data;

                GlobalFactory.swalPostParamErrors(data);

                //swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');

               	//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
               	hideCustomizeLoading(); //@GlobalScript.js

            });//END $http


		};//END SubmitCart
		  

        vm.NextStep = function(){

            //jquery validate
            if(!$('#form-checkout').valid()){
                return;
            }

            $('#div-personal-info').prop('hidden', true);
            $('#div-card-details').prop('hidden', false);

            $('#rally_cardNumber').focus();

            //console.log('s');

        };//END NextStep

        vm.BackStep = function(){

            $('#div-personal-info').prop('hidden', false);
            $('#div-card-details').prop('hidden', true);

        };//END BackStep


		$(document).on('submit','#form-checkout',function(e){
          		
          	//already validated using jquery validate; form with class jqvalidate-form
          	//initialize @layout master.blade.php

          	e.preventDefault();

          	//jquery validate
			if(!$('#form-checkout').valid()){
				return;
			}

            if( vm.totalnetamount <= 0 ){
                swal('Opps!', 'Net amount cannot be zero!', 'error');
                return false;
            }

       

			if( $('#isnewaccount').prop("checked") == true ){
               if( $('#billingpassword').val().length == 0 || ( $('#billingpassword').val() != $('#billingrepeatpassword').val() ) ){

               	swal('Opps!', 'Password does not match!', 'error');
               	return;

               }
            }  	

            vm.rallycnumber = ($('#rally_cardNumber').val()).trim();

        	/*if( vm.rallycnumber == undefined || vm.rallycnumber == '' || vm.rallycnumber.length == 0 ){

        		//swal('Opps!', 'Credit card number is required!', 'error');
        		$('#errrally_cardNumber').html('This is required!');
        		$('#rally_cardNumber').focus();
        		return;

        	} $('#errrally_cardNumber').html(''); 
        	
        	if( isNaN(vm.rallycnumber) || ( Math.floor(vm.rallycnumber) != vm.rallycnumber ) ){

        		//swal('Opps!', 'Please enter Proper card number!', 'error');
        		$('#errrally_cardNumber').html('Not a valid card number!');
        		$('#rally_cardNumber').focus();
        		return;

        	}  $('#errrally_cardNumber').html(''); */


        	vm.rallyexpDate = ($('#rally_expDate').val()).trim();

        	if( vm.rallyexpDate == undefined || vm.rallyexpDate == '' || vm.rallyexpDate.length == 0  ){
        		
        		//swal('Opps!', 'Expiry date is required!', 'error');
        		$('#errrally_expDate').html('This is required!');
        		$('#rally_expDate').focus();
        		return;

        	} $('#errrally_expDate').html('');

        	if( vm.rallyexpDate.match(/^\d{1,2}\/\d{4}$/) == null ){
        		
        		//swal('Opps!', 'Invalid Expiry date format (MM/YYYY)!', 'error');
        		$('#errrally_expDate').html('Format should be (MM/YYYY)');
        		$('#rally_expDate').focus();
        		return;

        	} $('#errrally_expDate').html('');
        	

        	vm.rallycvc = ($('#rally_cvc').val()).trim();

        	if( vm.rallycvc == undefined || vm.rallycvc == '' || vm.rallycvc.length == 0 ){

        		//swal('Opps!', 'Credit card number is required!', 'error');
        		$('#errrally_cvc').html('This is required!');
        		$('#rally_cvc').focus();
        		return;

        	} $('#errrally_cvc').html('');

        	if( /^\d{3,4}$/.test(vm.rallycvc) != 1 ){

        		$('#errrally_cvc').html('Invalid CVC!');
        		$('#rally_cvc').focus();
        		return;

        	}
	   

            vm.isFirstTimer();

            //removed as per Ms. Ace and Forrester @May 29 2019
		 	/*swal({
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
			        
			        //console.log('cart payment logic...');

			      	//remove event handler submit, prevent recursion call of the submit
			      	//$(e.currentTarget).off("submit").submit(); 

			      	vm.isFirstTimer();
                    
                    //vm.procesRallyPay();

			    }
			}); */
		 	

         	

        });//END #form-checkout on change


		vm.isFirstTimer = function(){

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			showCustomizeLoading(); //@GlobalScript.js

			$http.get('/free-sample/isfirsttimer/'+$('#billingemail').val()+'/'+vm.productid)
            .then(function(response){

                //console.log(response);
                var data = response.data;
                //console.log(data);


                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

                if( data == 'yes' ){

                	vm.procesRallyPay();

                }else{

                	swal('Opps!', 'It seems you already avail our free sample', 'error');
                
                }



            },function(response){

                console.log(response);

                swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                
                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            });//END $http

		};//END isFirstTimer



        vm.procesRallyPay = function(){

        	var finalstate = '';
        	if( !$('#billingcantfindstate').prop('checked') == true ){
        		finalstate = $('#billingstatesdropdown').val();
        	}else{
        		finalstate = $('#billingstatescustom').val();
        	}

        	vm.paymentapi = {
                //remove spaces
        		'cardno': (($('#rally_cardNumber').val()).trim()).replace(/\s/g, ''), 
        		'exmonth': vm.rallyexpDate.substring(0,2),
        		'exyear': vm.rallyexpDate.substring(3,vm.rallyexpDate.length),
        		'cvc': ($('#rally_cvc').val()).trim(),

        	};//to be submitted to store in db

        	var donation = {
        		credit_card_number: vm.paymentapi.cardno,
        		credit_card_security_code: vm.paymentapi.cvc,
        		credit_card_expiration_month: vm.paymentapi.exmonth,
        		credit_card_expiration_year: vm.paymentapi.exyear,
        		amount: vm.totalnetamount,
        		email: $('#billingemail').val(),
        		phone_number: $('#billingphone').val(),
        		first_name: $('#billingfname').val(),
        		last_name: $('#billinglname').val(),
        		address_address1: $('#billingaddress1').val(),
        		address_city: $('#billingcity').val(),
        		address_state: finalstate,
        		address_country: ($("#billingcountry option:selected").text()).trim(),
        		address_zip: $('#billingzip').val(),
        		occupation: '',
        		employer:'',
        		gender:'',
        	};

            //console.log(donation); return;
        	
        	/*
        	//bypass rallypay
        	vm.paymentapi = {
        		amount: 100,
            	currency: 'usd',
            	email: 'test@gmail.com',
            	id: '3213sdf',
				payment_token: '5dfgfd',
				transaction_number: '12312312dfsd',
				user: {
					email: 'test@gmail.com',
					id: '1ftrt2',
				}
        	};
	        //console.log(donation);
	        vm.SubmitCart();
        	return;  */

        	//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
        	showCustomizeLoading(); //@GlobalScript.js

        	$.ajax({
	            type: "POST",
	            //url: 'https://staging.rallypay.com/api/v1/donations/paywithcard', //store on post
	           	url: 'https://rallypay.com/api/v1/donations/paywithcard', 
	            headers:{"RALLY-API-TOKEN": 'pk_live_c15b10d1e39a990c2165080985f5b9b9' },
	            data:{
	            	donation: donation,
	            	custom_fields:{}
	            },
	            success: function(data){
	                
	                console.log(data);

	                //$.unblockUI('#main-div');
	                hideCustomizeLoading(); //@GlobalScript.js

	                //order store db here....
	                //console.log('order store db here....');

	                vm.paymentapi = data; 

			      	vm.SubmitCart();
	                

	            },
	            error: function(data){
	                console.log(data);
	                console.log('error');

	                GlobalFactory.swalPostParamErrors(data.responseJSON.message);

	                //$.unblockUI('#main-div');
	                hideCustomizeLoading(); //@GlobalScript.js

	            }

	        });//END $.ajax


        };//END validateRally


        showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){
			vm.LoadCart();
		}, 500);
		

	}]);//END FreeSampleController


})();//END file
