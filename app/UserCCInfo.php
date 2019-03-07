<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class UserCCInfo extends Model
{
    //

    protected $table = 'usersccinfo';

    protected $primaryKey = 'pk_usersccinfo';

    public $timestamps = true;

    protected $fillable = ['fk_users', 'cardno', 'cvc', 'exmonth', 'exyear',  'isdefault', 'stat'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_users'   =>  ['required'],
            'cardno'   =>  ['required'],
            'cvc'   =>  ['required'],
            'exmonth'   =>  ['required'],
            'exyear'   =>  ['required'],
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
            'fk_users.required' => 'You must be logged in to add cc details',
        ];
    }


    public static function getDefaultCCInfo($fk_users = null){
    	return UserCCInfo::where('fk_users', $fk_users)
            ->where('isdefault', 1)
            ->where('stat', 1)
            ->first();
    }


}//END class
