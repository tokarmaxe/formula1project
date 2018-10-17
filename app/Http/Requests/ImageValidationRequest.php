<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageValidationRequest extends BaseValidationRequest
{
	
	public function rules()
	{
		return [
			'post_id' => 'required|exists:posts,id',
			'images' => 'required|array',
			'images.*' => 'image|mimes:jpeg,png,jpg',
		];
	}
}

