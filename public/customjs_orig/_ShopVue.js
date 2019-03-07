var vm = new Vue({
	
	el: '#main-div',

	data: {

		search: null,
		mscproducts: [],
		navlinks: {},
		meta: {}
	
	},//END data
	
	methods: {
		

		LoadProducts: function(url){

			var url = ( url ) ? url : '/shop-search?v='+Math.random();

			var app = this;

			app.mscproducts = []; //reinitialize

			blockUICustom('#main-div'); //this GlobaScript.js

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

				app.mscproducts = data.data;

				app.StringifyStars();

				//unblockUICustom('#main-div'); //@GlobalScript.js
				hideCustomizeLoading('#products-div'); //@GlobalScript.js

			})
			.catch(function (error) {

				// handle error
				console.log(error);

				swal('Opps!', 'Something went wrong!', 'error');
                //unblockUICustom('#main-div'); //@GlobalScript.js
                hideCustomizeLoading('#products-div'); //@GlobalScript.js
                
			});



		},//END LoadProducts


		AddToCart: function(list){
			//console.log(list);
			var products = {
				'productid': list.productid,
				'qty': list.selectedqty,
			};
			addCartCookie(products); //@GlobalScript.js

		},//END AddToCart


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

	},//END mounted

	//fetch api data here
	created: function(){
		var app = this;
		//fetch api data upon initial load. called in created since no html element needed to LoadProducts()
		setTimeout(function(){
			app.LoadProducts();
		}, 500); 
	},//END created


})//END Vue

