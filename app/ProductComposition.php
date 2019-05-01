<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;


class ProductComposition extends Model
{
    //
    
    protected $table = 'productcompositions';

    public $timestamps = true;

    protected $fillable = ['fk_products', 'fk_compositions', 'qty'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_products'=> ['required'],
            'fk_compositions'=> ['required'],
            'qty'           =>  ['required', 'numeric', 'min:0'],
        ];


        if( $form == 'store' ){

        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
 
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
            'fk_products.required' => 'Product is required',
            'fk_compositions.required' => 'Composition is required',
            'qty.required' => 'Qty is required',
            'qty.numeric' => 'Qty be numeric',
        ];
    }





    public static function getItemCompositions($id){

    	return DB::SELECT("

    		SELECT a.fk_compositions, a.qty, b.name, b.uom,  b.pictxa
			FROM productcompositions a 
			INNER JOIN products b 
			ON a.fk_compositions = b.pk_products 
			WHERE  b.stat = 1
			AND a.fk_products = '$id'
			ORDER BY b.name ASC;

    	");

    }//END getItemCompositions



}//END class

