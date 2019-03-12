<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Validation\Rule;

use Validator;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_usertype', 'title', 'uname', 'fname', 'lname', 'fullname', 'birthdate', 'phone', 'email', 'activation_token', 'password', 'website', 'companyname', 'vatid', 'address1', 'address2', 'city', 'state', 'zip', 'fk_country', 'shippingfname', 'shippinglname', 'shippingphone', 'shippingaddress1', 'shippingaddress2', 'shippingcity', 'shippingstate', 'shippingzip', 'shippingcountry', 'affiliate_token', 'fk_referredby', 'fk_createdby', 'fk_updatedby', 'issubscribed', 'istext', 'stat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //Placed in model, will also be used in signup module
    /**
        - $form = 'store', 'update'
    */
    public static function custom_validation($request, $form){
  
        $common_rule = [
            'fk_usertype' =>  ['required'],
            'uname'     =>  ['required'],
            'fname'     =>  ['required', 'max:255'],
            'lname'     =>  ['required', 'max:255'],
            'fullname'  =>  ['max:500'],
            'birthdate' =>  ['date'],
            'phone'     =>  ['max:255'],
            'email'     =>  ['required', 'max:191'],
            'password'  =>  [],
            'website'   =>  ['max:255'],
            'address1'  =>  ['max:500'],
            'address2'  =>  ['max:500'],
            'city'      =>  ['required', 'max:255'],
            'state'     =>  ['required', 'max:255'],
            'zip'       =>  ['max:50'],
            'fk_country'    =>  ['required'],
       
        ];



        if( $form == 'store' ){
            //uname must be unique in the users table
            array_push($common_rule['uname'], 'unique:users');
            array_push($common_rule['email'], 'unique:users');
            array_push($common_rule['password'], 'required' );
            array_push($common_rule['password'], 'confirmed' );

        }else if( $form == 'update' || $form == 'profile' ){ 

            //check if on update user has changed the password
            if( $request->password || $request->password_confirmation ){
                array_push($common_rule['password'], 'required' );
                array_push($common_rule['password'], 'confirmed' );
            }

            //when updating profile, the route does not accept the user id of the object, instead it is using the default Auth::id
            $id = ( $request->id ) ? $request->id : Auth::id();

            //ignore unique rule for the current updated record
            array_push($common_rule['uname'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('users')->ignore($id,'id')
            );

            //ignore unique rule
            array_push($common_rule['email'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('users')->ignore($id,'id')
            );

          
        }

        /*
            format state
            we have two kind of states, statesdropdown and statescustom
            1. statesdropdown are stored in the db 
            2. statescustom are manual encode if ever the user state can't be found in the db
        */
       
        $request['state'] = ( $request->statesdropdown ) ? $request->statesdropdown : null;

        if( $request->cantfindstate && $request->cantfindstate == 'on' ){
            
            $request['state'] = ( $request->statescustom ) ? $request->statescustom : null;

        }

        $request['issubscribed'] = ( $request->issubscribed && $request->issubscribed == 'on' ) ? 1 : 0;

        $request['istext'] = ( $request->istext && $request->istext == 'on' ) ? 1 : 0;


        //dd($common_rule);

        //validate the form
        $validator = Validator::make( $request->all(), $common_rule, User::messages() );

        if( $validator->fails() ){
            return $validator;
        }

        return true;
    }


    //custome validation error messages
    public static function messages(){
        return [
            'fk_usertype.required' => 'User Type is required',
            'uname.required' => 'Username is required',
            'uname.max'=> 'Username max character is 15',
            'uname.unique'=> 'Username already exists',
            'fname.required' => 'Firstname is required',
            'lname.required' => 'Lastname is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'state.required'=> 'State is required',
            'fk_country.required'=> 'Country is required'
        ];
    }


    /**
        retrive user mainMenu
    */
    public static function getMainMenu($user_id = -1){
        return DB::select("call usp_getMainMenu($user_id);");
    }


    /**
        retrieve user subMenu
    */
    public static function getSubMenu($user_id = -1, $menu_group){
        return DB::select("call usp_getSubMenu($user_id, '$menu_group');");
    }//END getSubMenu


    /**
        check user has access
    */
    public static function isUserHasAccess($module){
        
        $user_id = Auth::id();
        //$module = 1000;
        
        $has_access = DB::select("SELECT udf_isUserHasAccess($user_id, $module) as result ");
        //dd($has_access[0]);
        //module not found or module found but its access is equals to zero
        if( count($has_access) == 0 || $has_access[0]->result == 0 ){
            return false;
        }

        return true;

    }//END isUserHasAccess


    public static function fullname($fk_users){

        $user = static::where('id', $fk_users)->first();
        if($user){
            return $user->fullname;
        }else{
            return '';
        }

    }//END fullname


    //pass a request object
    public static function getReferrer($request){

        return static::where('affiliate_token', $request->refno)->first();

    }//END getReferrer



}//END class
