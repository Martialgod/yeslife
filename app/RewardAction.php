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

    protected $fillable = ['name', 'description', 'type', 'points', 'fk_createdby', 'fk_updatedby', 'stat'];

    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'name'    =>  ['required','max:255'],
            'type'    =>  ['required','max:10'],
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

         //validate type
        if( $request['type'] == 'Rated' ){

            //for Rated coupons, max amount should be 100
            array_push($common_rule['points'], 'max:100');

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
            'type.required' => 'Type is required',
            'points.required' => 'Amount is required',
            'points.numeric' => 'Amount must be numeric',
            'points.max' => 'Rated action only allows maximum points of 100',
        ];
    }



    public static function getManualAction(){
        return static::where('pk_rewardactions', 1005)
            ->where('stat', 1)
            ->first();
    }

}//END class
