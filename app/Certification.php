<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Validation\Rule;

use Validator;


class Certification extends Model
{
    //
    	
    protected $table = 'certificatemstr';
    protected $primaryKey = 'pk_certificatemstr';

    public $timestamps = true;

    protected $fillable = ['fk_products', 'description', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [

        ];


        if( $form == 'store' ){
           
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
           
        ];
    }



}//END class
