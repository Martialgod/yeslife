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




}//END class