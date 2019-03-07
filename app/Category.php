<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class Category extends Model
{
    //
    
    protected $table = 'category';
    protected $primaryKey = 'pk_category';

    public $timestamps = true;

    protected $fillable = ['description', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'description'   =>  ['required','max:25'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
            array_push($common_rule['description'], 'unique:category');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['description'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('category')->ignore($request->pk_category,'pk_category')
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
            'description.required' => 'Description is required',
        ];
    }


    public static function getActiveCategory(){
    	$category = Category::where('stat', '1')->orderBy('description', 'ASC')->get();
    	return $category;
    }



}
