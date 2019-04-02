<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //responsible for DB



class PostMstrView extends Model
{
    //
    
    protected $table = 'vw_postmstr';
    protected $primaryKey = 'pk_posts';


}//END class
