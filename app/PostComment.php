<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

class PostComment extends Model
{
    //
    
	protected $table = 'postcomments';

    protected $primaryKey = 'pk_postcomments';

    public $timestamps = true;

    protected $fillable = ['fk_posts', 'name', 'email', 'comments'];

    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_posts'   =>  ['required'],
            'name'   =>  ['required'],
            'email'   =>  ['required'],
            'comments'   =>  ['required'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
 
        }else if( $form == 'update' ){ 


        }

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
            'fk_posts.required' => 'Post not found',
            'name.required' => 'Your name is required',
            'email.required' => 'Your email is required',
            'comments.required' => 'Your comments is required',
        ];
    }




}//END class
