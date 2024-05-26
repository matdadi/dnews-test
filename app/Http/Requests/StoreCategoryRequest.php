<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (auth()->user()->can('category-create')) {
            return true;
        }
        return false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories'],
            'icon' => ['required', 'image', 'mimes:svg,png,jpg', 'max:2048'],
            'sort' => ['required', 'integer'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
