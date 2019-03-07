<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\Services\SocialGoogleAccountService;


class SocialAuthGoogleController extends Controller
{
   
    /**
       * Create a redirect method to facebook api.
       *
       * @return void
       */
    public function redirect()
    {
        
        return Socialite::driver('google')->redirect();


    }//END redirect

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialGoogleAccountService $service)
    {
        try {
           
            //dd( Socialite::driver('google')->user() );
        
            $user = $service->createOrGetUser(Socialite::driver('google')->user());

            auth()->login($user);
            return redirect()->to('/');
            

        } catch (\Exception $e) {
            //Here you can write excepion Handling Logic
            return redirect('/');
        }

       
    }//END callback
    
}//END class
