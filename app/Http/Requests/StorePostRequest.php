<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        if($this->user()->can('create-post')) {
            return true;
        }

        return false;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts'],
            'meta' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'text_post' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }
}
