<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRestaurantRequest extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'required|max:300',
            'deliveries_time' => 'required',
            'address_description' => 'required|string',
            'gmap_address' => 'required|string',
            'is_merchant' => 'required'
        ];
    }
}
