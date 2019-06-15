<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB; //responsible for DB


use Carbon\Carbon;


use Validator;


class Post extends Model
{
    //
    
    protected $table = 'posts';
    protected $primaryKey = 'pk_posts';

    public $timestamps = true;

    protected $fillable = ['type', 'minstoread', 'slug', 'name', 'summary', 'content', 'pictx', 'sourcename', 'sourcedate', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
        	'type'   =>  ['required'],
            'minstoread' =>  ['required','numeric'],
            'slug'   =>  ['required'],
            'name'   =>  ['required'],
            'summary'   =>  ['required', 'max:255'],
            'content'   =>  ['required'],
            'pictx'        =>  [ 'image', 'mimes:jpg,jpeg,png,', 'max:1000kb' ], //500kb
            'sourcename'   =>  ['required'],
            'sourcedate'   =>  ['date'],
       
        ];


        if( $form == 'store' ){

        	//manual check for uniqueness

        }else if( $form == 'update' ){ 

        	//manual check for uniqueness
      

        }


        //format our date into timestamp; to avoid same date issues in using "prev" and "next" controls in our blog details page
        $now =  explode(' ', Carbon::now()->toDateTimeString()); //2019-04-03 01:13:32
        $request['sourcedate'] = $request['sourcedate'].' '.$now[1];


        //dd($common_rule);

        //validate the form
        $validator = Validator::make( $request->all(), $common_rule, static::messages() );

        if( $validator->fails() ){
            return $validator;
        }

        return true;
    }


    //custome validation error messages
    public static function messages(){
        return [
        	'type.required' => 'Post type is required',
            'slug.required' => 'Slug is required',
            'name.required' => 'Name is required',
            'content.required' => 'Content is required',
            'pictx.image' => 'Profile photo must be an image',
            'pictx.mimes' => 'Profile photo must be a type of jpeg,jpg,png',
            'pictx.max'=> 'Profile photo size must be under 1000kb',
        ];
    }



}//END class
