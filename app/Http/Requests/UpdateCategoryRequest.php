<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'description' => 'max:1000',
            'brand' => 'max:1000',
            'category_image' => 'mimes:jpg,png,jpeg|max:2048'
        ];
        return $rules;
    }
}
