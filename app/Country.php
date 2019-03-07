<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

class Country extends Model
{
    //
        
    protected $table = 'country';
    protected $primaryKey = 'pk_country';

    public $timestamps = false;

    protected $fillable = ['name', 'countrycode', 'isocode', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required','max:255'],
            'countrycode'   =>  ['required','max:15'],
            'isocode'   =>  ['required','max:15'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
            array_push($common_rule['name'], 'unique:country');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('country')->ignore($request->pk_country,'pk_country')
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
            'name.unique' => 'Name already exists',
            'countrycode.required' => 'Country Code is required',
            'isocode.required' => 'ISO Code is required',
        ];
    }


    public static function getActiveCountry(){
    	return static::where('stat',1)->orderBy('name', 'ASC')->get();
    }

}
