<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueMobileNumber implements Rule
{
    protected $countryCodeId; 
    protected $user_id;

    public function __construct($countryCodeId,$user_id)
    {
        $this->countryCodeId = $countryCodeId;
        $this->user_id = $user_id;
    }
    public function passes($attribute, $value)
    {

    // dd($this->user_id,$this->countryCodeId);
        return !User::where('id','!=',$this->user_id)
                           ->where('mobile', $value)
                           ->where('country_code_id', $this->countryCodeId)
                           ->exists();
    }

    public function message()
    {
        return 'The mobile number is already taken';
    }
}
