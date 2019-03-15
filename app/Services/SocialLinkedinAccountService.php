<?php

namespace App\Services;
use App\SocialLoginAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

use App\MyHelperClass;

class SocialLinkedinAccountService
{
    //ProvderUser = laravel socialite contracts provider
    public function createOrGetUser(ProviderUser $providerUser)
    {
           

        $account = SocialLoginAccount::where('provider', 'linkedin')
            ->where('provider_user_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user; //relationship to user table
        } else {

            $account = new SocialLoginAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'linkedin'
            ]);

            $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
                
             
                $user = User::create([
                    'fk_usertype'=> 1008, //Normal User. Default User Access
                    'uname'=> $providerUser->getEmail(),
                    'fname'=> $providerUser->user['given_name'],
                    'lname'=> $providerUser->user['family_name'],
                    'fullname'=>  $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'password'=> 'test', //default password
                    'fk_country'=> 229, //USA default,
                    'state'=> 'Alabama', //default state from db,
                    'city'=> 'Alabama',
                    'shippingcountry'=>  229, //USA default,
                    'shippingstate'=> 'Alabama', //default state from db,
                    'activation_token'=> null, //email automatically activated
                    'fk_referredby'=> session('yeslife_referrer_id'), //initialize @App/Providers/AppServiceProvider.php
                    'issubscribed'=> 1,
                    'istext'=> 1,
                    'stat'=> 1
                ]);
                    
                $token = MyHelperClass::generateRandomString(10).''.$user->id;
                $user->update([
                    'affiliate_token'=> $token,
                    'password'=> bcrypt($token), //default password
                ]);
                
            }//END if !$user
    
    
            //setup relationship to SocialLoginAccount
            $account->user()->associate($user);
            $account->save();

            return $user;
            
        }//END else $account
        
    }//END createOrGetUser
    
    
}//END class