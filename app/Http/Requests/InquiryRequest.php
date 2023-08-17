<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
            'inquiry' => 'required|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '氏名を入力してください',
            'name.max' => '氏名は20文字までです',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '不正なメールアドレスです',
            'email.max' => 'メールアドレスは255文字までです',
            'inquiry.required' => 'お問い合わせ内容を入力してください',
            'inquiry.max' => 'お問い合わせ内容は500文字までです',
        ];
    }
}
