var vm = new Vue({
	
	el: '#main-div',
	
	data: {
		pk_ordermstr: '',
		customers: [],
	
	},//END data
	
	methods: {
		

		confirmSubmit : function(){

			var app = this;

			var formdata  = $('#form-broadcast').serializeArray();
			//console.log(formdata);

			//convert to readable array
			app.customers = [];

			formdata.forEach(function(item1,index1){

				//@the blade. userid are prefix with users_ to exclude non user elements
				if( item1.name.indexOf('users_') !== -1 ){

					tempid = item1.name.replace('users_', ''), //remove prefix users_
					app.customers.push({
						'userid': tempid, 
						'email': item1.value,
						'fullname': $('#fullname'+tempid).val()
					});


				}

			});//END formdata

			//console.log(vm.customers);

			if( app.customers.length > 0 ){

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
				        app.SendMail();
				    }
				});

				
			}else{
				swal('Opps!', 'No more customers to broadcast!', 'info');
			}


		}, //END confirmSubmit

		SendMail: function(){

			var app = this;

			var executioncounter = 0;

			blockUICustom('#main-div'); //this GlobaScript.js

			//one tenant per request to minimize server load
			//loop throug by using recursive function 
			var submitemail = function(){

				// Make a request for a user with a given ID
				axios.post('/admin/orders/'+app.pk_ordermstr+'/broadcast', {
					'customers': app.customers[executioncounter],
				})
				.then(function (response) {

					// handle success
					var data = response.data;
					//console.log(data);

					var userid = app.customers[executioncounter].userid;

					$('#'+userid+'stat').html('Sent..');

					executioncounter++; //increment counter

					if( executioncounter < app.customers.length ){	

						setTimeout(function(){
							submitemail();//recall submitemail for other accounts
						}, 1000); //prevent spamming


					}else{

						//all have been submitted

						//reload fist page
						location.href = '/admin/orders/'+app.pk_ordermstr+'/broadcast';
						return;

						
					}//END vm.executioncounter < vm.customers.length 


				})
				.catch(function (error) {

					// handle error
					console.log(error);

					swal('Opps!', 'Something went wrong!', 'error');
	                unblockUICustom('#main-div'); //@GlobalScript.js

				});

			};//END submitemail


			submitemail();//recursive function; ends after all accounts have been submitted


		}, //END postSubmit


	},//END methods


	//cached 
	computed: {


	},//END computed


	//when all elements are ready and mounted
	mounted: function(){
		this.pk_ordermstr = $('#pk_ordermstr').val();
	},//END mounted


	//fetch api data here
	created: function(){

	},//END created


})//END Vue

