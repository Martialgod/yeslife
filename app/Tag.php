<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\DB; //responsible for DB

class Tag extends Model
{
    //
    protected $table = 'tags';
    protected $primaryKey = 'pk_tags';

    public $timestamps = true;

    protected $fillable = ['name', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required', 'max:255'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
            array_push($common_rule['name'], 'unique:tags');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('tags')->ignore($request->pk_tags,'pk_tags')
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
            'name.required' => 'Tag name is required',
            'name.unique' => 'Tag name already exists',
        ];
    }


    public static function getActiveTags(){
    	$tags = static::where('stat', '1')->orderBy('name', 'ASC')->get();
    	return $tags;
    }

    
}//END class
