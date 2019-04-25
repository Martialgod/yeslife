<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;


class Product extends Model
{
    //
    

	protected $table = 'products';
    protected $primaryKey = 'pk_products';

    public $timestamps = true;

    protected $fillable = ['fk_category', 'fk_productgroup', 'fk_flavors', 'name', 'description', 'slug', 'price', 'price2', 'discount', 'taxrate', 'shippingcost', 'uom', 'alertqty', 'pictxa', 'sku', 'weight', 'length', 'width', 'height', 'options', 'videoupload', 'videoshare', 'fk_createdby', 'fk_updatedby', 'isdeleted', 'fk_deletedby', 'deleted_at', 'indexno', 'stat'];



    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_productgroup'=> ['required'],
            'name'          =>  ['required','max:255'],
            'description'   =>  ['required'],
            'slug'          =>  ['required','max:255'],
            'price'         =>  ['required','numeric', 'min:0'],
            'qty'           =>  ['required', 'numeric', 'min:0'],
            'indexno'       =>  ['required', 'numeric'],
            //'alertqty'      =>  ['required', 'numeric', 'min:0'],
            'uom'           =>  ['required', 'max:6'],
            'discount'      =>  ['required','numeric', 'min:0', 'max:100'],
            'taxrate'       =>  ['required','numeric', 'min:0', 'max:100'],
            'shippingcost'  =>  ['required','numeric', 'min:0'],
            'pictxa'        =>  ['image', 'mimes:jpg,jpeg,png,', 'max:1000kb' ], //500kb
            'gallery.*'     =>  ['image', 'mimes:jpg,jpeg,png,', 'max:1000kb' ], //500kb validate array
        ];


        if( $form == 'store' ){
            //products must be unique in the table
            array_push($common_rule['name'], 'unique:products');
            array_push($common_rule['slug'], 'unique:products');
        }else if( $form == 'update' ){ 

            //ignore unique rule for the current updated record
            array_push($common_rule['name'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('products')->ignore($request->pk_products,'pk_products')
            );

            //ignore unique rule for the current updated record
            array_push($common_rule['slug'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('products')->ignore($request->pk_products,'pk_products')
            );

        }

        //dd($common_rule);
        
        $request['fk_flavors'] = ( $request['fk_flavors'] ) ? $request['fk_flavors'] : null;

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
            'fk_productgroup.required' => 'Product group is required',
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'slug.required' => 'Slug is required',
            'price.numeric' => 'Price must be numeric',
            'discount.numeric' => 'Discount must be numeric',
            'taxrate.numeric' => 'Tax rate must be numeric',
            'shippingcost.numeric' => 'Shipping cost must be numeric',
            'qty.required' => 'Stock on hand is required',
            'qty.numeric' => 'Stock on hand must be numeric',
            //'alertqty.required' => 'Critical level is required',
            //'alertqty.numeric' => 'Critical level must be numeric',
            'uom.required' => 'Unit of measure is required',
            //'pictxa.required' => 'Cover photo is required',
            'pictxa.image' => 'Cover photo must be an image',
            'pictxa.mimes' => 'Cover photo must be a type of jpeg,jpg,png',
            'pictxa.max'=> 'Cover photo size must be under 1000kb',
            'gallery.*.image' => 'Photo Gallery must be an image',
            'gallery.*.mimes' => 'Photo Gallery must be a type of jpeg,jpg,png',
            'gallery.*.max'=> 'Photo Gallery size must be under 1000kb'
        ];
    }



    //return pk_products as concatenated string 
    //to use in query parameters as IN ()
    //will return pk_products concatenated as string
    //1000,1002,1003
    public static function getProductIDAsString($products = []){

         //NOTE: retrieve pk_products, pluck returns array with keys
        $arrID = $products->pluck('pk_products');   

        //manually convert array with keys to a normal array so that implode function will work
        $tempArr = []; $i=0;
        foreach ($arrID as $key => $value) {
            $tempArr[$i++] = $value;
        }
        $strProducts = implode(',', $tempArr); //arr to string
        //if empty string, set default to -1 to avoid sql syntax error
        $strProducts = ( $strProducts != '' ) ? $strProducts : '-1';

        return $strProducts;

    }//END getProductIDAsString



}
