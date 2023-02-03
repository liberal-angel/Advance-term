<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
            'date' => 'after:yesterday',
            'time' => 'required',
            'num_of_users' => 'required',
            'user_id' => 'required',
            'shop_id' => ['required',Rule::unique('reservations', 'shop_id')->where('user_id', $this->input('user_id'))],
        ];
    }

    public function messages()
    {
        return[
            'date.after' => '日付に問題があります',
            'time.required' => '時間を入力して下さい',
            'num_of_users.required' => '人数を入力して下さい',
            'shop_id.unique' => 'すでに予約しています'
        ];
    }
}
