<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyHelperClass extends Model
{
    //
    public static function generateRandomString($length = 4) {

	    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    
	    $charactersLength = strlen($characters);
	    
	    $randomString = '';
	    
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

    	return $randomString;

	}//END generateRandomString


}
