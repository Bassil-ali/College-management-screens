<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:15',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم الكامل حقل مطلوب',
            'name.unique' => 'الاسم الكامل تم تسجيله سابقاَ',
            'username.required' => 'اسم المستخدم حقل مطلوب',
            'username.unique' => 'اسم المستخدم تم تسجيله سابقاَ',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'الاسم الكامل',
            'username' => 'اسم المستخدم',
        ];
    }
}
