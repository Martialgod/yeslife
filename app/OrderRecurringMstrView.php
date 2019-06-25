<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB; //responsible for DB

use App\OrderMstr;

use App\OrderDtlView;

use App\Mail\BroadCastRecurringOrders as MailBroadCastRecurringOrders;

use Mail;
use Log;

use Carbon\Carbon;


class OrderRecurringMstrView extends Model
{
    //
   

    protected $table = 'vw_recurringmstr';
    protected $primaryKey = 'pk_orderrecurring';


    public static function automateBroadCastRecurringOrders(){

    	$transaction = DB::transaction(function() {

    		$logfile = 'BroadCastRecurringOrders/Logs.log';

	        //Log::useDailyFiles(storage_path().'/logs/'.$logfile);
	        Log::useFiles(storage_path().'/logs/'.$logfile);
	        Log::info('Request cycle BroadCastRecurringOrders Started...');

	        //retrieve orders for approval or recurring orders for all users
	        $ordermstr = DB::SELECT("
	            SELECT a.*,
	            b.email, b.fullname
	            FROM vw_ordermstr a 
	            INNER JOIN users b 
	            ON a.fk_users = b.id 
	            WHERE a.isapproved = 0 AND a.isdeclined = 0 AND a.stat = 1
	            -- AND b.stat = 1
	        ");

	        $arrcustemail = []; //bcc copy

	        $interval = 1; //minute interval for the queue

	        foreach($ordermstr as $key => $v){

	            $pk_ordermstr = $v->pk_ordermstr;

	            $orderdtls = OrderDtlView::where('fk_ordermstr', $v->pk_ordermstr)->orderBy('indexno', 'ASC')->get();

	            //convert as array based object. required in MailBroadCastRecurringOrders Template
	            $tempc = [
	                'email'=> $v->email,
	                'fullname'=> $v->fullname,
	                'userid'=> $v->fk_users
	            ];

	            $arrcustemail [] = $v->email;

	            $when = Carbon::now()->addMinutes($interval);
	            Mail::to($v->email, $v->fullname)->later($when, new MailBroadCastRecurringOrders($v, $orderdtls, $tempc));

            		
	            $interval+= 2; //increment minute interval for the queue

	        }//END foreach $ordermstr


	        //set in BroadCastRecurringOrders
            Log::info('broadcasting recurring orders to ' .implode(", ", $arrcustemail));


	        //set in BroadCastNewOrders
	        Log::info("Request cycle BroadCastRecurringOrders finished...");


    	});

    	return $transaction;


    }//END automateBroadCastRecurringOrders



}//END class
