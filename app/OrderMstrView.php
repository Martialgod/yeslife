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

    }//END ordersummary_date


    //10 = Free Sample product
    public static function isfirsttimer_freesample($email, $productid){

    	$result = DB::SELECT("
    		SELECT a.pk_ordermstr
    		FROM ordermstr a 
    		INNER JOIN orderdtls b 
    		ON a.pk_ordermstr = b.fk_ordermstr 
    		INNER JOIN users c 
    		ON a.fk_users = c.id
    		INNER JOIN products d 
    		ON b.fk_products = d.pk_products
    		WHERE c.email = '$email'
    		AND b.fk_products = '$productid'
    		AND d.fk_productgroup = 10
    	");

    	if( count($result) > 0 ){
    		return 'no'; //not a first timer
    	}
    	return 'yes'; //yes a first timer

    }//END isfirsttimer_freesample


    public static function isfirsttime_buyer($email){

        //10 = FREE Sample! Product Group
        $result = DB::SELECT("
            SELECT a.pk_ordermstr
            FROM ordermstr a 
            INNER JOIN orderdtls b 
            ON a.pk_ordermstr = b.fk_ordermstr 
            INNER JOIN users c 
            ON a.fk_users = c.id
            INNER JOIN products d 
            ON b.fk_products = d.pk_products
            WHERE c.email = '$email'
            AND d.fk_productgroup <> 10
            AND a.stat = 1
        ");

        //return $result;

        if( count($result) > 1 ){
            return 0;
        }
        return 1;

    }//END isfirsttime_buyer


    public static function isfreesample_buyer($email){

        //10 = FREE Sample! Product Group
        
        $result1 = DB::SELECT("
            SELECT a.pk_ordermstr
            FROM ordermstr a 
            INNER JOIN orderdtls b 
            ON a.pk_ordermstr = b.fk_ordermstr 
            INNER JOIN users c 
            ON a.fk_users = c.id
            INNER JOIN products d 
            ON b.fk_products = d.pk_products
            WHERE c.email = '$email'
            AND d.fk_productgroup <> 10
            AND a.stat = 1
        ");

        $result2 = DB::SELECT("
            SELECT a.pk_ordermstr
            FROM ordermstr a 
            INNER JOIN orderdtls b 
            ON a.pk_ordermstr = b.fk_ordermstr 
            INNER JOIN users c 
            ON a.fk_users = c.id
            INNER JOIN products d 
            ON b.fk_products = d.pk_products
            WHERE c.email = '$email'
            AND d.fk_productgroup = 10
            AND a.stat = 1
        ");

        if( count($result1) == 0 && count($result2) >= 1 ){
            return 1;
        }
        return 0;

    }//END isfreesample_buyer

    

}
