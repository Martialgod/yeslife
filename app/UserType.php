<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB


class UserType extends Model
{
    //
    
    protected $table = 'usertype';
    protected $primaryKey = 'pk_usertype';

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'fk_createdby', 'fk_updatedby', 'stat'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required','max:15'],
            'description'   =>  ['required','max:255'],
        ];


        if( $form == 'store' ){
            //products must be unique in the table
            array_push($common_rule['name'], 'unique:usertype');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('usertype')->ignore($request->pk_usertype,'pk_usertype')
            );

        }

        //dd($common_rule);

        //validate the form
        $validator = Validator::make( $request->all(), $common_rule, static::messages() );

        if( $validator->fails() ){
            return $validator;
        }

        return true;
    }


    //custom validation error messages
    public static function messages(){
        return [
            'name.required' => 'name is required',
            'description.required' => 'Description is required',
        ];
    }


    public static function getActiveUserType(){
    	return static::where('stat', 1)->orderBy('name', 'ASC')->get();
    }


    

}
