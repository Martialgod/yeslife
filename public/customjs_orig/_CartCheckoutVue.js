var vm = new Vue({
	
	el: '#main-div',

	data: {

		statusmsg: 'retrieving cart...',
		isoncart: true,
		mscproducts: [],
		msccoupons: [],
		couponcode: null,
		paymentapi: {},
		isloggedin: 'no',
		recurringtrxno: null,
		totalamount: 0,
		totalcoupondiscount: 0,
		totaltax: 0,
		totalshipcost: 0,
		totalnetamount: 0,
    	rallycnumber: null,
    	rallyexpDate: null,
    	rallycvc: null,
	
	},//END data
	
	methods: {
		

		
		LoadCart: function(){
		
			var app = this;

			var cart = getCartCookies(); //@GlobalScript.js

			blockUICustom('#main-div'); //this GlobaScript.js

			// Make a request for a user with a given ID
			axios.post('/cart', {
				cart: cart, isloggedin: app.isloggedin, recurringtrxno: app.recurringtrxno 
			})
			.then(function (response) {

				// handle success
				var data = response.data;
				//console.log(data);

				app.statusmsg = '';

                if( data != 'empty' ){

                	app.mscproducts = data.data;
                	app.CalculateTotal();

                }else{


                }//END data != 'empty'



				unblockUICustom('#main-div'); //@GlobalScript.js


			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                unblockUICustom('#main-div'); //@GlobalScript.js

			});



		}, //END LoadCart


		UpdateCart: function(type, list){

			//type = plus, minus, ''
			
			//console.log(type + list);
			
			var app = this;

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
        	if( app.recurringtrxno == undefined || app.recurringtrxno == '' ){
        		
        		var products = {
					'productid': list.productid,
					'qty': list.selectedqty,
				};

				//re initialize cart cookie to prevent double qty update in addCartCookie
    			document.cookie = "yeslifecart_"+products.productid+"=0; path=/";

				addCartCookie(products); //@GlobalScript.js

        	}//END app.recurringtrxno == undefined

			app.CalculateTotal();

		}, //END UpdateCart


		ApplyCoupon: function(){

			var app = this;

			//console.log(app.couponcode);

			if( app.couponcode == null || app.couponcode == '' || app.couponcode.length <=3 ){
				swal('Opps!', 'Coupon Code not found!', 'warning');
				return;
			}

			if( app.totalnetamount <=0 ){
				swal('Opps!', 'You cannot add another coupon!', 'warning');
				return;
			}

			blockUICustom('#main-div'); //this GlobaScript.js

			// Make a request for a user with a given ID
			axios.post('/api/searchcoupon', {
				couponcode: app.couponcode, userid: app.isloggedin
			})
			.then(function (response) {

				// handle success
				var data = response.data;
				//console.log(data);

				if( data.length > 0 ){

                	//check for duplicate entry
			   		var isfound = false;

                	app.msccoupons.forEach(function(item1, index1){

			   			if( item1.pk_coupons == data[0].pk_coupons ){
 							isfound = true;
 							return;
 						}

                	});//END app.msccoupons
                	
                	if(!isfound){
		   				app.msccoupons.push( data[0] );
		   			}else{

		   			}//!isfound

                }else{

                	swal('Opps!', 'Coupon Code not found!', 'warning');

                }//END data.length >  0

                app.CalculateTotal();


				unblockUICustom('#main-div'); //@GlobalScript.js


			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                unblockUICustom('#main-div'); //@GlobalScript.js

			});


		},//END ApplyCoupon


		RemoveCoupons: function(list){

			var app = this;

			app.msccoupons.forEach(function(item1, index1){

	   			if( item1.pk_coupons == list.pk_coupons ){
					app.msccoupons.splice(index1, 1);
				}

        	});//END app.msccoupons

			app.CalculateTotal();

		}, //END RemoveCoupons


		RemoveFromCart: function(list){

			var app = this;

			app.mscproducts.forEach(function(item1, index1){
				if( item1.productid == list.productid ){

					app.mscproducts.splice(index1, 1);

					//if not a recurring checkout process then assume we checkout base on items added to the cart
		        	if( app.recurringtrxno == undefined || app.recurringtrxno == '' ){
		        		
		        		//remove from cookie
						removeCartCookie( list.productid ); //@GlobalScript.js

		        	}//END app.recurringtrxno == undefined

					

				}//END item1.productid == list.productid 

			});//END app.mscproducts

			app.CalculateTotal();


		}, //END RemoveFromCart


		CalculateTotal: function(){

			var app = this;

			app.totalamount = 0;
			app.totalcoupondiscount = 0;
			app.totaltax = 0;
			app.totalshipcost = 0;
			app.totalnetamount = 0;


            app.mscproducts.forEach(function(item1, index1){

            	item1.totalamount = parseFloat(item1.selectedqty) * parseFloat(item1.cartdiscountedprice);

    			item1.coupondiscount  = 0;

    			item1.taxamount = 0;

    			item1.shipamount = 0;

    			item1.netamount = 0;

            	//calculate coupon discounts 
				app.msccoupons.forEach(function(item2, index2){

					if( item2.type == 'Fixed' ){

						item1.coupondiscount += parseFloat(item2.amount) / parseFloat( app.mscproducts.length );
						
					}else{
						//Rated
						
						item1.coupondiscount += parseFloat(item1.totalamount) * (parseFloat(item2.amount)  / 100 );

						//console.log(item1.coupondiscount);
						
					}//END item2.type == 'Fixed' 
					

				});//END app.msccoupons

				//console.log(item1.coupondiscount);

				item1.netamount = parseFloat(item1.totalamount) - parseFloat(item1.coupondiscount);

				app.totalcoupondiscount += parseFloat(item1.coupondiscount);

				app.totalamount += parseFloat(item1.totalamount);

				app.totalnetamount += parseFloat(item1.netamount);

				//format to 2decimal places
				item1.totalamount = parseFloat(item1.totalamount).toFixed(2);
    			item1.netamount = parseFloat(item1.netamount).toFixed(2);

            });//END app.mscproducts

            //console.log( app.totalamount );
            //console.log( app.totalnetamount );

            //app.totalnetamount = parseFloat(app.totalamount) - parseFloat(app.totalcoupondiscount);

            //format to 2decimal places
            app.totalamount = parseFloat(app.totalamount).toFixed(2);
            app.totalnetamount = parseFloat(app.totalnetamount).toFixed(2);

            //console.log(app.mscproducts);

		}, //END CalculateTotal
		

		IsCartItemsValid: function(){

			var app = this;
			
			//check if cart is not empty and cart net amount not lessthan zero
          	if( app.mscproducts.length <=0  ){
          		swal('Opps!', 'Youre cart is empty!', 'error');
          		return false;
          	}

          	if( app.totalnetamount <= 0 ){
          		swal('Opps!', 'Net amount cannot be zero!', 'error');
          		return false;
          	}

          	return true;

		},//END IsCartItemsValid


		ShowCart: function(){

			var app = this;

			app.isoncart = true; //tregger show or hide cart and checkout forms
			//$('#divcheckout').show();
			$('#divcheckout').prop('hidden', true);
		}, 

		ShowCheckout: function(){

			var app = this;

			if(!app.IsCartItemsValid()){
				return;
			}
			app.isoncart = false; //tregger show or hide cart and checkout forms
			//$('#divcheckout').show();
			$('#divcheckout').prop('hidden', false);

		}, //END app.ShowCheckout


		ConfirmCheckout: function(){

			var app = this;

			//jquery validate
			if(!$('#form-checkout').valid()){
				return;
			}

          	//validate items
          	if(!app.IsCartItemsValid()){
				return;
			}

			//validate isrecurring dates
			if( $('#isrecurring').is(":checked") ){

				var datenow = formatDate( (new Date()), 'yyyy-MM-dd' ); //@GlobalScript.js
				var timenow = new Date(datenow).getTime();

				//var startdate = new Date($('#startdate').val()).getTime();
				var enddate = new Date($('#enddate').val()).getTime();

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

            app.rallycnumber = ($('#rally_cardNumber').val()).trim();

        	if( app.rallycnumber == undefined || app.rallycnumber == '' || app.rallycnumber.length == 0 ){

        		//swal('Opps!', 'Credit card number is required!', 'error');
        		$('#errrally_cardNumber').html('This is required!');
        		$('#rally_cardNumber').focus();
        		return;

        	} $('#errrally_cardNumber').html('');


        	if( isNaN(app.rallycnumber) || ( Math.floor(app.rallycnumber) != app.rallycnumber ) ){

        		//swal('Opps!', 'Please enter Proper card number!', 'error');
        		$('#errrally_cardNumber').html('Not a valid card number!');
        		$('#rally_cardNumber').focus();
        		return;

        	}  $('#errrally_cardNumber').html('');


        	app.rallyexpDate = ($('#rally_expDate').val()).trim();
        	if( app.rallyexpDate == undefined || app.rallyexpDate == '' || app.rallyexpDate.length == 0  ){
        		
        		//swal('Opps!', 'Expiry date is required!', 'error');
        		$('#errrally_expDate').html('This is required!');
        		$('#rally_expDate').focus();
        		return;

        	} $('#errrally_expDate').html('');

        	if( app.rallyexpDate.match(/^\d{1,2}\/\d{4}$/) == null ){
        		
        		//swal('Opps!', 'Invalid Expiry date format (MM/YYYY)!', 'error');
        		$('#errrally_expDate').html('Format should be (MM/YYYY)');
        		$('#rally_expDate').focus();
        		return;

        	} $('#errrally_expDate').html('');
        
        	app.rallycvc = ($('#rally_cvc').val()).trim();

        	if( app.rallycvc == undefined || app.rallycvc == '' || app.rallycvc.length == 0 ){

        		//swal('Opps!', 'Credit card number is required!', 'error');
        		$('#errrally_cvc').html('This is required!');
        		$('#rally_cvc').focus();
        		return;

        	} $('#errrally_cvc').html('');

        	if( /^\d{3,4}$/.test(app.rallycvc) != 1 ){

        		$('#errrally_cvc').html('Invalid CVC!');
        		$('#rally_cvc').focus();
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
			        
			        console.log('cart payment logic...');

			      	//remove event handler submit, prevent recursion call of the submit
			      	//$(e.currentTarget).off("submit").submit(); 

			      	app.procesRallyPay();

			    }
			});

		}, //END ConfirmCheckout


		procesRallyPay: function(){

			var app = this;

        	var finalstate = '';
        	if( !$('#billingcantfindstate').prop('checked') == true ){
        		finalstate = $('#billingstatesdropdown').val();
        	}else{
        		finalstate = $('#billingstatescustom').val();
        	}

        	app.paymentapi = {

        		'cardno': ($('#rally_cardNumber').val()).trim(),
        		'exmonth': app.rallyexpDate.substring(0,2),
        		'exyear': app.rallyexpDate.substring(3,vm.rallyexpDate.length),
        		'cvc': ($('#rally_cvc').val()).trim(),

        	};//to be submitted to store in db

        	var donation = {
        		credit_card_number: app.paymentapi.cardno,
        		credit_card_security_code: app.paymentapi.cvc,
        		credit_card_expiration_month: app.paymentapi.exmonth,
        		credit_card_expiration_year: app.paymentapi.exyear,
        		amount: app.totalnetamount,
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

        	//rallypay
        	/*vm.paymentapi = {
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

        	return; */
        	
        	blockUICustom('#main-div'); //this GlobaScript.js

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

	                unblockUICustom('#main-div'); //this GlobaScript.js

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
	                app.paymentapi = data; 

			      	app.SubmitCart();

	            },
	            error: function(data){
	                console.log(data);
	                console.log('error');

	                swalPostParamErrors(data.responseJSON.message); //@GlobalScript.js

	                unblockUICustom('#main-div'); //this GlobaScript.js

	            }

	        });//END $.ajax


        },//END procesRallyPay



		SubmitCart: function(){

			var app = this;

			blockUICustom('#main-div'); //this GlobaScript.js

			// Make a request for a user with a given ID
			axios.post('/api/save-order', {
				'recurringtrxno': app.recurringtrxno,
				'cart': app.mscproducts, 
				'coupons': app.msccoupons,
				'total': {
					'totalamount': app.totalamount,
					'totalnetamount': app.totalnetamount,
					'totalcoupondiscount': app.totalcoupondiscount,
					'totaltax':	app.totaltax,
					'totalshipcost': app.totalshipcost
				},
				'paymentapi': app.paymentapi, //value are being processed in vm.procesRallyPay()
				'address': $('#form-checkout').serializeArray()
			})
			.then(function (response) {

				// handle success
				var data = response.data;
				console.log(data);

				if( data.status == 'success' ){

                	//if not a recurring checkout process then assume we checkout base on items added to the cart
                	if( app.recurringtrxno == undefined || app.recurringtrxno == '' ){
                		deleteAllCartCookies(); //@GlobalScript.js
                	}

                	//go to checkout success page;
					location.href = '/order/success/'+data.trxno;

                }else{
                	unblockUICustom('#main-div'); //@GlobalScript.js
                }


			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                unblockUICustom('#main-div'); //@GlobalScript.js

			});

			

		}, //END SubmitCart



	},//END methods


	//cached 
	computed: {


	},//END computed

		
	mounted: function(){
		var app = this;
		$('#divcheckout').prop('hidden', true);
		app.isoncart= true;
		app.isloggedin = $('#isloggedin').val(); //intialize @master layout; contains session id
		app.recurringtrxno = $('#recurringtrxno').val();


		setTimeout(function(){
			app.LoadCart();
		}, 500);
		

	},//END mounted

	//fetch api data here
	created: function(){

	},//END created


})//END Vue

