<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class ProductGroup extends Model
{
    //
    

    protected $table = 'productgroup';
    protected $primaryKey = 'pk_productgroup';

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'description2', 'description3', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required','max:255']
        ];


        if( $form == 'store' ){

            //must be unique in the table
            array_push($common_rule['name'], 'unique:productgroup');

        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('productgroup')->ignore($request->pk_productgroup,'pk_productgroup')
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


    public static function getActiveProductGroup(){
    	$productgroup = ProductGroup::where('stat', '1')->orderBy('name', 'ASC')->get();
    	return $productgroup;
    }



}//END class
