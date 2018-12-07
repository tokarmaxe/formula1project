<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlackMarketValidationRequest extends BaseValidationRequest
{
    public function rules()
    {

        return [
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'how_much' => 'required|max:70',
            'user_id' => 'required|exists:users,id',
            'currency' => 'required'
        ];
    }

}