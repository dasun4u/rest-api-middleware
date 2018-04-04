<?php

namespace App\Rules;

use App\Application;
use Illuminate\Contracts\Validation\Rule;

class BasicKey implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $decode_string = base64_decode($value);
        $consumer_array = explode(":",$decode_string);
        $consumer_key = isset($consumer_array[0])?$consumer_array[0]:"";
        $consumer_secret = isset($consumer_array[1])?$consumer_array[1]:"";
        if($consumer_key!="" && $consumer_secret!=""){
            return true;
        } else{
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The basic key is invalid.';
    }
}
