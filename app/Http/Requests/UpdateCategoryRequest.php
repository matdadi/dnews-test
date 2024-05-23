<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (auth()->user()->can('category-update')) {
            return true;
        }

        return false;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug,' . $this->category->id],
            'icon' => ['required', 'string', 'max:255'],
            'sort' => ['required', 'integer'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
