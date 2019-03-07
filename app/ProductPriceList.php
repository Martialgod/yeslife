<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPriceList extends Model
{
    //
    
    protected $table = 'productspricelist';

    public $timestamps = true;

    protected $fillable = ['fk_products', 'fk_usertype', 'price', 'discount', 'fk_createdby', 'fk_updatedby'];




}
