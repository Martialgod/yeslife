<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //responsible for DB



class PostMstrView extends Model
{
    //
    
    protected $table = 'vw_postmstr';
    protected $primaryKey = 'pk_posts';


    public static function recentPosts($type = 'Blog', $pk_posts = null){

        return static::where('type', $type)
                ->where('stat', 'Posted')
                ->where('pk_posts', '<>', $pk_posts)
                ->orderBy('sourcedate', 'DESC')
                ->limit(3)
                ->get();

    }//END recentPosts


    //cursor iterator
    public static function cursor($type = 'Blog', $posts){

    	$rows = DB::SELECT("
    		SELECT * FROM vw_postmstr 
    		WHERE type = '$type'
    		AND sourcedate = '$posts->sourcedate'	
    		AND stat = 'Posted';
    	");

    	//dd($rows);

    	//only one record in the specified date
    	if( count($rows) == 1 ){

    		//first record equals to previous record based on condition
    		$prev = DB::SELECT("
    			SELECT * FROM vw_postmstr 
	    		WHERE type = '$type'
	    		AND sourcedate > '$posts->sourcedate' 
	    		AND stat = 'Posted'
	    		ORDER BY sourcedate ASC
	    		LIMIT 1;
    		");


    		$prev = count($prev) > 0 ? $prev[0] : null;

    		$next = DB::SELECT("
    			SELECT * FROM vw_postmstr 
	    		WHERE type = '$type'
	    		AND sourcedate < '$posts->sourcedate' 
	    		AND stat = 'Posted'
	    		ORDER BY sourcedate DESC
	    		LIMIT 1;
    		");

    		//dd($next);

    		$next = count($next) > 0 ? $next[0] : null;

    	}else{

    		//check for multiple records in the specified date
    		$i = 0;
    		$currentcursor = 0;
    		foreach($rows as $key=> $v){

    			if( $posts->pk_posts == $v->pk_posts ){

    				$currentcursor = $i;
    				break;

    			}
    			$i++;

    		}

    		//If there is a record in the previous/next array position, get ID from array
			//If not, get ID from record with next/previous date

    		if( ($currentcursor-1) >=0 ){

		        $prev = $rows[$currentcursor - 1];    

		    } else { 

	    		$prev = static::prev($type, $posts);
		   
		    }//END ($currentcursor-1) >=0


		    if( count($rows) > ($currentcursor + 1) ){

		        $next = $rows[$currentcursor + 1]; 

		    } else { 

		        //next
	    		$next = static::next($type, $posts);

		    }//END count($rows) > ($currentcursor + 1)


    	}//END count($rows) == 1

    	return ['prev'=> $prev, 'next'=> $next];



    }//END cursor


   
    public static function prev($type = 'Blog', $posts){

    	$prev = DB::SELECT("
			SELECT * FROM vw_postmstr 
    		WHERE type = '$type'
    		AND sourcedate > '$posts->sourcedate' 
    		AND stat = 'Posted'
    		ORDER BY sourcedate ASC
    		LIMIT 1;
		");

		$prev = count($prev) > 0 ? $prev[0] : null;

		return $prev;

    }//END prev


    public static function next($type = 'Blog', $posts){

		$next = DB::SELECT("
			SELECT * FROM vw_postmstr 
    		WHERE type = '$type'
    		AND sourcedate < '$posts->sourcedate' 
    		AND stat = 'Posted'
    		ORDER BY sourcedate  DESC
    		LIMIT 1;
		");

		$next = count($next) > 0 ? $next[0] : null;

		return $next;

    }//END next


}//END class
