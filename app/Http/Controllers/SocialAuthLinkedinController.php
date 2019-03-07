<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\Services\SocialLinkedinAccountService;

class SocialAuthLinkedinController extends Controller
{
    //
    
    /**
       * Create a redirect method to facebook api.
       *
       * @return void
       */
    public function redirect()
    {
        
        return Socialite::driver('linkedin')->redirect();


    }//END redirect

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialLinkedinAccountService $service)
    {
        
        try {
           
            //get the driver and set desired fields
            $driver = Socialite::driver('linkedin');

                
            dd($driver->user());
            $user = $service->createOrGetUser($driver->user());
                
            //dd(Socialite::driver('facebook')->user());
            //$user = $service->createOrGetUser(Socialite::driver('linkedin')->user());


            auth()->login($user);
            return redirect()->to('/');
            

        } catch (\Exception $e) {
            //Here you can write excepion Handling Logic
            return redirect('/');
        }

     
       
    }//END callback


}//END class
