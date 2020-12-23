<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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
            'form.title' => 'required|unique:posts,title',
            'form.content' => 'required',
            'form.category' => 'required|exists:categories,id',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'form.title.required' => 'Title is required.',
            'form.title.unique' => 'Title already exist',

            'form.content.required' => 'Content is required.',

            'form.category.required' => 'Category is required.',
            'form.category.exists' => 'Category not exist'
        ];
    }
}
