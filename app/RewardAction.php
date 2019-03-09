<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

class RewardAction extends Model
{
    //
    
    protected $table = 'rewardactions';
    protected $primaryKey = 'pk_rewardactions';

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'points', 'fk_createdby', 'fk_updatedby', 'stat'];

    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'   =>  ['required','max:255'],
            'points'  =>  ['required','numeric', 'min:0'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
          	
        	//products must be unique in the table
            array_push($common_rule['name'], 'unique:rewardactions');

        }else if( $form == 'update' ){ 

     	 	//ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('rewardactions')->ignore($request->pk_rewardactions,'pk_rewardactions')
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
            'name.required' => 'Action name is required',
            'name.unique' => 'Action name already exist',
            'points.required' => 'Point value is required',
            'points.numeric' => 'Point value must be numeric',
        ];
    }



    public static function getManualAction(){
        return static::where('pk_rewardactions', 1005)
            ->where('stat', 1)
            ->first();
    }

}//END class
