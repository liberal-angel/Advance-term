<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementRequest extends FormRequest
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
            'name' => 'required|max:20',
            'area_id' => 'required',
            'genre_id' => 'required',
            'discription' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '店名を入力して下さい',
            'area_id.required' => 'エリアを指定して下さい',
            'genre_id.required' => 'ジャンルを指定して下さい',
            'discription.required' => '説明欄を入力して下さい',
        ];
    }
}
