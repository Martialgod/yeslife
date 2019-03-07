<?php

namespace App\Services;
use App\SocialLoginAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

use App\MyHelperClass;

class SocialTwitterAccountService
{
    //ProvderUser = laravel socialite contracts provider
    public function createOrGetUser(ProviderUser $providerUser)
    {
           

        $account = SocialLoginAccount::where('provider', 'twitter')
            ->where('provider_user_id', $providerUser->getId())
            ->first();

        if ($account) {

            return $account->user; //relationship to user table
        

        } else {

            $account = new SocialLoginAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'twitter'
            ]);

            $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
             
                $user = User::create([
                    'fk_usertype'=> 1008, //Normal User. Default User Access
                    'uname'=> $providerUser->getEmail(),
                    'fname'=> $providerUser->getName(),
                    'lname'=> $providerUser->getName(),
                    'fullname'=> $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'password'=> 'test', //default password
                    'fk_country'=> 229, //USA default,
                    'state'=> 'Alabama', //default state from db,
                    'city'=> 'Alabama',
                    'shippingcountry'=>  229, //USA default,
                    'shippingstate'=> 'Alabama', //default state from db,
                    'fk_referredby'=> session('yeslife_referrer_id'), //initialize @App/Providers/AppServiceProvider.php
                    'issubscribed'=> 1,
                    'stat'=> 1
                ]);
                    
                $token = MyHelperClass::generateRandomString(10).''.$user->id;
                $user->update([
                    'affiliate_token'=> $token,
                    'password'=> bcrypt($token), //default password
                ]);
                
            }elseif( !$user->fname ){

                //check for empty info then update details base on social media.
                //empty for "Special Offers for Subscription" user

                //User::update()->where('email', $account->user->email);
                $user->update([
                    'fname'=> $providerUser->getName(),
                    'lname'=> $providerUser->getName(),
                    'fullname'=>  $providerUser->getName(),
                    'issubscribed'=> 1,
                    'stat'=> 1
                ]);


            }//END if !$user
    
    
            //setup relationship to SocialLoginAccount
            $account->user()->associate($user);
            $account->save();

            return $user;
            
        }//END else $account
        
    }//END createOrGetUser
    
    
}//END class