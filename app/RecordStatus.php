<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordStatus extends Model
{
    //
    
    protected $table = 'recordstatus';
    protected $primaryKey = 'pk_recordstatus';


   /**
        retrieve user record status by type
    */
    public static function getRecordStatusByType($type){
       
        return static::where('type', $type)
            ->where('stat', 1)
            ->orderBy('name', 'ASC')
            ->get();

    }//END getSubMenu


    

}
