<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempImageValidationRequest extends BaseValidationRequest
{
	
	public function rules()
	{
		return [
			'temp_id' => 'required|exists:posts,id',
			'images' => 'required|array',
			'images.*' => 'image|mimes:jpeg,png,jpg',
		];
	}
}