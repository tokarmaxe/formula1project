<?php

namespace App\Http\Requests;

use App\Rules\Base64Image;


class ImageValidationRequest extends BaseValidationRequest
{
	
	public function rules()
	{
	    return [
				'post_id' => 'required|exists:posts,id',
				'images' => 'required|array|between:0,5',
                'images.*.type' =>
                    ['in:image/png,image/jpg,image/jpeg,image/svg,image/gif'],
                'images.*.file' =>
                ['required', new Base64Image()]
			];



	}
}

