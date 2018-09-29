<?php

namespace App\Http\Requests;


class ImageValidationRequest extends BaseValidationRequest
{
	
	public function rules()
	{
		return [
			'post_id' => 'required|exists:posts,id',
			'images' => 'required|array',
			'images.*' => 'image|mimes:jpeg,png,jpg'
		];
		
	}
	
}
