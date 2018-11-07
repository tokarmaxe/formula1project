<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Image implements Rule
{

    public function __construct()
    {

    }
    public function passes($attribute, $value)
    {
        return !is_null(imagecreatefromstring(base64_decode($value)));

    }

    public function message()
    {
        return 'Not an image';
    }
}
