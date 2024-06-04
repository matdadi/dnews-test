<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        if ($this->user()->can('post-create')) {
            return true;
        }

        return false;
    }


    public function rules(): array
    {
        return [
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts'],
            'meta' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'post_text' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }
}
