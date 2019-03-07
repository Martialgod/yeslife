<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDOErr extends Model
{
    //

	//$error = array of pdo exceptions
	public static function checkException($error){

		$err = [];

		switch($error[0]){

			case 23000:

				$err = ['Cannot delete or update a parent row: a foreign key constraint fails'];

			break;

			default:

				$err = ['Undefined Server Error!', 'Please try again.'];

		}

		return $err;


	}

}
