var vm = new Vue({
	
	el: '#main-div',


	data: {

		pk_products: '',
		search: null,
		mscproducts: [],
		mscreviews: [],
		navlinks: {},
		meta: {}
	
	},//END data
	
	methods: {

		LoadProducts: function(url){

			var url = ( url ) ? url : '/shop-search?v='+Math.random();

			var app = this;

			app.mscproducts = []; //reinitialize

			//blockUICustom('#main-div'); //this GlobaScript.js
			showCustomizeLoading(); //@GlobalScript.js

			// Make a request for a user with a given ID
			axios.post(url, {
				'search': app.search,
			})
			.then(function (response) {

				// handle success
				var data = response.data;
				//console.log(data);

				app.navlinks = data.links;
				app.meta = data.meta;


				//on initial load result body has html contents filled in larave forloop
				//we need to empty this div and populat angular ng-repeat data
				$('#searchresultbody').html('');
				

				app.mscproducts = data.data;

				app.StringifyStars();

				//unblockUICustom('#main-div'); //@GlobalScript.js
				hideCustomizeLoading(); //@GlobalScript.js


			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                //unblockUICustom('#main-div'); //@GlobalScript.js
                hideCustomizeLoading(); //@GlobalScript.js

			});



		},//END LoadProducts


		LoadReviews: function(url){

			//console.log(url);
			var app = this;
			//console.log(app.pk_products);

			var url = ( url ) ? url : '/shop/'+this.pk_products+'/reviews?v='+Math.random();

			app.mscreviews = [];

			// Make a request for a user with a given ID
			axios.get(url)
			.then(function (response) {

				// handle success
				var data = response.data;
				//console.log(data);

				app.navlinks = data.links;
				app.meta = data.meta;

				app.mscreviews = data.data;

				app.StringifyStars();

				//unblockUICustom('#main-div'); //@GlobalScript.js
				hideCustomizeLoading(); //@GlobalScript.js

			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                //unblockUICustom('#main-div'); //@GlobalScript.js
                hideCustomizeLoading(); //@GlobalScript.js

			});


		}, //END LoadReviews


		PostReviews: function(){

			//jquery validate
			if(!$('#form-reviews').valid()){
				return;
			}

			var app = this;

			//blockUICustom('#main-div'); //this GlobaScript.js
			showCustomizeLoading(); //@GlobalScript.js

			// Make a request for a user with a given ID
			axios.post('/shop/'+app.pk_products+'/reviews', $('#form-reviews').serializeArray())
			.then(function (response) {

				// handle success
				var data = response.data;
				//console.log(data);

				app.navlinks = data.links;
				app.meta = data.meta;

				app.mscreviews = data.data;

				app.StringifyStars();

				//unblockUICustom('#main-div'); //@GlobalScript.js
				hideCustomizeLoading(); //@GlobalScript.js
				$('#comments').val('');

				swal('Success', 'Your review has been posted!','success');

			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                //unblockUICustom('#main-div'); //@GlobalScript.js
                hideCustomizeLoading(); //@GlobalScript.js

			});




		}, //END PostReviews


		AddToCart: function(){

			//console.log(e);
			var tempproducts = [];
			var temp = $('#form-addcart').serializeArray();
			temp.forEach(function(item1,index1){
			    tempproducts[ item1.name ] = item1.value;
			});
			console.log(tempproducts);
			//return;

			addCartCookie(tempproducts);

		}, //END AddToCart


		SearchProducts: _.debounce(function(){

			//@customjs/AppServices.js
			this.LoadProducts(); // default search. no url

		}, 500), //END SearchProducts 


		StringifyStars: function(){

			//format stars
			this.mscproducts.forEach(function(item1, index1){
				item1.stars_string = '';
				for( var x = 1; x<=item1.ratings; x++ ){
					item1.stars_string += '<i class="fa fa-star"></i>';
				}
			});

		},

	

	},//END methods


	//cached 
	computed: {


	},//END computed


	watch: {

		//input search
	    search: function() {
	      this.SearchProducts();
	    }

	}, //END watch



	//when all elements are ready and mounted
	mounted: function(){
		this.pk_products = $('#productid').val();
		var app = this;
		//once productid is ready then its time to LoadReviews()
		setTimeout(function(){
			//blockUICustom('#main-div'); //this GlobaScript.js
			showCustomizeLoading(); //@GlobalScript.js
			app.LoadReviews();
		}, 500); 
	},//END mounted

	//fetch api data here
	created: function(){

	},//END created


})//END Vue

