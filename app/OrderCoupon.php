<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCoupon extends Model
{
    //
    
    protected $table = 'ordercoupons';

    public $timestamps = true;

    protected $fillable = ['fk_ordermstr', 'fk_users', 'fk_coupons', 'type', 'amount'];

}
