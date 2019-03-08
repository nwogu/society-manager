<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            case "PUT":
                return [
                    "task" => "required|string",
                    "status" => "boolean",
                    "meeting_id" => "integer|exists:meetings,id",
                    "assigned_to" => "required|integer|exists:in,users,id"
            ];
        }
    }
}
