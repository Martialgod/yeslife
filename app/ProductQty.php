<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQty extends Model
{
    //
    

	protected $table = 'productsqty';

    public $timestamps = true;

    protected $fillable = ['fk_products', 'qty', 'oldqty', 'fk_updatedby'];

}
