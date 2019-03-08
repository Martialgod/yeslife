<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB; //responsible for DB


class UserMstrView extends Model
{
    //
    protected $table = 'vw_usermstr';
    protected $primaryKey = 'id';


    public static function activeCustomers(){


    	return DB::SELECT("
			SELECT a.utype, a.id, a.fullname, a.phone, a.email, 
			CONCAT(a.address1,', ', a.city, ', ', a.state, ', ', a.zip,' ') AS `address`
			FROM vw_usermstr a 
			WHERE a.id IN ( SELECT fk_users FROM ordermstr WHERE isapproved = 1 AND isdeclined = 0 AND stat = 1 )
			AND a.id <> 1000 -- super admin
			AND a.stat = 1
			ORDER BY a.fullname;

		");

    }//END activeCustomers


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
