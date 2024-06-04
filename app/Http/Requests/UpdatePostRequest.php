<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        if ($this->user()->can('post-update')) {
            return true;
        }

        return false;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug,' . $this->post->id],
            'meta' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'post_text' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }
}
