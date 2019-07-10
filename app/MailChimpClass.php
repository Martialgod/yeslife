<?php

namespace App;

class MailChimpClass{

	public $list_id;
    public $api_key;


	public function __construct(){

		$this->list_id = env('MAILCHIMP_LIST_ID');
		$this->api_key = env('MAILCHIMP_APIKEY');

	}

	public function storeSubscriber($obj){


        $data_center = substr($this->api_key,strpos($this->api_key,'-')+1);

        //dd($this->api_key);

        $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $this->list_id .'/members/';

        //dd($url);

        //$obj['email'] = 'vvvbv@gmail.com';

        $json = json_encode([
           'email_address'  => $obj['email'],
           'merge_fields'   => [
                'FNAME'     => $obj['fname'],
                'LNAME'     => $obj['lname'],
            ],   
           'status'         => 'subscribed', //pass 'subscribed' or 'pending'
        ]);

        //dd($json);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        dd($result);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $status_code.'<br>';


	}//END storeSubscriber




    public function storeOrder($ordermstr, $orderdtls){


        $data_center = substr($this->api_key,strpos($this->api_key,'-')+1);

        //dd($this->api_key);

        $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/ecommerce/stores/'. $this->list_id .'/orders/';

        $lines = [];
        foreach($orderdtls as $key=> $v){
            $lines[] = [
                'id'=> $ordermstr->trxno,
                'product_id'=> $v->fk_products,
                'product_variant_id'=> $v->fk_productgroup,
                'quantity'=> $v->qty,
                'price'=> $v->unitprice,
                'discount'=> $v->coupondisc
            ];
        }

        $json = json_encode([
            'id'=> $ordermstr->trxno,
            'customer'   => [
                'id'=> $ordermstr->fk_users,
                'email_address'=> $ordermstr->email
            ],  
            'currency_code'=> 'USD',
            'order_total'=> $ordermstr->netamount, 
            'order_url'=> url('/admin/orders/'.$ordermstr->pk_ordermstr.'/edit'),
            'discount_total'=> $ordermstr->totalcoupon,
            'tax_total'=> $ordermstr->totaltax,
            'shipping_total'=> $ordermstr->totalshipcost,
            'shipping_address'=> [
                'name'=> $ordermstr->shippingfname.' '.$ordermstr->shippinglname,
                'address1'=> $ordermstr->shippingaddress1,
                'address2'=> $ordermstr->shippingaddress2,
                'city'=> $ordermstr->shippingcity,
                'province'=> $ordermstr->shippingstate,
                'postal_code'=> $ordermstr->shippingzip,
                'country'=> $ordermstr->shippingcountryname,
                'phone'=> $ordermstr->shippingphone,
            ],
            'billing_address'=> [
                'name'=> $ordermstr->billingfname.' '.$ordermstr->billinglname,
                'address1'=> $ordermstr->billingaddress1,
                'address2'=> $ordermstr->billingaddress2,
                'city'=> $ordermstr->billingcity,
                'province'=> $ordermstr->billingstate,
                'postal_code'=> $ordermstr->billingzip,
                'country'=> $ordermstr->billingcountryname,
                'phone'=> $ordermstr->billingphone,
            ],
            'lines'=> $lines
        ]);

        dd($json);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        dd($result);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo $status_code.'<br>';


    }//END storeOrder



}//END class