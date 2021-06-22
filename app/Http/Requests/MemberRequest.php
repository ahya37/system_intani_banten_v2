<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'nik' => 'required',
            'name' => 'required',
            'professional_category_id' => 'required',
            'place_of_berth' => 'required',
            'date_of_berth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'village_id' => 'required',
            'phone_number' => 'required',
            'wa_number' => 'required',
            'email' => 'required|unique:members',
            'password' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'photo_idcard' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }
}
