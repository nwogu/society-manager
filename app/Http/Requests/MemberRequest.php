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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       //switch method
       switch($this->method())
       {
           case "POST":
               return [
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'role' => 'required|integer|exists:roles,id',
                    'email' => 'required_if:phone,null|string|email|max:255|unique:users',
                    'phone' => 'required_if:email,null|string|max:255|unique:users',
                    'password' => 'string|min:6|confirmed',
                    'address' => 'string',
                    'dob' => 'date',
                    'sex' => 'string',
                    'joined' => 'date',
                    'status' => 'boolean'
               ];
           case "PUT":
               return [
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'role' => 'required|integer|exists:roles,id',
                    'email' => 'required_if:phone,null|string|email|max:255|unique:users',
                    'phone' => 'required_if:email,null|string|max:255|unique:users',
                    'password' => 'string|min:6|confirmed',
                    'address' => 'string',
                    'dob' => 'date',
                    'sex' => 'string',
                    'joined' => 'date',
                    'status' => 'boolean'
               ];
       }
    }
}
