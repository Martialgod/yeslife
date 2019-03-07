<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReviewMstrView extends Model
{
    //
    
    protected $table = 'vw_productsreview';

    public static function countTotalReviews($products){
    	return static::where('fk_products', $products->pk_products)->pluck('fk_users')->count();
    }


}
