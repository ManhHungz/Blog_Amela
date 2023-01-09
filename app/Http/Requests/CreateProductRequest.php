<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:1',
            'shortDescription' => 'required',
            'quantity' => 'required|numeric|min:1',
            'categories' => 'required',
            'product_images' => 'required|max:2048'
        ];
        return $rules;
    }
}
