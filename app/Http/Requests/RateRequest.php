<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            'rate' => 'required',
            'comment' => 'required|string|max:191',
        ];
    }

    public function messages()
    {
        return[
            'rate.required' => '評価を選択してください',
            'comment.required' => 'コメントを入力してください',
        ];
    }
}
