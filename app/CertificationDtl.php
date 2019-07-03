<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Validation\Rule;

use Validator;


class CertificationDtl extends Model
{
    //
    
	protected $table = 'certificatedtls';
    protected $primaryKey = 'pk_certificatedtls';

    public $timestamps = false;

    protected $fillable = ['fk_certificatemstr', 'lotcode', 'pictx'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
        	'lotcode' 	   => ['required', 'max:255'],
        	'pictx'        =>  ['required', 'mimes:jpg,jpeg,png,pdf', 'max:3000kb' ], //3mb
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
        	'lotcode.required' => 'Lot Code is required',
        	'pictx.required' => 'File is required',
            'pictx.image' => 'File must be an image',
            'pictx.mimes' => 'File must be a type of jpeg,jpg,png,pdf',
            'pictx.max'=> 'File size must be under 3mb',
        ];
    }



    //$certificationids = [1,2,3,4]
    public static function getCertificatesGallery($certificationids = []){
    	return static::whereIn('fk_certificatemstr', $certificationids)->get();
    }



    public static function mapCertificateGallery($certificates = [], $gallery = []){

        $i = 0;
        foreach ($certificates as $k1 => $v1) {

 
            $certificates[$i]['gallery'] = []; //initial array
            $tempgallery = [];
            $xx = 0; //index for pricelist

            //loop gallery
            foreach($gallery as $k2 => $v2){

                if( $v1->pk_certificatemstr == $v2->fk_certificatemstr ){


                    $tempgallery[$xx++] = $v2;

                }

            }//END foreach $gallery


            $certificates[$i]['gallery'] = $tempgallery; //set actual gallery


            $i++;

        }//END foreach $certificates

        return $certificates;

    }//END mapCertificateGallery



}//END class
