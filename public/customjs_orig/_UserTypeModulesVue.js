var vm = new Vue({
	
	el: '#main-div',
	
	data: {
		modules: [],
		pk_usertype : '',
		searchmodule : '',
		isSelectAllModules: false,
	},//END data
	
	methods: {
		
		loadModules: function(){

			var app = this; //reference to the current context

			// Make a request for a user with a given ID
			axios.get('/admin/usertype/'+app.pk_usertype+'/modules?'+Math.random())
			.then(function (response) {

				// handle success
				//console.log(response);

				var data = response.data;

				if( typeof data === 'object' && Object.keys(data).length > 0 ){

					//arrange our parent module A
					data.A.forEach(function(item1, index1){

						app.modules.push(item1);

						//initialize selected modules
						app.modules[ app.modules.length-1 ].selected = ( item1.fk_usertype != null ) ? true : false;


						//make dashboard by defaul selected and disabled
						if( item1.pk_permalink == '1000' ){
							app.modules[ app.modules.length-1 ].selected = true;
							app.modules[ app.modules.length-1 ].isdefault = true;

						}

						app.modules[ app.modules.length-1 ].tips = '';

						//arrange our sub module B
						data.B.forEach(function(item2, index2){
							//ex: item1.family = "Products" / "Users" parent module
							//ex: item2.family = "Products" / "Users"
							//A & B are in the same family
							if( item1.family == item2.family ){

								app.modules.push(item2);

								app.modules[ app.modules.length-1 ].indent = '&nbsp;&nbsp;&nbsp;&nbsp;';

								app.modules[ app.modules.length-1 ].selected = ( item2.fk_usertype != null ) ? true : false;

								app.modules[ app.modules.length-1 ].tips = "Required ** [ "+ item1.description +" ]";

								//arrange third module C
								data.C.forEach(function(item3, index3){
									//ex: item2.route = 'products.create' parent module
									//ex: item3.route = "products.create"
									if(item2.route == item3.family){

										app.modules.push(item3);
										
										app.modules[ app.modules.length-1 ].indent = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										
										app.modules[ app.modules.length-1 ].tips = "Required ** [ "+ item2.description +" ]";

										app.modules[ app.modules.length-1 ].selected = ( item3.fk_usertype != null ) ? true : false;

									}//END 

								})//END data.C.forEach(function(item3, index3)

							}//END if item1.family == item2.family
							
						})//END data.B.forEach(function(item2, index2)


					});//END response.data.A.forEach(function(item1, index1)


				}else{

				}//END typeof data === 'object' && Object.keys(data).length > 0 

				//console.log(app.modules);

                unblockUICustom('#main-div'); //@GlobalScript.js

			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                unblockUICustom('#main-div'); //@GlobalScript.js

			});

		}, //END loadModules


		//everytime mag click sa checkbox e call ni na function with list params & type then e uncheck ang select all na option
		//if list kay empty then ang select all / deselect ang ge click 
		SelectDeselect: function(list, type){

			//console.log(type);
			//console.log(list);
			
			var app = this; //reference to the current context

			if( list != null ){

				//select/deselect one at a time
				//app.isSelectAll = false;

				switch( type ){

					case 'modules':
						app.isSelectAllModules = false;
					break;


					default:


				}//END switch

				app.LoopSelectedModules(list);

			}

			else{
				//select/deselect all
				
				switch( type ){

					case 'modules':
						
						var stat = app.isSelectAllModules; 

						//console.log(stat);

						app.modules.forEach(function(item,index){

							//make dashboard by defaul selected and disabled
							if( item.pk_permalink != '1000' ){
								item.selected = stat;
							}
						

						});//END foreach modules


					break;

					

					default:


				}//END switch



			}//END else

		}, //END SelectDeselect  (null, 'modules')


		//select sub modules
		LoopSelectedModules : function(list){
			
			var app = this; //reference to the current context

			//console.log(list);

			app.modules.forEach(function(item,index){

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

		}, //loopSelectedModules


		confirmSubmit : function(){

			var app = this;

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
			        app.postSubmit();
			    }
			});

		}, //END confirmSubmit

		postSubmit: function(){

			var app = this;

			var active_modules = [];

			//store selected modules
			app.modules.forEach(function(item,index){
				if(item.selected){
					active_modules.push(item);
				}
			});//END forEach modules

			blockUICustom('#main-div'); //this GlobaScript.js

			// Make a request for a user with a given ID
			axios.post('/admin/usertype/'+app.pk_usertype+'/modules?', {
				'modules': active_modules,
			})
			.then(function (response) {

				// handle success
				//console.log(response);

				swal('Success!', 'Modules updated!', 'success');

                unblockUICustom('#main-div'); //@GlobalScript.js

			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                unblockUICustom('#main-div'); //@GlobalScript.js

			});



		}, //END postSubmit


	},//END methods


	//cached 
	computed: {

		filteredModules: function() {

	    	var app = this;
		    return app.modules.filter(function(list) {
		        var regex = new RegExp('(' + app.searchmodule + ')', 'i');
		        return list.description.match(regex);
		    });
	      	
	    }

	},//END computed

	//when all elements are ready and mounted
	mounted: function(){
		this.pk_usertype = $('#pk_usertype').val();
		
		blockUICustom('#main-div'); //@GlobalScript.js
		
		var app = this;
		//once pk_usertype is ready then its time to loadModules()
		setTimeout(function(){
			app.loadModules();
		}, 500); 

	},//END mounted

	//fetch api data here
	created: function(){
		
	},//END created


})//END Vue

