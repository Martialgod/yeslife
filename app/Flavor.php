<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class Flavor extends Model
{
    //
    

    protected $table = 'flavors';
    protected $primaryKey = 'pk_flavors';

    public $timestamps = true;

    protected $fillable = ['name', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required','max:255']
        ];


        if( $form == 'store' ){

            //must be unique in the table
            array_push($common_rule['name'], 'unique:flavors');

        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('flavors')->ignore($request->pk_flavors,'pk_flavors')
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


    //custome validation error messages
    public static function messages(){
        return [
            'name.required' => 'Name is required',
        ];
    }


    public static function getActiveFlavors(){
    	$flavors = Flavor::where('stat', '1')->orderBy('name', 'ASC')->get();
    	return $flavors;
    }



}//END class
