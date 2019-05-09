(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/mail')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('BlogDetailsController', ['$http', 'SQLSTATEFactory', 'API_URL', 'GlobalFactory', function($http, SQLSTATEFactory, API_URL, GlobalFactory ){

		var vm = this;

		vm.pk_posts = $('#postid').val();

		vm.search = null;
		vm.mscreviews = [];
		vm.navlinks = {};
		vm.meta = {};


		vm.LoadReviews = function(url){

			//console.log(url);

			var url = ( url ) ? url : '/blog/'+vm.pk_posts+'/reviews?v='+Math.random();

			vm.mscreviews = [];

			$http.get(url).then(function(response){
				
				//success
				//console.log(response);

				var data = response.data;

				vm.navlinks = data.links;
				vm.meta = data.meta;

				vm.mscreviews = data.data;

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

			$http.post('/blog/'+vm.pk_posts+'/reviews', $('#form-reviews').serializeArray() )
            .then(function(response){

                console.log(response);
                var data = response.data;
                //console.log(data);

                vm.navlinks = data.links;
				vm.meta = data.meta;

				vm.mscreviews = data.data;

                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

                $('#comments').val('');

                swal('Success', 'Your comment has been posted!','success');

            },function(response){

                console.log(response);

                //swal('Opps!', 'Something went wrong!<br> please see log for details', 'error');
                swal('Opps!', 'Errors found! <br> Please see logs', 'error');
                //GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory
                hideCustomizeLoading(); //@GlobalScript.js

            });//END $http


		};//END PostReviews


		//showCustomizeLoading(); //@GlobalScript.js
		showCustomizeLoadingNoIcon(); //@GlobalScript.js
		setTimeout(function(){

			vm.LoadReviews(); //default load


		},500);//END setTimeout



	}]);//END ShopController




})();//END file