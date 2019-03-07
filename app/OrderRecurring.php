<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class OrderRecurring extends Model
{
    //
    
    protected $table = 'orderrecurring';
    protected $primaryKey = 'pk_orderrecurring';

    public $timestamps = true;

    protected $fillable = ['fk_users', 'fk_ordermstr', 'startdate', 'enddate', 'intervalno', 'intervalunit', 'remarks', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_users'   =>  ['required'],
            'fk_ordermstr'   =>  ['required', 'numeric'],
            'intervalno'   =>  ['required', 'numeric'],
            'intervalunit'   =>  ['required',],
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
