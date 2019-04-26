(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/mail')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('ProductDetailsController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.pk_products = $('#productid').val();

		vm.search = null;
		vm.mscproducts = [];
		vm.currentproduct = {};
		vm.selectedflavor = vm.pk_products;
		vm.mscflavors = [];
		vm.mscreviews = [];
		vm.totalreviews = 0;
		vm.navlinks = {};
		vm.meta = {};


		vm.ShowProduct = function(id){


			var id = ( id ) ? id : vm.pk_products;

	
			showCustomizeLoadingNoIcon(); //@GlobalScript.js

			$http.get('/apishowproduct/'+id)
			.then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				//console.log(data);
				
				if( data != 'not found' ){

					vm.currentproduct = data.products;
					vm.mscflavors = data.flavors;

					vm.totalreviews = data.totalreviews;

					vm.StringifyStars();

					vm.LoadReviews();


				}else{

					vm.currentproduct = {};

				}
			
				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			});

		};//END ShowProduct


		vm.StringifyStars = function(){

			//format stars
	
			vm.currentproduct.stars_string = '';
			for( var x = 1; x<=vm.currentproduct.ratings; x++ ){
				vm.currentproduct.stars_string += '<i class="fa fa-star"></i>';
			}
		

		};



		vm.AddToCart = function(list){
			//console.log(list);
			var products = {
				'productid': list.pk_products,
				'qty': 1,
			};
			addCartCookie(products); //@GlobalScript.js

		};//END AddToCart

		vm.GlobalBuyNow = function(list){

			GlobalBuyNow(list.pk_products,1); //@GlobalScript.js

		};//END GlobalBuyNow



		vm.LoadReviews = function(url){

			//console.log(url);

			var url = ( url ) ? url : '/shop/'+vm.selectedflavor+'/reviews?v='+Math.random();

			vm.mscreviews = [];

			$http.get(url).then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				vm.navlinks = data.links;
				vm.meta = data.meta;

				vm.mscreviews = data.data;

				vm.StringifyStars();
				
				//@customjs/AppServices.js
				//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
				//hideCustomizeLoading(); //@GlobalScript.js


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
				//hideCustomizeLoading(); //@GlobalScript.js

			});


		};//END LoadReviews



		vm.PostReviews = function($event){

			$event.preventDefault();

			//jquery validate
			if(!$('#form-reviews').valid()){
				return;
			}

			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			showCustomizeLoading(); //@GlobalScript.js

			$http.post('/shop/'+vm.pk_products+'/reviews', $('#form-reviews').serializeArray() )
            .then(function(response){

                //console.log(response);
                var data = response.data;
                //console.log(data);

                vm.navlinks = data.links;
				vm.meta = data.meta;

				vm.mscreviews = data.data;

				vm.StringifyStars();

                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

                $('#comments').val('');

                //$('#totalreviewcount').html( parseFloat($('#totalreviewcount').html().trim())+1 );

                swal('Success', 'Your review has been posted!','success');

            },function(response){

                console.log(response);

                //swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                swal('Opps!', 'Errors found! <br> Please see logs', 'error');
                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            });//END $http


		};//END PostReviews


		vm.SearchProducts = function(url){

			var url = ( url ) ? url : '/shop-search';

			//@customjs/AppServices.js
			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			//showCustomizeLoading(); //@GlobalScript.js
			showCustomizeLoadingNoIcon(); //@GlobalScript.js
			vm.mscproducts = []; //reinitialize

			$http.post(url, {
				'search': vm.search
			}).then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				//on initial load result body has html contents filled in larave forloop
				//we need to empty this div and populat angular ng-repeat data
				$('#searchresultbody').html('');
				
				vm.mscproducts = data.data;

				
				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			});

		};//END RemoveFromCart


		//showCustomizeLoading(); //@GlobalScript.js
		showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){

			//@customjs/AppServices.js
			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			//vm.LoadReviews(); //default load
			vm.ShowProduct(); //default load

		},500);//END setTimeout



	}]);//END ShopController




})();//END file