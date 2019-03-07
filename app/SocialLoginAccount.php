<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLoginAccount extends Model
{
    //
    protected $table = 'social_login_accounts';
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];
    
    //relationship to user table
    //SocialFacebookAccount->user()->associate($user);
    public function user()
    {
      return $this->belongsTo(User::class);
    }
 
    
}//END class
