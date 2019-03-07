var app = new Vue({
	
	el: '#app',
	
	data: {
		products: [],
		links: {},

	},//END data
	
	methods: {
		
		loadCart: function(){

			//console.log(url);
			let app = this; //reference to the current context

			let cart = getCartCookies(); //@GlobalScript.js
			if( cart.length == 0 ){
				console.log('cant proceed to checkout! cart is empty.')
				return;
			}
			//console.log(cart);

			showLoadingDiv('#divtblcartloading', '#divtblcartcontent'); //@GlobalScript.js

			axios.post('/api/cart', {
				'cart': cart
			})
			.then(response => {
		   		console.log(response);
		   		let data = response.data; 
		   		app.products = data.data;
		   		hideLoadingDiv('#divtblcartloading', '#divtblcartcontent'); //@GlobalScript.js
		   		//set selectedqty
                app.products.forEach(function(item1, index1){
                	cart.forEach(function(item2, index2){
                		if( item1.productid == item2.productid ){
                			item1.selectedqty = item2.qty;
                		}
                	});
                });

		   		app.computeTotal;
		   	})
		   	.catch(error => console.log(error) );

		}, //END loadProducts


		removeFromCart: function(list){

			//console.log(url);
			let app = this; //reference to the current context

			app.products.forEach(function(item1, index1){
				if( item1.productid == list.productid ){
					app.products.splice(index1, 1);
					//remove from cookie
					removeCartCookie( list.productid ); //@GlobalScript.js
				}
			});

		},//END removeFromCart

		updateFromCart: function(list){

			//console.log(list);
			let products = {
				'productid': list.productid,
				'qty': list.selectedqty,
			};
			addCartCookie(products); //@GlobalScript.js
			toastr.success('Successful', list.name+' has been updated');

		},//END updateFromCart


	    validateNumber: _.debounce(function(list){
	    	
	    	console.log(list);
	    	if(isNaN(list.selectedqty) || list.selectedqty == undefined || list.selectedqty == ''){
	    		list.selectedqty=1;
	    	}

	    	this.updateFromCart(list);

	    }, 100), //END validateNumber
	    
	    showCheckout: function(){

	    	$('#divcart').hide();
	    	$('#divcheckout').show();

	    }, //end showCheckout

	    confirmCheckout: function(){

	    	//validation using jquery.validate
	    	if( !($( "#form-checkout" )).valid() ){
	    		return;
	    	}

	    	let app = this;

		 	swal({
			    title: 'Are you sure you want to continue?',
			    text: "",
			    type: 'warning',
			    showCancelButton: true,
			    focusCancel: true,
			    confirmButtonColor: '#3085d6',
			    cancelButtonColor: '#d33',
			    confirmButtonText: 'Yes'
			  }).then((result) => {

			    if (result.value) {

			    	app.submitCheckout();

			    }

			});//END swal

	    },//END confirmCheckout

	    submitCheckout: function(){

	    	blockUICustom('#divcheckout'); //@GlobalScript.js

	    	let app = this;

			axios.post('/api/save-order', {
				'cart': app.products,
				'checkout': $('#form-checkout').serializeArray()
			})
			.then(response => {

		   		console.log(response);
		   	
		   		let data = response.data; 
		   		
		   		if( data == 'success' ){

                	deleteAllCartCookies(); //@GlobalScript.js

                	//go to checkout success page;
					location.href = '/';

                }

                unblockUICustom('#divcheckout'); //@GlobalScript.js
		   	})
		   	.catch(error => console.log(error.response) );

	    },//END submitCheckout

	},//END methods

	computed: {

		computeTotal: function(){

			let totalamount = 0;
			let totalnetamount = 0;
			let app = this;

            app.products.forEach(function(item1, index1){
    			
            	if(isNaN(item1.selectedqty) || item1.selectedqty == undefined || item1.selectedqty == ''){
		    		item1.selectedqty=1;
		    	}

    			//grossamount
    			item1.totalamount = parseFloat(item1.selectedqty) * parseFloat(item1.price);
    			
    			//discountamount
    			item1.discountamount = parseFloat(item1.totalamount) * (parseFloat(item1.discrate) / 100);
    			
    			//grossamount - discountamount
    			item1.netamount = parseFloat(item1.totalamount) - parseFloat(item1.discountamount);

    			//total
				totalamount+= parseFloat(item1.totalamount);
				totalnetamount += parseFloat(item1.netamount);

				//format to 2decimal places
				item1.totalamount = parseFloat(item1.totalamount).toFixed(2);
    			item1.discountamount = parseFloat(item1.discountamount).toFixed(2);
    			item1.netamount = parseFloat(item1.netamount).toFixed(2);

            });

            //format to 2decimal places
            totalamount = parseFloat(totalamount).toFixed(2);
            totalnetamount = parseFloat(totalnetamount).toFixed(2);

            return {
            	'totalamount': totalamount,
            	'totalnetamount': totalnetamount
            };

		},

		
	
	},//END computed

	mounted: function(){
		
	},//END mounted

	created: function(){
		setTimeout(this.loadCart, 500);
	},//END created

})//END Vue


$('#isnewaccount').on('change', function(){
  	if( $('#isnewaccount').is(":checked") )
	{
	  	// it is checked
	  	$('#divbillingpassword').show();
	}
	else{
		$('#divbillingpassword').hide();
	}
});



$('#shiptodifferentaddress').on('change', function(){
  	if( $('#shiptodifferentaddress').is(":checked") )
	{
	  	// it is checked
	  	$('#divshippingaddress').show();
	}
	else{
		$('#divshippingaddress').hide();
	}
});
