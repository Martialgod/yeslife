<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\BroadCastAbandonedCart as MailBroadCastAbandonedCart;

use Illuminate\Support\Facades\DB; //responsible for DB

use App\User;
use App\UserCart;

use Mail;
use Log;

use Carbon\Carbon;


class UserAbandonedCartMstrView extends Model
{
    //
    
    protected $table = 'vw_userabandonedcart';
    protected $primaryKey = 'fk_users';


    public static function automateBroadCastAbandonedCart(){

    	$transaction = DB::transaction(function() {

    		$logfile = 'BroadCastAbandonedCart/Logs.log';

	        //Log::useDailyFiles(storage_path().'/logs/'.$logfile);
	        Log::useFiles(storage_path().'/logs/'.$logfile);
	        Log::info('Request cycle BroadCastAbandonedCart Started...');

	        //retrieve abandonedcart
	        $abandonedcart = UserAbandonedCartMstrView::where('lastnotification', null)->get();

	        $arrcustemail = []; //bcc copy

	        $interval = 1; //minute interval for the queue
	        
	        foreach($abandonedcart as $key => $v){

	            $arrcustemail[]=$v->email; //to be sent in bcc      

	            //update notification date for the cart
	            $cart = UserCart::where('fk_users', $v->fk_users)
	            ->update([
	                'notified_at'=> Carbon::now(),
	            ]); 

	            //single email for each customer
	            //convert as array based object. required in MailBroadCastAbandonedCart Template
	            /*$tempc = [
	                'email'=> $v->email,
	                'fullname'=> $v->fullname,
	                'userid'=> $v->fk_users
	            ];
	            $when = Carbon::now()->addMinutes(1);
	            Mail::to($v->email, $v->fullname)->later($when, new MailBroadCastAbandonedCart($tempc, $v)); */
	            

	        }//END foreach $ordermstr

	        $arrcustemail[] = env('MAIL_USERNAME'); //send to default email for logs

            //dd($arrcustemail);
            
            //only broadcast when there are abandonedcart in the system
            if( count($abandonedcart) > 0 ){

            	//email bcc
	            $when = Carbon::now()->addMinutes($interval); 
	            Mail::bcc($arrcustemail)->later($when, new MailBroadCastAbandonedCart());
	           
	            //set in BroadCastNewOrders
	            Log::info('broadcasting abandonedcart to ' .implode(", ", $arrcustemail));

	            $interval+= 2; //increment minute interval for the queue


            }

          
	        //set in BroadCastNewOrders
	        Log::info("Request cycle BroadCastAbandonedCart finished...");


    	});

    	return $transaction;


    }//END automateBroadCastAbandonedCart



}//END class
