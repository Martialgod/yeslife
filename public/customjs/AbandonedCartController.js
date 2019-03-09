(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/abandonedcart')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('AbandonedCartController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.customers = [];

		vm.SendMail = function(){
		

			//@customjs/AppServices.js
			GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory

			vm.executioncounter = 0;

			//one tenant per request to minimize server load
			//loop throug by using recursive function 
			var submitemail = function(){

				$http.post('/admin/abandonedcart/broadcast', { 

					'customers': vm.customers[vm.executioncounter],

				}).then(function(response){

					//success
					var data = response.data;
					console.log(data);

					var userid = vm.customers[vm.executioncounter].userid;

					$('#'+userid+'stat').html('Sent..');

					vm.executioncounter++; //increment counter


					if( vm.executioncounter < vm.customers.length ){	

						setTimeout(function(){
							submitemail();//recall submitemail for other accounts
						}, 1000); //prevent spamming

						

					}else{

						//all have been submitted

						GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

						//reload fist page
						location.href = '/admin/abandonedcart';
						return;

						
					}//END vm.executioncounter < vm.customers.length 


				},function(response){

					//error
	            	swal('Opps!', 'Something went wrong!', 'error');
					console.log(response.data);

	            	//@customjs/AppServices.js
					GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

				});//END $http

			};//END submitemail


			submitemail();//recursive function; ends after all accounts have been submitted
			

		};//END SendMail



		$('#form-broadcast').submit(function(e){

			e.preventDefault();

			var formdata  = $('#form-broadcast').serializeArray();
			//console.log(formdata);

			//convert to readable array
			vm.customers = [];


			formdata.forEach(function(item1,index1){

				//@the blade. userid are prefix with users_ to exclude non user elements
				if( item1.name.indexOf('users_') !== -1 ){

					tempid = item1.name.replace('users_', ''), //remove prefix users_
					vm.customers.push({
						'userid': tempid, 
						'email': item1.value,
						'fullname': $('#fullname'+tempid).val()
					});


				}

			});//END formdata

			//console.log(vm.customers);

			if( vm.customers.length > 0 ){
				vm.SendMail();
			}else{
				swal('Opps!', 'No more customers to broadcast!', 'info');
			}

			
			//console.log( vm.customers );

		});




	}]);//END AbandonedCartController




})();//END file