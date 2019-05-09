(function(){

	var app = angular.module('app', ['AppServices'])
		.constant('API_URL', '/cart')//define constant API_URL to be used in linking angular and laravel
		//to enable laravel request()->ajax()
		.config(['$httpProvider', function($httpProvider){
				$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
			}]); 



	app.controller('CartController', ['$http', 'API_URL', 'GlobalFactory', function($http, API_URL, GlobalFactory){

		var vm = this;


		if(location.href.indexOf('/checkout') !== -1){
			setTimeout(function(){
				vm.LoadCart();
			}, 500);
		};


		vm.LoadCart = function(){
		
			var cart = getCartCookies(); //@GlobalScript.js
			if( cart.length == 0 ){
				console.log('cant proceed to checkout! cart is empty.')
				return;
			}


			GlobalFactory.showLoadingDiv('#divtblcartloading', '#divtblcartcontent');

			$http.post('/api/cart', {cart: cart})
            .then(function(response){

                console.log(response);
                var data = response.data.data;
                vm.mscproducts = data;

                //set selectedqty
                vm.mscproducts.forEach(function(item1, index1){
                	cart.forEach(function(item2, index2){
                		if( item1.productid == item2.productid ){
                			item1.selectedqty = item2.qty;
                		}
                	});
                });

                vm.CalculateTotal();

                GlobalFactory.hideLoadingDiv('#divtblcartloading', '#divtblcartcontent');

            },function(response){

                console.log(response);

                swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                
                GlobalFactory.hideLoadingDiv('#divtblcartloading', '#divtblcartcontent');

            });//END $http

		    

		};//END LoadCart


		vm.CalculateTotal = function(){

			vm.totalamount = 0;
			vm.totalnetamount = 0;

            vm.mscproducts.forEach(function(item1, index1){
    			
    			//grossamount
    			item1.totalamount = parseFloat(item1.selectedqty) * parseFloat(item1.price);
    			
    			//discountamount
    			item1.discountamount = parseFloat(item1.totalamount) * (parseFloat(item1.discrate) / 100);
    			
    			//grossamount - discountamount
    			item1.netamount = parseFloat(item1.totalamount) - parseFloat(item1.discountamount);

    			//total
				vm.totalamount+= parseFloat(item1.totalamount);
				vm.totalnetamount += parseFloat(item1.netamount);

				//format to 2decimal places
				item1.totalamount = parseFloat(item1.totalamount).toFixed(2);
    			item1.discountamount = parseFloat(item1.discountamount).toFixed(2);
    			item1.netamount = parseFloat(item1.netamount).toFixed(2);

            });

            //format to 2decimal places
            vm.totalamount = parseFloat(vm.totalamount).toFixed(2);
            vm.totalnetamount = parseFloat(vm.totalnetamount).toFixed(2);

            console.log(vm.mscproducts);

		};//END CalculateTotal
		


		vm.RemoveFromCart = function(list){

			vm.mscproducts.forEach(function(item1, index1){
				if( item1.productid == list.productid ){
					vm.mscproducts.splice(index1, 1);
					//remove from cookie
					removeCartCookie( list.productid ); //@GlobalScript.js
				}
			});

			vm.CalculateTotal();


		};//END RemoveFromCart



		vm.SubmitCart = function(){

			GlobalFactory.blockUICustom('#divtblcartcontent');

			$http.post('/api/save-order', {
				'cart': vm.mscproducts, 
			})
            .then(function(response){

                console.log(response);
                var data = response.data;

                if( data == 'success' ){

                	deleteAllCartCookies(); //@GlobalScript.js

                	//go to checkout success page;
					location.href = '/';

                }

                GlobalFactory.unblockUICustom('#divtblcartcontent');

            },function(response){

                console.log(response);

                swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');

                GlobalFactory.unblockUICustom('#divtblcartcontent');

            });//END $http


		};//END SubmitCart
		


		//class name
		$('#form-checkout').submit(function(e){

		  	e.preventDefault();

		 	swal({
			    title: 'Are you sure you want to continue?',
			    text: "",
			    type: 'warning',
			    showCancelButton: true,
			    focusCancel: true,
			    confirmButtonColor: '#3085d6',
			    cancelButtonColor: '#d33',
			    confirmButtonText: 'Yes'
			  }).then((result) => {

			    if (result.value) {

			      console.log('save cart logic here...');

			      //remove event handler submit, prevent recursion call of the submit
			      //$(e.currentTarget).off("submit").submit(); 
			      vm.SubmitCart();
			      
			    }

			});//END swal

		});//END add-to-cart



		vm.testAuthorize = function(){

			//7M5GSk2qP85b2zFb

			$http.post('https://apitest.authorize.net/xml/v1/request.api', {

			    "createTransactionRequest": {
			        "merchantAuthentication": {
			            "name": "4u22rHUQ", //"opic123TEST",
			            "transactionKey": "7M5GSk2qP85b2zFb"
			        },
			        //"refId": "123456",
			        "transactionRequest": {
			            "transactionType": "authCaptureTransaction",
			            "amount": "5",
			            "payment": {
			                "creditCard": {
			                    "cardNumber": "5424000000000015",
			                    "expirationDate": "2020-12",
			                    "cardCode": "999"
			                }
			            },
			            "lineItems": {
			                "lineItem": {
			                    "itemId": "1",
			                    "name": "vase",
			                    "description": "Cannes logo",
			                    "quantity": "18",
			                    "unitPrice": "45.00"
			                }
			            },
			            "tax": {
			                "amount": "4.26",
			                "name": "level2 tax name",
			                "description": "level2 tax"
			            },
			            "duty": {
			                "amount": "8.55",
			                "name": "duty name",
			                "description": "duty description"
			            },
			            "shipping": {
			                "amount": "4.26",
			                "name": "level2 tax name",
			                "description": "level2 tax"
			            },
			            "poNumber": "456654",
			            "customer": {
			                "id": "99999456654"
			            },
			            "billTo": {
			                "firstName": "Ellen",
			                "lastName": "Johnson",
			                "company": "Souveniropolis",
			                "address": "14 Main Street",
			                "city": "Pecan Springs",
			                "state": "TX",
			                "zip": "44628",
			                "country": "USA"
			            },
			            "shipTo": {
			                "firstName": "China",
			                "lastName": "Bayles",
			                "company": "Thyme for Tea",
			                "address": "12 Main Street",
			                "city": "Pecan Springs",
			                "state": "TX",
			                "zip": "44628",
			                "country": "USA"
			            },
			            "customerIP": "192.168.1.1",
			            "transactionSettings": {
			                "setting": {
			                    "settingName": "testRequest",
			                    "settingValue": "false"
			                }
			            },
			            "userFields": {
			                "userField": [
			                    {
			                        "name": "MerchantDefinedFieldName1",
			                        "value": "MerchantDefinedFieldValue1"
			                    },
			                    {
			                        "name": "favorite_color",
			                        "value": "blue"
			                    }
			                ]
			            }
			        } 
			    }
			
			})
            .then(function(response){

                console.log(response);


            },function(response){

                console.log(response);

            });//END $http


		};


	}]);//END CartController


})();//END file


