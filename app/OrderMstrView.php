<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //responsible for DB


class OrderMstrView extends Model
{
    //
    protected $table = 'vw_ordermstr';
    protected $primaryKey = 'pk_ordermstr';



    public static function ordersummary_date($datefrom, $dateto){

    	return static::whereBetween('created_at', ["$datefrom 00:00:00", "$dateto 23:59:59"] )
			->orderBy('created_at', 'DESC')->orderBy('pk_ordermstr', 'ASC')
			->get();

    }//END orders
    

}
