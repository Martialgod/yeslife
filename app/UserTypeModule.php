<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypeModule extends Model
{
    //
    protected $table = 'usertypemodules';
  
    public $timestamps = true;

    protected $fillable = ['fk_usertype', 'fk_permalink', 'fk_createdby', 'fk_updatedby'];

}
