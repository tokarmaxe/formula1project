<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageValidationRequest extends BaseValidationRequest
{

    public function rules()
    {
    	if(  !$this->route()->uri('api/image_thumb')) {
		    return [
			    'post_id' => 'required|exists:posts,id',
			    'images' => 'required|array',
			    'images.*' => 'image|mimes:jpeg,png,jpg',
		    ];
	    }
	    else{
		    return [
			    'images' => 'required|array',
			    'images.*' => 'image|mimes:jpeg,png,jpg',
		    ];
    		
	    }
    }
}
