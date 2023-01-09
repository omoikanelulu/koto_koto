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
            'thing' => 'required|max:100',
            'bad_thing_workaround' => 'max:250',
            'good_thing_order' => 'required',
            'bad_thing_order' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'thing.required' => 'デキゴトは必須入力です',
            'thing.max' => 'デキゴトは100文字までです',
            'bad_thing_workaround.max' => 'デキゴトは250文字までです',
            'good_thing_order.required' => 'いずれかの順位を選択してください',
            'bad_thing_order.required' => 'いずれかの順位を選択してください',
        ];
    }
}
