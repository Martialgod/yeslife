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
		vm.mscreviews = [];
		vm.navlinks = {};
		vm.meta = {};

		vm.LoadProducts = function(url){

			var url = ( url ) ? url : '/shop-search';

			//console.log(url);
			vm.mscproducts = [];

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


		};//END LoadProducts


		vm.StringifyStars = function(){

			//format stars
			vm.mscreviews.forEach(function(item1, index1){
				item1.stars_string = '';
				for( var x = 1; x<=item1.star; x++ ){
					item1.stars_string += '<i class="fa fa-star"></i>';
				}
			});

		};

		vm.LoadReviews = function(url){

			//console.log(url);

			var url = ( url ) ? url : '/shop/'+vm.pk_products+'/reviews?v='+Math.random();

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
				hideCustomizeLoading(); //@GlobalScript.js


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				//GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
				hideCustomizeLoading(); //@GlobalScript.js

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



		vm.SearchProducts = function(){

			//@customjs/AppServices.js
			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			//showCustomizeLoading(); //@GlobalScript.js
			showCustomizeLoadingNoIcon(); //@GlobalScript.js
			vm.mscproducts = []; //reinitialize
			vm.LoadProducts(); // default search. no url

		};//END RemoveFromCart

		//showCustomizeLoading(); //@GlobalScript.js
		showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){
			//@customjs/AppServices.js
			//GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
			vm.LoadReviews(); //default load
			//vm.LoadProducts();

		},500);//END setTimeout



	}]);//END ShopController




})();//END file