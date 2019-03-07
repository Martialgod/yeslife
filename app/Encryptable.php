<?php

namespace App;

use Illuminate\Support\Facades\Crypt;

/**
 *
 * 
    class Patient extends Model
    {
        use Encryptable;

        protected $encryptable = [
            'blood_type',
            'medical_conditions',
            'allergies',
            'emergency_contact_id',
        ];
    }
 * 
 */

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            $value = Crypt::decrypt($value);
            return $value;
        }

        return;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
}