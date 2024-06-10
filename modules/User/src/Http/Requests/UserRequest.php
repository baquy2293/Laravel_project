<?php

namespace modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route()->user;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail("Vui Lòng chọn nhóm");
                }
            }],
        ];
        if ($id) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $id;
            if ($this->password) {
                $rules['password'] = 'min:6';
            } else {
                unset($rules['password']);
            }
        }

        return $rules;
    }

    public function messages()
    {

        return [
            'required' => __('User::validation.required'),
            'email' => __("User::validation.email"),
            'unique' => __("User::validation.unique"),
            'min' => __("User::validation.min"),
            'interger' => __("User::validation.interger"),

            //
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('User::validation.attributes.name'),
            "email" => __('User::validation.attributes.email'),
            'password' => __('User::validation.attributes.password'),
            "group_id" => __('User::validation.attributes.group_id'),
        ];
    }
}
