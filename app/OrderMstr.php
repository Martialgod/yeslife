<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB


class OrderMstr extends Model
{
    //
    
    protected $table = 'ordermstr';
    protected $primaryKey = 'pk_ordermstr';

    public $timestamps = true;

    protected $fillable = ['trxno', 'fk_usersccinfo', 'rallypayid', 'fk_users', 'remarks', 'totalitem', 'totalamount', 'totalcoupon', 'totaltax', 'totalshipcost', 'netamount', 'billingfname', 'billinglname', 'billingphone', 'billingaddress1', 'billingaddress2', 'billingcity', 'billingstate', 'billingzip', 'billingcountry', 'shippingfname', 'shippinglname', 'shippingphone', 'shippingaddress1', 'shippingaddress2', 'shippingcity', 'shippingstate', 'shippingzip', 'shippingcountry', 'fk_createdby', 'fk_updatedby', 'isopen', 'isapproved', 'isdeclined', 'declined_at', 'stat'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_users'      	=>  ['required','numeric'],
            //'fk_usersccinfo'    =>  ['required','numeric'],
            'totalitem'     	=>  ['required','numeric'],
            'totalamount'   	=>  ['required','numeric'],
            'netamount'     	=>  ['required','numeric'],
            
            'billingfname'  	=>  ['required','max:255'],
            'billinglname'  	=>  ['required','max:255'],
            'billingphone' 	 	=>  ['required','max:255'],
            'billingcountry'  	=>  ['required'],
            'billingstate'  	=>  ['required','max:255'],
            'billingcity'  		=>  ['required','max:255'],
            'billingaddress1'  	=>  ['required','max:500'],

            'shippingfname'  	=>  ['required','max:255'],
            'shippinglname'  	=>  ['required','max:255'],
            'shippingphone'  	=>  ['required','max:255'],
            'shippingcountry'  	=>  ['required'],
            'shippingstate'  	=>  ['required','max:255'],
            'shippingcity'  	=>  ['required','max:255'],
            'shippingaddress1'  =>  ['required','max:500'],
            

        ];


        if( $form == 'store' ){
       
        }else if( $form == 'update' ){ 

          

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
            'fk_users.required'=> 'User id is required',
            //'fk_usersccinfo.required'=> 'Card Details is required',
        ];
    }//END messages



    public static function isUnApproveRecurring($fk_recurring = null, $fk_users = null){
        return  static::where('trxno', $fk_recurring)
                ->where('isapproved', 0)
                ->where('stat', 1)
                ->where('fk_recurring', '<>', null)
                //->where('fk_users', $fk_users)
                ->first();
    }//END isUnApproveRecurring



    public static function insertRecurringOrders(){
        //does not return anything so use DB::statement
        DB::statement("CALL usp_insertRecurringOrders();");
    }

}//END class
