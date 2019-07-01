var app = new Vue({
	
	el: '#app',
	
	data: {
		products: [],
		links: {},
	},//END data
	
	methods: {
		
		loadProducts: function(url){

			url = (url) ? url : '/api/products';
			
			//console.log(url);
			let app = this; //reference to the current context

			axios.get(url)
			.then(response => {
		   		//console.log(response);
		   		let data = response.data; 
		   		//loop data result; 
		   		data.data.forEach(function(item1,index1){
		   			//check for duplicate entry
		   			let isfound = false;
		   			app.products.forEach(function(item2,index2){
 						if( item1.productid == item2.productid ){
 							isfound = true;
 							return;
 						}
		   			});//END forEach products
		   			if(!isfound){
		   				app.products.push(item1);
		   			}
		   		});//END forEach data.data

		   		app.links = data.links //set url permalinks

		   		//console.log(app.products);
		   		//console.log(app.links);

		   	})
		   	.catch(error => console.log(error) );

		}, //END loadProducts

		addToCart: function(list){
			//console.log(list);
			let products = {
				'productid': list.productid,
				'qty': list.selectedqty,
			};
			addCartCookie(products); //@GlobalScript.js
		}, //END addToCart

		removeFromCart: function(list){
			removeCartCookie(list.productid); //@GlobalScript.js
		}//END removeFromCart

	},//END methods

	created: function(){
		setTimeout(this.loadProducts, 500);
	},//END mounted

})//END Vue