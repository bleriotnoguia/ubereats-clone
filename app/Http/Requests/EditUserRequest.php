<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EditUserRequest extends FormRequest
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
        $user_id = request()->get('user_id');
        if(Auth::user()->isSuperAdmin() && Auth::user()->id != $user_id){
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user_id,
                'phone_number' => 'required|unique:users,phone_number,'.$user_id,
                'password' => 'same:c_password',
            ];
        }else{
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,'.Auth::user()->id,
                'phone_number' => 'required|unique:users,phone_number,'.Auth::user()->id,
            ];
        }
    }
}
