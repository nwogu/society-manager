<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommiteeRequest extends FormRequest
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
                     "name" => "required|string",
                     "members" => "required|array|min:1"
                 ];
             case "PUT":
                 return [
                    "name" => "string",
                    "members" => "array|min:1"
                 ];
         }
 
    }
}
