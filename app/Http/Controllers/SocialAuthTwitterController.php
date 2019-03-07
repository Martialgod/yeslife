<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\Services\SocialTwitterAccountService;


class SocialAuthTwitterController extends Controller
{
    //
    
	/**
       * Create a redirect method to facebook api.
       *
       * @return void
       */
    public function redirect()
    {
        
        return Socialite::driver('twitter')->redirect();


    }//END redirect

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialTwitterAccountService $service)
    {
     	
     	try {
	       
     		//dd( Socialite::driver('twitter')->user() );
        
	        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());

	        auth()->login($user);
	        return redirect()->to('/');

	    } catch (\Exception $e) {
	        //Here you can write excepion Handling Logic
	        return redirect('/');
	    }
        
        
       
    }//END callback

}//END class
