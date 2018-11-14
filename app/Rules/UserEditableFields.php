<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class UserEditableFields implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $field)
    {
      //  dd(Config::get('services.user_editable_fields'));
       // dd($attribute);
        if (!in_array($attribute, Config::get('services.user_editable_fields'))) {
            return false;
        }
        return true;

    }

    public function message()
    {
        return 'You hafe fields not allowed to update....';
    }
}
