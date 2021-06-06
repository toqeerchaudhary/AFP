<?php

namespace App\Http\Requests\Purchaser;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'password' => 'nullable|min:6',
           'img' => 'nullable|mimes:jpeg,png,jpg'
        ];
    }
}
