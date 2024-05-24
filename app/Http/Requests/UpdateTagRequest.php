<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{

    public function authorize(): bool
    {
        if ($this->user()->can('tag-update')) {
            return true;
        }

        return false;
    }

    
    public function rules(): array
    {
        return [
            'tag_name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:tags,slug,' . $this->tag->id],
            'is_active' => ['required', 'boolean']
        ];
    }
}
