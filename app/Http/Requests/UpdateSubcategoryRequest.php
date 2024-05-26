<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        if ($this->user()->can('subcategory-update')) {
            return true;
        }
        return false;
    }


    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:subcategories,slug,' . $this->subcategory->id],
            'sort' => ['required', 'integer'],
            'icon' => ['nullable', 'image', 'mimes:svg,png,jpg', 'max:2048'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
