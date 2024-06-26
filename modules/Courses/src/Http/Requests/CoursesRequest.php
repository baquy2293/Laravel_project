<?php

namespace modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use modules\Categories\src\Models\Category;

class CoursesRequest extends FormRequest
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
        $id = $this->route()->course;
        $uniqueRule = 'unique:Courses,code';
        if ($id) {
            $uniqueRule .= ',' . $id;
        }
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail(__("Courses::validation.select"));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255|' . $uniqueRule,
            'is_document' => 'required|integer',
            'support' => 'required',
            'status' => 'required|integer',
            'categories' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('Courses::validation.required'),
            'max' => __("Courses::validation.max"),
            'min' => __("Courses::validation.min"),
            'interger' => __("Courses::validation.interger"),
            'unique' => __("Courses::validation.unique"),
        ];
    }

    public function attributes()
    {
        return __('Courses::validation.attributes');
    }
}
