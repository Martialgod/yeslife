<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

class State extends Model
{
    //
            
    protected $table = 'states';
    protected $primaryKey = 'pk_states';

    public $timestamps = true;

    protected $fillable = ['fk_country', 'name', 'code', 'taxrate', 'fk_createdby', 'fk_updatedby', 'stat'];

    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_country'   =>  ['required'],
            'name'   =>  ['required','max:255'],
            'code'   =>  ['required','max:15'],
            'taxrate'  =>  ['required','numeric', 'min:0', 'max:100'],
        ];


        if( $form == 'store' ){
            //must be unique in the table
          	
        	//manual checking for uniquenes since states table has two uniquie column

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
        	'fk_country.required' => 'Country is required',
            'name.required' => 'State is required',
            'code.required' => 'Code is required',
            'taxrate.required' => 'Taxrate is required',
        ];
    }



    public static function getStateByCountry($fk_country = null){

        return static::where('fk_country', $fk_country)->orderBy('name', 'ASC')->get();

    }

    //state can't be found in the database. user must have encoded the state manually
    public static function isCustomState($state = null){
        
        return ( static::where('name', ucfirst($state))->first() ) ? false : true;

    }


    /*
        format state
        we have two kind of states, statesdropdown and statescustom
        1. statesdropdown are stored in the db 
        2. statescustom are manual encode if ever the user state can't be found in the db
    */
    public static function formatState($request){

        
        $request['billingstate'] = ( $request->billingstatesdropdown ) ?  $request->billingstatesdropdown : null;

        if( $request->billingcantfindstate && $request->billingcantfindstate == 'on' ){
            
            $request['billingstate'] = ( $request->billingstatescustom ) ? $request->billingstatescustom : null;

        }

        $request['shippingstate'] = ( $request->shippingstatesdropdown ) ? $request->shippingstatesdropdown : null;

        if( $request->shippingcantfindstate && $request->shippingcantfindstate == 'on' ){
            
            $request['shippingstate'] = ( $request->shippingstatescustom ) ? $request->shippingstatescustom : null;

        }

        return $request;


    }//END formatState

 
}
