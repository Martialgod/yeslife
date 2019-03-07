<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRallypay extends Model
{
    //
    
    protected $table = 'usersrallypay';

    protected $primaryKey = 'rallypayid';


    public $timestamps = true;

    protected $fillable = ['fk_users', 'rallyuid', 'rallyemail', 'rallytrxamount', 'rallytrxcurrency',  'rallytrxemail', 'rallytrxid', 'rallytrxpaytoken', 'rallytrxnumber' ];



}//END class
