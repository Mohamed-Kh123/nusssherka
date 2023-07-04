<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type == 'super-admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|integer|min:1',
            'description' => 'nullable',
            'discount' => 'nullable|min:1|max:100',
            'status' => 'required|in:0,1',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
