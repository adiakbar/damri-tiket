<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function messages()
    {
    	return [
    		'required' => 'Wajib di isi'
    	];
    }
}
