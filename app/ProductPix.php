<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPix extends Model
{
    //
    
    protected $table = 'productspix';

    public $timestamps = false;

    protected $fillable = ['fk_products', 'pictx'];

}
