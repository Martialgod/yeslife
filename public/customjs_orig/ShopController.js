(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/mail')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('ShopController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.search = null;
		vm.msccategories = [];
		vm.category = 'All';
		vm.categorydescription =  '<h4> All Categories <h4>';
		vm.sortby = 'default';
		vm.mscproducts = [];
		vm.navlinks = {};
		vm.meta = {};

		//$('#div-toolbar').prop('hidden', true);
		//$('#div-products').prop('hidden', true);

		vm.StringifyStars = function(){

			//format stars
			vm.mscproducts.forEach(function(item1, index1){
				item1.stars_string = '';
				for( var x = 1; x<=item1.ratings; x++ ){
					item1.stars_string += '<i class="fa fa-star"></i>';
				}
			});

		};

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
			
			if( vm.category == 'All' ){

				vm.categorydescription = '<h4> All Categories <h4>';

			}else{
				vm.msccategories.forEach(function(item1, index1){

					if( vm.category == item1.pk_category ){

						vm.categorydescription = '<h4>'+item1.description+'</h4>'+item1.description2;

					}

				}); 

			}//END vm.category != 'All'
			
			/*//list view
			//remove active grid class and set default view as list
			$('#btn-view-mode-grid').removeClass('active');
			$('#btn-view-mode-list').removeClass('active'); //prevent duplicate 
			$('#btn-view-mode-list').addClass('active');

			$('#div-products').removeClass('grid');
			$('#div-products').removeClass('list'); //prevent duplicate 
			$('#div-products').addClass('list');

			$('#div-product-item').removeClass('list'); //prevent duplicate 
			$('#div-product-item').addClass('list'); */

			//grid view
			//remove active list class and set default view as grid
			$('#btn-view-mode-list').removeClass('active');
			$('#btn-view-mode-grid').removeClass('active'); //prevent duplicate 
			$('#btn-view-mode-grid').addClass('active');

			$('#div-products').removeClass('list');
			$('#div-products').removeClass('grid'); //prevent duplicate 
			$('#div-products').addClass('grid');

			$('#div-product-item').removeClass('grid'); //prevent duplicate 
			$('#div-product-item').addClass('grid');


			//console.log(url);
			vm.mscproducts = [];
			//$('#div-toolbar').prop('hidden', true);
			//$('#div-products').prop('hidden', true);

			$http.post(url, {
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

				vm.StringifyStars();

				//console.log(vm.mscproducts);
				
				/*data.data.forEach(function(item1, index1){

					//check for duplicate entry
		   			var isfound = false;
		   			vm.mscproducts.forEach(function(item2,index2){
 						if( item1.productid == item2.productid ){
 							isfound = true;
 							return;
 						}
		   			});//END forEach products
		   			if(!isfound){
		   				vm.mscproducts.push(item1);
		   			}

				});//END data.forEach

				*/

				//@customjs/AppServices.js
				//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
				hideCustomizeLoading(); //@GlobalScript.js
				//$('#div-toolbar').prop('hidden', false);
				//$('#div-products').prop('hidden', false);


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response);

				//@customjs/AppServices.js
				//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
				hideCustomizeLoading(); //@GlobalScript.js
				//$('#div-toolbar').prop('hidden', false);
				//$('#div-products').prop('hidden', false);

			});


		};//END LoadProducts


		vm.AddToCart = function(list){
			//console.log(list);
			var products = {
				'productid': list.productid,
				'qty': list.selectedqty,
			};
			addCartCookie(products); //@GlobalScript.js

		};//END AddToCart

		vm.GlobalBuyNow = function(list){

			GlobalBuyNow(list.productid,1); //@GlobalScript.js

		};//END GlobalBuyNow


		vm.RemoveFromCart = function(list){

			//remove from cookie
			removeCartCookie( list.productid ); //@GlobalScript.js


		};//END RemoveFromCart



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