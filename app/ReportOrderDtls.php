<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportOrderDtls extends Model
{
    //
    
	protected $table = 'vw_rporderdtls';
    protected $primaryKey = 'pk_ordermstr';


    public static function orderdtls_date($datefrom, $dateto){

    	return static::whereBetween('created_at', ["$datefrom 00:00:00", "$dateto 23:59:59"] )
			->orderBy('billingfullname', 'DESC')
			->get();

    }//END orders

}//END class
