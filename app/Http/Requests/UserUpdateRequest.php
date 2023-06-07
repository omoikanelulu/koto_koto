<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            // パイプで繋げる記述
            'name' => 'required|max:50',

            // 配列で書く記述
            'email' => [
                'required',
                'max:250',
                // emailがuniqueである事をチェックするが、userモデルのidである場合は除外する
                Rule::unique('users')->ignore($this->user->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須入力です',
            'name.max' => '名前は50文字までです',
            'email.required' => 'メールアドレスは必須入力です',
            'email.max' => 'メールアドレスは250文字までです',
            'email.unique' => 'そのメールアドレスは使用されています',
        ];
    }
}
