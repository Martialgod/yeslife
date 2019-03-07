<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDtl extends Model
{
    //
    protected $table = 'orderdtls';

    public $timestamps = true;

    protected $fillable = ['fk_ordermstr', 'fk_products', 'qty', 'uom', 'origprice', 'unitprice', 'totalamount', 'coupondisc', 'taxamount', 'shipamount', 'netamount', 'fk_recordstatus', 'indexno', 'fk_createdby', 'fk_updatedby'];


}
