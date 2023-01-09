<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|max:250',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須入力です',
            'name.max' => '名前は50文字までです',
            'email.required' => 'メールアドレスは必須入力です',
            'email.max' => 'メールアドレスは250文字までです',
            'password.required' => 'パスワードは必須入力です',
        ];
    }
}
