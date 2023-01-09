<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|unique:categories|max:255',
            'code' => 'required',
            'description' => 'required|max:1000',
            'brand' => 'required|max:1000',
            'category_image' => 'required|mimes:jpg,png,jpeg|max:2048'
        ];
        return $rules;
    }
}
