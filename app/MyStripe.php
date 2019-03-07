<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cartalyst\Stripe\Stripe;


class MyStripe extends Model
{
    //

	public $stripe;

	public function __construct(){
		$this->stripe = new Stripe(env('STRIPE_KEY'));
		$this->stripe = Stripe::make(env('STRIPE_KEY'));
	}


	public  function addProduct($request){


	    $products = ($this->stripe)->products()->create([
	        'name'=> 'test',
	        'description'=> 'test description',
	        'attributes'  => [ 'size', 'gender' ],
	        //'price'=> 13.23,

	    ]);

	  	return $products;
	  

	}

	//child of product
	public function addSKU($request){
		
		$sku = ($this->stripe)->skus()->create([
		    'product'   => 'prod_EBuKQj8BK4P1uC',
		    'price'     => 300,
		    'currency'  => 'usd',
		    'inventory' => [
		        'type'     => 'finite', //'infinite', //'finite'
		        'quantity' => 500, //null //500
		    ],
		    'attributes' => [
		    	'name'=> 'withinv',
		    ],
		    //'image'=> asset('storagelink/products/1iDuUUckctyQ1KF7U8FHyJADzi3pefXMFvE9TbiH.png')
		]);

		return $sku;
	}


	//child of product
	public function displaySKU($request){

		$params = [
			'limit'=>10, 
			'active'=>true,
			'product'=> 'prod_EBuKQj8BK4P1uC',
		];

		//$params['starting_after'] =  'sku_EBujOKSLaERkYT';

		$sku = ($this->stripe)->skus()->all($params);

		return $sku;
	}


	public function displayOrder($request){

		$order = ($this->stripe)->orders()->all();

		return $order;

	}


	public function addOrder($request){

		$order = ($this->stripe)->orders()->create([
		    'currency' => 'usd',
		    'items' => [
		        [
		            'type'   => 'sku',
		            'parent' => 'sku_ECJcxDHgFfWddm',
		        ],
		    ],
		    'shipping' => [
		        'name'    => 'Opic Flores',
		        'address' => [
		            'line1'       => '1234 Main street',
		            'city'        => 'Anytown',
		            'country'     => 'US',
		            'postal_code' => '123456',
		        ],
		    ],
		    'email' => 'opic@ros.en'
		]);

		return $order;

	}


	public function payOrder($request){

		$order = ($this->stripe)->orders()->pay('or_1DjswbBikY1dmVd1R7Wz7XpS', [
			'source'=> $request->stripeToken
		]);

		return $order;

	}



	//manual add charge
	public function addCharge($request){

	
		$charge = ($this->stripe)->charges()->create([
		    'source'=> $request->stripeToken,
		    'currency' => 'USD',
		    'amount'   => 50.49,
		    'description'=> "<a href='http://cbd.local/admin/orders' target='_blank' > View Here</a>  "
		]);

		return $charge;


	}


    
}

