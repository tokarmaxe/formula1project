<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class CommentValidationRequest extends BaseValidationRequest
{
    public function rules()
    {
        return [
            'user_id'=>'required|exists:users,id',
            'post_id'=>'required|exists:posts,id',
            'text'=>'required',
        ];
    }
}
