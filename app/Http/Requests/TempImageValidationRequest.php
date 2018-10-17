<?php


namespace App\Http\Requests;


class TempImageValidationRequest extends BaseValidationRequest
{
	public function rules()
	{
		return [
			'images' => 'required|array',
			'images.*' => 'image|mimes:jpeg,png,jpg',
		];
	}
	
}