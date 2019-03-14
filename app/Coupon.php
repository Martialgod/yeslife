<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\DB; //responsible for DB

use Carbon\Carbon;


use Illuminate\Support\Facades\Auth; //responsible for our authentication 


class Coupon extends Model
{
    //
    
    protected $table = 'coupons';
    protected $primaryKey = 'pk_coupons';

    public $timestamps = true;

    protected $fillable = ['code', 'name', 'description', 'type', 'amount', 'effective_at', 'expired_at', 'applies_to', 'max_use', 'fk_createdby', 'fk_updatedby', 'stat'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
        	'name'   		=>  ['required','max:255'],
            'description'   =>  ['required','max:255'],
            'type'   		=>  ['required','max:10'],
            'amount'   		=>  ['required','numeric'],
            'effective_at'	=>  ['nullable', 'date'],
            'expired_at'	=>  ['nullable', 'date'],
            'max_use'       =>  ['required','numeric'],
        ];


        if( $form == 'store' ){

            //must be unique in the table
            array_push($common_rule['name'], 'unique:coupons');

        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('coupons')->ignore($request->pk_coupons,'pk_coupons')
            );

        }

        //validate type
        if( $request['type'] == 'Rated' ){

        	//for Rated coupons, max amount should be 100
            array_push($common_rule['amount'], 'max:100');

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
            'description.required' => 'Description is required',
            'type.required' => 'Type is required',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be numeric',
            'amount.max' => 'Rated coupons only allows maximum amount of 100',
            'max_use.required' => 'Number of use must be numeric',
            'max_use.numeric' => 'Number of use is required',
        ];
    
    }//END messages



    public static function getActiveCoupon($code = null, $userid = 0){

        $now = Carbon::now();

        //return $now;
        //return $userid;
        //$userid = '1015';

        $now = date_format( date_create($now) , 'Y-m-d H:i:s' );

        //return $now;

        return DB::SELECT("CALL usp_getActiveCoupon('$now', '$code', $userid)");

    }//END getActiveCoupon
    



}
