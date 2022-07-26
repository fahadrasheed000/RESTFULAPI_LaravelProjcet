<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = response()->json($validator->errors(), 422);

        throw new HttpResponseException($errors);
    }
}
