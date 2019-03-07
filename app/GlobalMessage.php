<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model
{
    //
    //
 	protected $table = 'globalmessage';
    protected $primaryKey = 'pk_globalmessage';

    //public $timestamps = false;

    protected $fillable = ['header', 'content', 'footer'];

 
}

