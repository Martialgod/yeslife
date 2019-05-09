(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/products')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('ProductCompositionsController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.search = null;

		vm.pk_products = $('#pk_products').val();

		vm.searchitems = [];

		vm.compositions = [];

		//@customjs/AppServices.js
		GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory


		setTimeout(function(){

			$http.get('/admin/products/'+vm.pk_products+'/compositions?'+Math.random()).then(function(response){
				
				//success
				//console.log(response.data);

				var data = response.data;

				vm.searchitems = data.searchitems;

				vm.compositions = data.compositions;

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			});


		},1000);//END setTimeout



		vm.Search = function(){

			vm.searchitems = [];


			//@customjs/AppServices.js
			GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory


			$http.get('/admin/products/'+vm.pk_products+'/compositions-search'+"?search="+vm.search, {}).then(function(response){
				//success

				//console.log(response.data);

				var data = response.data;

				vm.searchitems  = data;

				//console.log(vm.searchitems);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


			},function(response){
				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			});


		};//END Search



		//type = price or qty
		vm.isNumber = function(list, type){

			//validate if input is valid number; else initialize as zero

			switch(type){

				case 'qty':

					if( isNaN(list.qty) ){
						list.qty = 1;
					}

					if( parseFloat(list.qty) <= 0  ){
						list.qty = 1;
					}

					//convert to number to propery compute runningbalance @index
					list.qty = parseFloat(list.qty);
				
				
				break;

				default:

			}//END switch

		

		}//END isNumber


		vm.RemoveCompositions = function(list){

			//console.log(list);

			vm.compositions.forEach(function(item1, index1){

				if( list.fk_compositions == item1.fk_compositions ){

					vm.compositions.splice(index1, 1);

				}

			});

		};//END RemoveCompositions



		vm.AddCompositions = function(list){

			//console.log(list);

			var isfound = false;

			vm.compositions.forEach(function(item1, index1){

				if( list.pk_products == item1.fk_compositions ){

					item1.qty = parseFloat(item1.qty) + 1; //increment qty

					isfound = true;

				}

			});

			if( !isfound ){

				vm.compositions.push({
					'fk_compositions': list.pk_products,
					'qty': 1,
					'name': list.name,
					'pictxa': list.pictxa
				});

			}

		};//END AddCompositions




		vm.SubmitCompositions = function(){

			//@customjs/AppServices.js
			GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory

			$http.post('/admin/products/'+vm.pk_products+'/compositions', {
				compositions: vm.compositions
			}).then(function(response){
				//success

				//console.log(response.data);

				var data = response.data;

				//console.log(response);
				swal('Success!', 'Product compositions updated!', 'success');


				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			},function(response){
				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);
				
				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
			});




		}; //END SubmitCompositions



	}]);//END ProductCompositionsController




})();//END file