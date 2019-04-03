<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\DB; //responsible for DB

class PostTag extends Model
{
    //
    
    protected $table = 'posttags';
    protected $primaryKey = 'fk_posts';

    public $timestamps = true;

    protected $fillable = ['fk_posts', 'fk_tags', 'fk_createdby', 'fk_updatedby', 'stat'];


    //retrieve selected tags and miscelaneous tags
    public static function getActiveTags($fk_posts){

    	return DB::SELECT("
    		SELECT a.pk_tags, a.name, IF( b.fk_tags is not null, 'selected', '' ) as 'selected'
    		FROM tags a 
    		LEFT JOIN posttags b 
    		ON a.pk_tags = b.fk_tags AND b.fk_posts = '$fk_posts'
    		WHERE a.stat = 1;
    	");

    }


}//END class
