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
            'dob' => '',
            'gender' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'email|unique:users,email',
            'address' => 'max:1000',
            'image' => 'max:2048',
        ];
        return $rules;
    }
}
