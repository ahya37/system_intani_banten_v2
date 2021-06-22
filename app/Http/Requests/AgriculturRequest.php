<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgriculturRequest extends FormRequest
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
            'type_of_agriculture_id'=> 'required',
            'land_area'=> 'required',
            'address_area' => 'required',
            'photo_area' => 'required|image|mimes:png,jpg,jpeg',
            'type_of_seed' => 'required',
            'number_of_seeds' => 'required',
            'origin_of_seed' => 'required',
            'planting_date' => 'required'
        ];
    }
}
