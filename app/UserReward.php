<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB


class UserReward extends Model
{
    //


    protected $table = 'userrewards';
    protected $primaryKey = 'pk_userrewards';

    public $timestamps = true;

    protected $fillable = ['fk_users', 'fk_rewardactions', 'type', 'typeamount', 'points', 'fk_referral', 'fk_ordermstr', 'remarks', 'sysremarks', 'fk_updatedby', 'stat'];


    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_users'   =>  ['required'],
            'fk_rewardactions'   =>  ['required'],
            'points'  =>  ['required','numeric', 'min:0'],
            'remarks'   =>  ['required','max:500'],
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
            'fk_users.required' => 'Customer is required',
            'fk_rewardactions.required' => 'Action name is required',
            'points.required' => 'Point value is required',
            'points.numeric' => 'Point value must be numeric',
            'remarks.required' => 'Remarks is required',
        ];
    }



    public static function insertReferralSignupRewards(){

        //does not return anything so use DB::statement
        DB::statement("CALL usp_insertReferralSignupRewards();");

    }//END insertReferralSignupRewards

    public static function insertOwnPurchaseRewards(){

        //does not return anything so use DB::statement
        DB::statement("CALL usp_insertOwnPurchaseRewards();");

    }//END insertOwnPurchaseRewards

    public static function insertReferralPurchaseRewards(){

        //does not return anything so use DB::statement
        DB::statement("CALL usp_insertReferralPurchaseRewards();");

    }//END insertReferralPurchaseRewards


    public static function insertSinglePurchaseRewards($ordermstr){

        $action = DB::SELECT("SELECT * FROM rewardactions WHERE pk_rewardactions = '1004' AND stat = 1; ");
        
        if( count($action) > 0 ){

            UserReward::create([
                'fk_users'=> $ordermstr->fk_users,
                'fk_rewardactions'=> $action[0]->pk_rewardactions,
                'points'=> $action[0]->points,
                'fk_ordermstr'=> $ordermstr->pk_ordermstr,
                'sysremarks'=> 'system generated own purchase reward @'.$ordermstr->created_at,
                'stat'=> 1

            ]);

        }//END count($action)

    }//END insertSinglePurchaseRewards



    public static function countTotalRewardPointsPerUser($id){
      
        $totalpoints = DB::SELECT("SELECT udf_countTotalRewardPointsPerUser('$id') as totalpoints");
        $totalpoints = ( count($totalpoints) > 0 ) ? $totalpoints[0]->totalpoints : 0;
        return $totalpoints;

    }//END countTotalRewardPointsPerUser
    

}//END class
