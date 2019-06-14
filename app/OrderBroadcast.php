<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\BroadCastNewOrders as MailBroadCastNewOrders;

use Illuminate\Support\Facades\DB; //responsible for DB

use Mail;
use Log;

use Carbon\Carbon;



class OrderBroadcast extends Model
{
    //
    protected $table = 'orderbroadcast';

    public $timestamps = true;

    protected $fillable = ['fk_users', 'fk_ordermstr', 'fk_createdby', 'fk_updatedby'];


    public static function getUnbroadcastUsersPerOrder($ordermstr){
    	
    	$unbroadcastusers = DB::table('users')
	    	->select('users.id', 'users.fullname', 'users.email')
	    	->whereNotIn('id',function($query) use ($ordermstr){
	       		$query->select('fk_users')
	       			->from('orderbroadcast')
	       			->where('fk_ordermstr', $ordermstr->pk_ordermstr);
	    	})
	    	->where('users.stat', 1)
	    	->where('users.issubscribed', 1)
	    	->where('users.id', '<>', 1000) //do not include Super Administrator
	    	->where('users.id', '<>', $ordermstr->fk_users) //do not include the owner of the order
	    	->orderBy('fullname', 'ASC')
	    	->paginate(10); //10

	   return $unbroadcastusers;
   
    }//END getUnbroadcastUsersPerOrder




    public static function automateBroadCastNewOrders(){

    	$transaction = DB::transaction(function() {

    		$logfile = 'BroadCastNewOrders/Logs.log';

	        //Log::useDailyFiles(storage_path().'/logs/'.$logfile);
	        Log::useFiles(storage_path().'/logs/'.$logfile);
	        Log::info('Request cycle BroadCastNewOrders Started...');
	        

	        //retrieve orders not broadcasted yet
	        $ordermstr = DB::SELECT("
	            SELECT a.pk_ordermstr, a.trxno, a.fk_users, a.billingfname, a.billinglname,
	            a.billingstate, 
	            udf_getOrderedProductName(a.pk_ordermstr) AS products
	            FROM ordermstr a 
	            WHERE a.isapproved = 1 AND a.stat = 1
	            AND ( a.pk_ordermstr NOT IN ( SELECT fk_ordermstr FROM orderbroadcast ) )
	            LIMIT 1
	        ");

	        $interval = 1; //interval for the queue

	        foreach($ordermstr as $key => $v){

	            $pk_ordermstr = $v->pk_ordermstr;

	            $orderdtls = DB::SELECT("
	                SELECT fk_ordermstr, fk_products, name, slug
	                FROM vw_orderdtls WHERE fk_ordermstr = '$pk_ordermstr' 
	                ORDER BY indexno ASC
	            ");

	            //php max execution time limit is 180 seconds
	            $customers = DB::SELECT("
	                SELECT a.id, a.email, a.fullname
	                FROM users a 
	                WHERE a.stat = 1 AND a.issubscribed = 1;
	            ");

	            $arrcustemail = []; //bcc copy

	            foreach($customers as $key=>$c){

	                $broadcast = OrderBroadcast::create([
	                    'fk_users'=> $c->id,
	                    'fk_ordermstr'=> $v->pk_ordermstr,
	                ]);

	                $arrcustemail[]=$c->email; //to be sent in bcc       
	            }

	            $arrcustemail[] = env('MAIL_USERNAME'); //send to default email for logs

	            //dd($arrcustemail);

	            //email bcc
	            $when = Carbon::now()->addMinutes($interval); 
	            Mail::bcc($arrcustemail)->later($when, new MailBroadCastNewOrders($v, $orderdtls));
				
			
	            //set in BroadCastNewOrders
	            Log::info('broadcasting order no. '. $v->pk_ordermstr . ' to ' .implode(", ", $arrcustemail));
	      		
	            $interval+= 2; //increment minute interval for the queue

	            //commented out at the bottom

	        }//END foreach $ordermstr

	        //set in BroadCastNewOrders
	        Log::info("Request cycle BroadCastNewOrders finished...");


    	});

    	return $transaction;


    }//END automateBroadCastNewOrders

    

}//END class



/*

//sleep(1);

//email individually
/*foreach($customers as $ckey => $c){


    $broadcast = OrderBroadcast::create([
        'fk_users'=> $c->id,
        'fk_ordermstr'=> $v->pk_ordermstr,
    ]);

    //convert as array based object. required in MailBroadCastNewOrders Template
    $tempc = [
        'email'=> $c->email,
        'fullname'=> $c->fullname,
        'userid'=> $c->id
    ];

    $when = Carbon::now()->addMinutes(1);
    
    Mail::to($c->email, $c->fullname)->later($when, new MailBroadCastNewOrders($v, $orderdtls, $tempc));

    //set in BroadCastNewOrders
    Log::info('broadcasting order no. '. $v->pk_ordermstr . ' to ' .$c->email);

    //displayed in the command line
    $this->info('broadcasting order no. '. $v->pk_ordermstr . ' to ' .$c->email);

    //sleep can cause double logging 
    sleep(1);

}//END foreach $customers

*/
