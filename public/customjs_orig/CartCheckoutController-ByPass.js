(function(){

	var app = angular.module('app', ['AppServices'])
		.constant('API_URL', '/cart')//define constant API_URL to be used in linking angular and laravel
		//to enable laravel request()->ajax()
		.config(['$httpProvider', function($httpProvider){
				$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
			}]); 



	app.controller('CartCheckoutController', ['$http', 'API_URL', 'GlobalFactory', function($http, API_URL, GlobalFactory){

		var vm = this;

		vm.statusmsg = 'retrieving cart...';

		vm.isoncart = true; //tregger show or hide cart and checkout forms
		//$('#divcheckout').hide();
		$('#nodisplay-div').prop('hidden', true);
		$('#cart-div').prop('hidden', true);
		$('#divcheckout').prop('hidden', true);


		vm.mscproducts = [];

		vm.msccoupons = [];

		vm.mscstates = [];
		vm.selectedstates = {};
		vm.selectedtaxrate = 0;

		vm.couponcode = null;

		vm.paymentapi = {};

		vm.isloggedin = $('#isloggedin').val(); //intialize @master layout; contains session id

		//determine if user is approving recurring order through checkout
		vm.recurringtrxno = $('#recurringtrxno').val();
		//console.log(vm.recurringtrxno);
		
		//determine referral token
		vm.referrer_token = $('#referrer_token').val();
		vm.yeslife_referrer_id = $('#yeslife_referrer_id').val();
		//console.log(vm.yeslife_referrer_id);

		vm.LoadCart = function(){
	
			var cart = getCartCookies(); //@GlobalScript.js

			//console.log(cart);

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			//showCustomizeLoading(); //@GlobalScript.js
			
			//console.log(vm.recurringtrxno );
			
			//'api/cart'
			$http.post('/cart', {
				cart: cart, 
				isloggedin: vm.isloggedin, 
				recurringtrxno: vm.recurringtrxno 
			})
            .then(function(response){

                //console.log(response);
                var data = response.data;
                //console.log(data);

                vm.statusmsg = '';

                if( data != 'empty' ){

                	$('#nodisplay-div').prop('hidden', true);
					$('#cart-div').prop('hidden', false);

                	vm.mscproducts = data.cart;
                	vm.mscstates = data.mscstates;


               		vm.SetSelectedStates();
                	//vm.CalculateTotal();

                	//syn javascript cookie to be the same as the final cart
                	vm.mscproducts.forEach(function(item1, index1){

                		document.cookie = "yeslifecart_"+item1.productid+"="+item1.selectedqty+"; path=/";

                	});//END mscproducts

                	updateCartCookieCount();//GlobalScript.js

                }else{

                	$('#nodisplay-div').prop('hidden', false);
					$('#cart-div').prop('hidden', true);

                }//END data != 'empty'

               	
                

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


		vm.UpdateCart = function(type, list){

			//type = plus, minus, ''
			
			//console.log(type + list);

			list.selectedqty = ( isNaN(list.selectedqty) || list.selectedqty == undefined || list.selectedqty == '' ) ? 1 : list.selectedqty;

			if( type == 'plus' ){
				list.selectedqty++;
			}
			else if( type == 'minus' ){

				list.selectedqty--;

			}

			if( list.selectedqty <= 0 ){
				list.selectedqty = 1;
			}

			//if not a recurring checkout process then assume we checkout base on items added to the cart
        	if( vm.recurringtrxno == undefined || vm.recurringtrxno == '' ){
        		
        		var products = {
					'productid': list.productid,
					'qty': list.selectedqty,
				};

				//re initialize cart cookie to prevent double qty update in addCartCookie
    			document.cookie = "yeslifecart_"+products.productid+"=0; path=/";

				addCartCookie(products); //@GlobalScript.js

        	}//END vm.recurringtrxno == undefined

			vm.CalculateTotal();

		}; //END UpdateCart



		vm.ApplyCoupon = function($event){

			$event.preventDefault();

			//console.log(vm.couponcode);

			if( vm.couponcode == null || vm.couponcode == '' || vm.couponcode.length <=3 ){
				swal('Opps!', 'Coupon Code not found!', 'warning');
				return;
			}

			if( vm.totalnetamount <=0 ){
				swal('Opps!', 'You cannot add another coupon!', 'warning');
				return;
			}

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			showCustomizeLoading(); //@GlobalScript.js

			$http.post('/api/searchcoupon', {couponcode: vm.couponcode, userid: vm.isloggedin})
            .then(function(response){

                //console.log(response);
                var data = response.data;
                //console.log(data);

                if( data.length > 0 ){

                	//check for duplicate entry
			   		var isfound = false;

                	vm.msccoupons.forEach(function(item1, index1){

			   			if( item1.pk_coupons == data[0].pk_coupons ){
 							isfound = true;
 							return;
 						}

                	});//END vm.msccoupons
                	
                	if(!isfound){
		   				vm.msccoupons.push( data[0] );
		   			}else{

		   			}//!isfound

                }else{

                	swal('Opps!', 'Coupon Code not found!', 'warning');

                }//END data.length >  0

                vm.CalculateTotal();


                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            },function(response){

                console.log(response);

                //swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                swal('Opps!', 'Coupon Code not found!', 'error');
                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            });//END $http


		};//END ApplyCoupon



		vm.RemoveCoupons = function(list){


			vm.msccoupons.forEach(function(item1, index1){

	   			if( item1.pk_coupons == list.pk_coupons ){
					vm.msccoupons.splice(index1, 1);
				}

        	});//END vm.msccoupons

			vm.CalculateTotal();

		};//END RemoveCoupons



		vm.CalculateTotal = function(){

			vm.totalqty = 0;
			vm.subtotal = 0;
			vm.totalamount = 0;
			vm.totalcoupondiscount = 0;
			vm.totaltax = 0;
			vm.totalshipcost = 0;
			vm.totalnetamount = 0;	

			vm.selectedtaxrate = 0;
			

			//@GlobalScript.js
			if( !isEmpty(vm.selectedstates) ){
				$('#totaltax1').prop('hidden', false);
				vm.selectedtaxrate = parseFloat(vm.selectedstates.taxrate);
			}


            vm.mscproducts.forEach(function(item1, index1){

            	vm.totalqty += parseFloat(item1.selectedqty);

            	item1.totalamount = parseFloat(item1.selectedqty) * parseFloat(item1.cartdiscountedprice);

    			item1.coupondiscount  = 0;

    			item1.taxamount = 0;

    			item1.shipamount = 0;

    			item1.netamount = 0;

            	//calculate coupon discounts 
				vm.msccoupons.forEach(function(item2, index2){

					if( item2.type == 'Fixed' ){

						item1.coupondiscount += parseFloat(item2.amount) / parseFloat( vm.mscproducts.length );
						
					}else{
						//Rated
						
						item1.coupondiscount += parseFloat(item1.totalamount) * (parseFloat(item2.amount)  / 100 );

						//console.log(item1.coupondiscount);
						
					}//END item2.type == 'Fixed' 
					

				});//END vm.msccoupons

				
				item1.netamount = parseFloat(item1.totalamount) - parseFloat(item1.coupondiscount);

				//calculate tax after discount
				item1.taxamount = ( item1.netamount ) * ( vm.selectedtaxrate / 100 );

				vm.totalcoupondiscount += parseFloat(item1.coupondiscount);

				vm.totaltax += parseFloat(item1.taxamount);

				vm.totalamount += parseFloat(item1.totalamount);

				vm.totalnetamount += parseFloat(item1.netamount) + parseFloat(item1.taxamount);

				//format to 2decimal places
				item1.taxamount = parseFloat(item1.taxamount).toFixed(2);
				item1.coupondiscount = parseFloat(item1.coupondiscount).toFixed(2);
				item1.totalamount = parseFloat(item1.totalamount).toFixed(2);
    			item1.netamount = parseFloat(item1.netamount).toFixed(2);

            });//END vm.mscproducts

            //console.log( vm.totalamount );
            //console.log( vm.totalnetamount );

            //vm.totalnetamount = parseFloat(vm.totalamount) - parseFloat(vm.totalcoupondiscount);

            //format to 2decimal places
            vm.totaltax = parseFloat(vm.totaltax).toFixed(2);
            vm.totalcoupondiscount = parseFloat(vm.totalcoupondiscount).toFixed(2);
            vm.totalamount = parseFloat(vm.totalamount).toFixed(2);
            vm.totalnetamount = parseFloat(vm.totalnetamount).toFixed(2);

            vm.subtotal = parseFloat(vm.totalamount) - parseFloat(vm.totalcoupondiscount);
            vm.subtotal = parseFloat(vm.subtotal).toFixed(2);
            //console.log(vm.subtotal);


			$('#totaltax1').html(" Sales Tax <span> $"+vm.totaltax +"</span>");
			$('#totaltax2').html(" Sales Tax <span> $"+vm.totaltax +"</span>");
			$('#grandtotal1').html(" Grand Total <span> $"+vm.totalnetamount +"</span>");
			$('#grandtotal2').html(" Grand Total <span> $"+vm.totalnetamount +"</span>");

            //console.log(vm.totaltax);
            //console.log(vm.mscproducts);


		};//END CalculateTotal
		


		vm.RemoveFromCart = function(list){

			vm.mscproducts.forEach(function(item1, index1){
				if( item1.productid == list.productid ){

					vm.mscproducts.splice(index1, 1);

					//if not a recurring checkout process then assume we checkout base on items added to the cart
		        	if( vm.recurringtrxno == undefined || vm.recurringtrxno == '' ){
		        		
		        		//remove from cookie
						removeCartCookie( list.productid ); //@GlobalScript.js

		        	}//END vm.recurringtrxno == undefined

					

				}//END item1.productid == list.productid 

			});//END vm.mscproducts

			if( vm.mscproducts.length == 0 ){
				$('#nodisplay-div').prop('hidden', false);
				$('#cart-div').prop('hidden', true);
			}

			vm.CalculateTotal();


		};//END RemoveFromCart


		vm.IsCartItemsValid = function(){
			
			//check if cart is not empty and cart net amount not lessthan zero
          	if( vm.mscproducts.length <=0  ){
          		swal('Opps!', 'Youre cart is empty!', 'error');
          		return false;
          	}

          	if( vm.totalnetamount <= 0 ){
          		swal('Opps!', 'Net amount cannot be zero!', 'error');
          		return false;
          	}

          	return true;

		};//END IsCartItemsValid

		vm.ShowCart = function(){

			vm.isoncart = true; //tregger show or hide cart and checkout forms
			//$('#divcheckout').show();
			$('#cart-div').prop('hidden', false);
			$('#divcheckout').prop('hidden', true);

		}

		vm.ShowCheckout = function(){
			if(!vm.IsCartItemsValid()){
				return;
			}
			vm.isoncart = false; //tregger show or hide cart and checkout forms
			//$('#divcheckout').show();
			$('#cart-div').prop('hidden', true);
			$('#divcheckout').prop('hidden', false);

		};//END vm.ShowCheckout



		vm.SubmitCart = function(){

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			showCustomizeLoading(); //@GlobalScript.js

			$http.post('/api/save-order', {
				'referrer_token': vm.referrer_token,
				'yeslife_referrer_id': vm.yeslife_referrer_id,
				'recurringtrxno': vm.recurringtrxno,
				'cart': vm.mscproducts, 
				'coupons': vm.msccoupons,
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

                		//if not a recurring checkout process then assume we checkout base on items added to the cart
	                	/*if( vm.recurringtrxno == undefined || vm.recurringtrxno == '' ){
	                		deleteAllCartCookies(); //@GlobalScript.js
	                	}*/

	                	deleteAllCartCookies(); //@GlobalScript.js

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
		


		$(document).on('submit','#form-checkout',function(e){
          		
          	//already validated using jquery validate; form with class jqvalidate-form
          	//initialize @layout master.blade.php

          	e.preventDefault();

          	//jquery validate
			if(!$('#form-checkout').valid()){
				return;
			}

          	//validate items
          	if(!vm.IsCartItemsValid()){
				return;
			}

			//validate isrecurring dates
			if( $('#isrecurring').is(":checked") ){

				var datenow = GlobalFactory.formatDate( (new Date()), 'yyyy-MM-dd' );
				var timenow = new Date(datenow).getTime();

				//var startdate = new Date($('#startdate').val()).getTime();
				var enddate = new Date($('#enddate').val()).getTime();

				/*if( startdate < timenow ){
					swal('Opps!', 'Recurring start date should be greater than today!', 'error');
					return;
				}*/

				if( $('#enddate').val() !== 'undefined' && $('#enddate').val() != '' && ( enddate <= timenow ) ){

					swal('Opps!', 'Recurring end date should be greater than today!', 'error');
					return;

				}

				//console.log( new Date(datenow).getTime() );


			}//END isrecurring

			
			
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
			
			vm.procesRallyPay();
        	//removed as per Ms. Ace and Forrester @May 29 2019
        	/*
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
			        
			        //console.log('cart payment logic...');

			      	//remove event handler submit, prevent recursion call of the submit
			      	//$(e.currentTarget).off("submit").submit(); 

			      	vm.procesRallyPay();

			    }
			}); */

		 	/*.then((result) => {

			    if (result.value) {

			      console.log('cart payment logic...');

			      //remove event handler submit, prevent recursion call of the submit
			      //$(e.currentTarget).off("submit").submit(); 
			      vm.SubmitCart();
			      
			    }

			});//END swal */
         	

        });//END #form-checkout on change



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
        	return;  

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

	                /* 

	                data = {
	                	amount: 100,
	                	currency: 'usd',
	                	email: 'test@gmail.com',
	                	id: '3213sdf',
						payment_token: '5dfgfd',
						transaction_number: '12312312dfsd',
						user: {
							email: 'test@gmail.com',
							id: '1ftrt2'
						}
					}
	                	
	                */
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


        vm.SetSelectedStates = function(){

			vm.selectedstates = {};

			var tempstates = '';

			if( $('#shiptodifferentaddress').prop("checked") == true ){

				if( $('#shippingcantfindstate').prop('checked') == true ){
					tempstates =  '';
				}else{
					tempstates =  $('#shippingstatesdropdown').val();
				}

			}else{

				if( $('#billingcantfindstate').prop('checked') == true ){
					tempstates =  '';
				}else{
					tempstates =  $('#billingstatesdropdown').val();
				}
				
			}

			var totalstates = vm.mscstates.length;
			for(var i=0; i<totalstates; i++){

				if( vm.mscstates[i].name == tempstates ){
					vm.selectedstates = vm.mscstates[i];
					break;
				}

			}

			vm.CalculateTotal();

		};//END SetSelectedStates


		$(document).on('change','#billingstatesdropdown',function(){
			vm.SetSelectedStates();
		});//END #billingcountry on change



		$(document).on('change','#billingcantfindstate',function(){
		   vm.SetSelectedStates();
		});//END #billingcantfindstate on change


		$(document).on('change', '#shiptodifferentaddress', function(){
			vm.SetSelectedStates();
		});

		$(document).on('change','#shippingstatesdropdown',function(){
		    vm.SetSelectedStates();
		});//END #shippingstatesdropdown on change


		$(document).on('change','#shippingcantfindstate',function(){
		   	vm.SetSelectedStates();
		});//END #shippingcantfindstate on change



        //showCustomizeLoading(); //@GlobalScript.js
        showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){
			vm.LoadCart();
		}, 500);
		

	}]);//END CartCheckoutController


})();//END file
