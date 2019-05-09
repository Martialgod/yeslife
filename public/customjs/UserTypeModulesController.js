(function(){

	var app = angular.module('app', ['AppServices'])
			.constant('API_URL', '/admin/usertype')//define constant API_URL to be used in linking angular and laravel
			//to enable laravel request()->ajax()
			.config(['$httpProvider', function($httpProvider){
					$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
				}]); 


	app.controller('UserTypeModulesController', ['$http', '$compile', '$scope', 'API_URL', 'SQLSTATEFactory', 'GlobalFactory', function($http, $compile, $scope, API_URL, SQLSTATEFactory, GlobalFactory){

		var vm = this;


		//initialize modules
		vm.modules = [];

		var pk_usertype = $('#pk_usertype').val().trim();

		//@customjs/AppServices.js
		GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory
	
 
		setTimeout(function(){

			$http.get('/admin/usertype/'+pk_usertype+'/modules?'+Math.random()).then(function(response){
				
				//success
				//console.log(response.data);

				var data = response.data;

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


				if( typeof data === 'object' && Object.keys(data).length > 0 ){

					//arrange our parent module A
					data.A.forEach(function(item1, index1){

						vm.modules.push(item1);

						//initialize selected modules
						vm.modules[ vm.modules.length-1 ].selected = ( item1.fk_usertype != null ) ? true : false;


						//make dashboard by defaul selected and disabled
						if( item1.pk_permalink == '1000' ){
							vm.modules[ vm.modules.length-1 ].selected = true;
							vm.modules[ vm.modules.length-1 ].isdefault = true;

						}

						vm.modules[ vm.modules.length-1 ].tips = '';

						//arrange our sub module B
						data.B.forEach(function(item2, index2){
							//ex: item1.family = "Products" / "Users" parent module
							//ex: item2.family = "Products" / "Users"
							//A & B are in the same family
							if( item1.family == item2.family ){

								vm.modules.push(item2);

								vm.modules[ vm.modules.length-1 ].indent = '&nbsp;&nbsp;&nbsp;&nbsp;';

								vm.modules[ vm.modules.length-1 ].selected = ( item2.fk_usertype != null ) ? true : false;

								vm.modules[ vm.modules.length-1 ].tips = "Required ** [ "+ item1.description +" ]";

								//arrange third module C
								data.C.forEach(function(item3, index3){
									//ex: item2.route = 'products.create' parent module
									//ex: item3.route = "products.create"
									if(item2.route == item3.family){

										vm.modules.push(item3);
										
										vm.modules[ vm.modules.length-1 ].indent = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										
										vm.modules[ vm.modules.length-1 ].tips = "Required ** [ "+ item2.description +" ]";

										vm.modules[ vm.modules.length-1 ].selected = ( item3.fk_usertype != null ) ? true : false;

									}//END 

								})//END data.C.forEach(function(item3, index3)

							}//END if item1.family == item2.family
							
						})//END data.B.forEach(function(item2, index2)


					});//END response.data.A.forEach(function(item1, index1)


				}else{

				}//END typeof data === 'object' && Object.keys(data).length > 0 

				//console.log(vm.modules);


			}, function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory

			});


		},1000);//END setTimeout


		//everytime mag click sa checkbox e call ni na function with list params & type then e uncheck ang select all na option
		//if list kay empty then ang select all / deselect ang ge click 
		vm.SelectDeselect = function(list, type){
			
			//console.log(list + ' ' + type);
			
			if( list != null ){

				//select/deselect one at a time
				//vm.isSelectAll = false;

				switch( type ){

					case 'modules':
						vm.isSelectAllModules = false;
					break;


					default:


				}//END switch

				vm.LoopSelectedModules(list);

			}

			else{
				//select/deselect all
				
				switch( type ){

					case 'modules':
						
						var stat = vm.isSelectAllModules; 

						//console.log(stat);

						vm.modules.forEach(function(item,index){

							//make dashboard by defaul selected and disabled
							if( item.pk_permalink != '1000' ){
								item.selected = stat;
							}
						
							

						});//END foreach modules


					break;

					

					default:


				}//END switch



			}//END else


		};//END SelectDeselect


		//select sub modules
		vm.LoopSelectedModules = function(list){
			
			vm.modules.forEach(function(item,index){

				//only the sub modules can be selected all;
				//parent main module is not allowed kay daghan kau og submodules, hasol pag unselect sa dli pwede sa user
				//list.type == "B". optional actions such as new delete edit view
				if( list.type == 'B' && list.route == item.family ){

					if( list.selected ){
						item.selected = true;
					}else{
						item.selected= false
					}
					
				}


			});

		};//loopSelectedModules


		vm.confirmSubmit = function(){

			var active_modules = [];

			//store selected modules
			vm.modules.forEach(function(item,index){
				if(item.selected){
					active_modules.push(item);
				}
			});//END forEach modules

			var pk_usertype = $('#pk_usertype').val().trim();

			//@customjs/AppServices.js
			GlobalFactory.blockUICustom('#main-div'); //this GlobalFactory


			$http.post('/admin/usertype/'+pk_usertype+'/modules', {
				'modules': active_modules,
			}).then(function(response){

				//success

				//console.log(response);
				swal('Success!', 'Modules updated!', 'success');

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


			},function(response){

				//error
				swal('Opps!', 'Something went wrong!', 'error');
				console.log(response.data);

				//@customjs/AppServices.js
				GlobalFactory.unblockUICustom('#main-div'); //this GlobalFactory


			});


		};//END confirmSubmit


		//layouts.ajaxsubmit.blade.php
		$('#btnAjaxSubmit').click(function(e){

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
			  })
			.then(function(result){
			    if (result.value) {
			        vm.confirmSubmit();
			    }
			});
			/*.then((result) => {
			    if (result.value) {
			    	vm.confirmSubmit();
			    }
			});//END swal*/


		});//END $('#btnAjaxSubmit').click



	}]);//END UserTypeModulesController




})();//END file