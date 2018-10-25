<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageValidationRequest extends BaseValidationRequest
{
	
	public function rules()
	{
			return [
				'post_id' => 'required|exists:posts,id',
				'images' => 'required',
                'images.*.type' =>
                    ['in:image/png,image/jpg,image/jpeg,image/svg,image/gif'],
                'images.*.file' =>
                ['required']
			];



	}
}

