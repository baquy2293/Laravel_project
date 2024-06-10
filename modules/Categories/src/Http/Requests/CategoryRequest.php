<?php

namespace modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'parent_id' => 'required|integer',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('Categories::validation.required'),
            'max' => __("Categories::validation.min"),
            'interger' => __("Categories::validation.interger"),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Categories::validation.attributes.name'),
            "slug" => __('Categories::validation.attributes.slug'),
            'parent_id' => __('Categories::validation.attributes.parent_id'),
        ];
    }
}
