<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!auth()->user()->can('tag-create')) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'tag_name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:tags'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
