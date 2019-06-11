<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Validation\Rule;

use Validator;


class Faq extends Model
{
    //
    
    protected $table = 'faqs';
    protected $primaryKey = 'pk_faqs';

    public $timestamps = true;

    protected $fillable = ['pk_faqs', 'question', 'answer', 'indexno', 'fk_createdby', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'question'   =>  ['required','max:500'],
            'answer'   =>  ['required'],
            'indexno'       =>  ['required', 'numeric'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
            array_push($common_rule['question'], 'unique:faqs');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['question'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('faqs')->ignore($request->pk_faqs,'pk_faqs')
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
            'question.required' => 'Question is required',
            'question.unique' => 'Question aleady exists',
            'answer.required' => 'Answer is required',
        ];
    }

    
}//END class
