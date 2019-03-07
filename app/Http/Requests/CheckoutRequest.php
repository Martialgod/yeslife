<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billingfname'      =>  ['required'],
            'billinglname'      =>  ['required'],
            'billingaddress1'   =>  ['required'],
            //'billingaddress2'   =>  ['required'],
            //'billingcity'       =>  ['required'],
            'billingstate'      =>  ['required'],
            'billingzip'        =>  ['required'],
            'billingcountry'    =>  ['required'],
            'shippingfname'      =>  ['required'],
            'shippinglname'      =>  ['required'],
            'shippingaddress1'   =>  ['required'],
            //'billingaddress2'   =>  ['required'],
            //'billingcity'       =>  ['required'],
            'shippingstate'      =>  ['required'],
            'shippingzip'        =>  ['required'],
            'shippingcountry'    =>  ['required'],
        ];

    }


    public function messages(){
        return [
            'billingfname.required' => 'Firstname is required',
            'billinglname.required' => 'Lastname is required',
            'billingaddress1.required' => 'Address is required',
            //'billingaddress2.required' => 'Firstname is required',
            'billingstate.required' => 'State is required',
            'billingzip.required' => 'Zip is required',
            'billingcountry.required' => 'Country is required',
            'shippingfname.required' => 'Firstname is required',
            'shippinglname.required' => 'Lastname is required',
            'shippingaddress1.required' => 'Address is required',
            //'billingaddress2.required' => 'Firstname is required',
            'shippingstate.required' => 'State is required',
            'shippingzip.required' => 'Zip is required',
            'shippingcountry.required' => 'Country is required',
        ];
    }


    
}
