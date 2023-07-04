<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'unique:categories,slug',
            'description' => 'nullable',
            'image_path' => 'required',
//            'image_path' => 'required|image|max:512000|dimensions:min_width=300,min_height=300',
            'status' => 'required|in:1,0',
        ];
    }
}
