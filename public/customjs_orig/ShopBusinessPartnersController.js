(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/shop')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('ShopBusinessPartnersController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.search = null;
		vm.category = 'All';
		vm.sortby = 'default';
		vm.mscproducts = [];
		vm.navlinks = {};
		vm.meta = {};

		vm.LoadCategories = function(){

			$http.get('/shop-categories?v='+Math.random(), {
			}).then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				vm.msccategories = data;

				hideCustomizeLoading(); //@GlobalScript.js


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response);

			});

		}; //END LoadCategories

		vm.LoadProducts = function(url){

			//showCustomizeLoading(); //@GlobalScript.js

			var url = ( url ) ? url : '/shop-search?v='+Math.random();

			//console.log(vm.sortby);

			vm.mscproducts = [];

			$http.post(url, {
				'shoptype': 'businesspartners', //display all items not by group
				'search': vm.search,
				'category': vm.category,
				'sortby': vm.sortby,
			}).then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				vm.navlinks = data.links;
				vm.meta = data.meta;

				vm.mscproducts = data.data;


				hideCustomizeLoading(); //@GlobalScript.js


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response);

				hideCustomizeLoading(); //@GlobalScript.js

			});


		};//END LoadProducts


		vm.UpdateCart = function(type, list){

			//type = plus, minus, ''
			
			//console.log(type + list);

			list.selectedqty = ( isNaN(list.selectedqty) || list.selectedqty == undefined || list.selectedqty == '' ) ? 0 : list.selectedqty;

			if( type == 'plus' ){
				list.selectedqty++;
			}
			else if( type == 'minus' ){

				list.selectedqty--;

			}

			if( list.selectedqty <= 0 ){
				list.selectedqty = 0;
			}


			if( list.selectedqty > 0 ){

				var products = {
					'productid': list.productid,
					'qty': list.selectedqty,
				};

				//re initialize cart cookie to prevent double qty update in addCartCookie
				document.cookie = "yeslifecart_"+products.productid+"=0; path=/";

				addCartCookie(products); //@GlobalScript.js

			}else{

				removeCartCookie( list.productid ); //@GlobalScript.js

			}
	

		}; //END UpdateCart



		vm.SearchProducts = function(){
			//showCustomizeLoading(); //@GlobalScript.js
			showCustomizeLoadingNoIcon(); //@GlobalScript.js
			vm.mscproducts = []; //reinitialize
			vm.LoadProducts(); // default search. no url

		};//END RemoveFromCart

	
		//showCustomizeLoading(); //@GlobalScript.js
		showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){

			vm.LoadProducts(); //default load

			setTimeout(function(){
				vm.LoadCategories(); //default load
			},500);//END setTimeout


		},500);//END setTimeout

		


	}]);//END ShopController




})();//END file