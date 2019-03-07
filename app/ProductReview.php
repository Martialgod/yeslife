<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

class ProductReview extends Model
{
    //
    
    protected $table = 'productsreview';

    public $timestamps = true;

    protected $fillable = ['fk_products', 'fk_users', 'star', 'comments'];

    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_products'   =>  ['required'],
            'fk_users'   =>  ['required'],
            'star'   =>  ['required', 'numeric'],
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
            'fk_users.required' => 'You must be logged in to post reviews',
            'fk_products.required' => 'Product not found',
            'star.required' => 'Your rating is required',
            'comments.required' => 'Your review is required',
        ];
    }



}
