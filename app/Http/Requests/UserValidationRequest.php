<?php


namespace App\Http\Requests;


use App\Rules\UserEditableFields;

class UserValidationRequest extends BaseValidationRequest
{
    public function rules()
    {
        return [
            '*' => new UserEditableFields(),
        ];



    }

}