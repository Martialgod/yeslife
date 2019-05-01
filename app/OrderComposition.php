<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;


class OrderComposition extends Model
{
    //
    
    protected $table = 'ordercompositions';

    public $timestamps = true;

    protected $fillable = ['fk_ordermstr', 'fk_products', 'fk_compositions', 'qty', 'uom'];



}//END class
