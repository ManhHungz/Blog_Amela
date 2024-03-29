<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'max:255',
            'dob' => 'required|date_format:Y-m-d|before:today',
            'gender' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'address' => 'regex:/([- ,\/0-9a-zA-Z]+)/',
            'image' => 'max:2048',
        ];
        return $rules;
    }
}
