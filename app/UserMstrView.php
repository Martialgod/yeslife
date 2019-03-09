<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB; //responsible for DB


class UserMstrView extends Model
{
    //
    protected $table = 'vw_usermstr';
    protected $primaryKey = 'id';




    public static function downline($id){

        $downline = [];

        $downline = DB::SELECT("
            SELECT a.id, a.uname, a.fullname, a.email, 
            concat(a.state, ' ', a.city, ' ', a.zip) as address,
            DATE_FORMAT(a.created_at, '%b %d, %Y %r') as created_at , a.stat,

            ( 

                SELECT count(id) FROM users where fk_referredby = a.id

            ) as referralcount,

            ( 
            	SELECT pk_ordermstr FROM ordermstr WHERE isapproved = 1 AND isdeclined = 0 
            	AND stat = 1 AND fk_users = a.id

            ) as purchasecount

            FROM users a
            WHERE a.fk_referredby = '$id'
            ORDER BY a.created_at;
        ");

        return $downline;

    }//END retrieveDownLine



    //list of customers who purchased an order
    //a.stat is commented out since in-active customers can still purchase an item
    public static function purchaser(){


    	return DB::SELECT("
			SELECT a.utype, a.id, a.fullname, a.phone, a.email, 
			CONCAT(a.address1,', ', a.city, ', ', a.state, ', ', a.zip,' ') AS `address`
			FROM vw_usermstr a 
			WHERE a.id IN ( SELECT fk_users FROM ordermstr WHERE isapproved = 1 AND isdeclined = 0 AND stat = 1 )
			AND a.id <> 1000 -- super admin
			-- AND a.stat = 1
			ORDER BY a.fullname;

		");

    }//END purchaser


    public static function leads(){


    	return DB::SELECT("
			SELECT a.utype, a.id, a.fullname, a.phone, a.email, 
			CONCAT(a.address1,', ', a.city, ', ', a.state, ', ', a.zip,' ') AS `address`
			FROM vw_usermstr a 
			WHERE a.id NOT IN ( SELECT fk_users FROM ordermstr WHERE isapproved = 1 AND isdeclined = 0 AND stat = 1 )
			AND a.id <> 1000 -- super admin
			AND a.stat = 1
			ORDER BY a.fullname;

		");

    }//END leads


    public static function optout(){


    	return DB::SELECT("
			SELECT a.utype, a.id, a.fullname, a.phone, a.email, 
			CONCAT(a.address1,', ', a.city, ', ', a.state, ', ', a.zip,' ') AS `address`
			FROM vw_usermstr a 
			WHERE a.issubscribed = 0
			AND a.id <> 1000 -- super admin
			AND a.stat = 1
			ORDER BY a.fullname;

		");

    }//END leads

    


}//END class
