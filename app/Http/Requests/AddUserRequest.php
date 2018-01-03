<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUserRequest extends Request
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
            'fullname' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|min:3|unique:users,emailadd',
            'username' => 'required|max:255|min:3|unique:users,loginid',
            'status' => 'required',
            'role' => 'required',
            'new_password' => 'required|confirmed|max:255|min:7',
            'new_password_confirmation' => 'required|max:255',
        ];


    }
}
