<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
                    "type" => "required|string|in:". Constants::MEETING_TYPES,
                    "name" => "required|string",
                    "minute" => "required",
                    "start_time" => "required|date",
                    "end_time" => "required|date",
                    "presider" => "required|integer|exists:users,id",
                    "attendance" => "required|array|min:1"
                ];
            case "PUT":
                return [
                    "type" => "string|in:". Constants::MEETING_TYPES,
                    "name" => "string",
                    "minute" => "string",
                    "start_time" => "date",
                    "end_time" => "date",
                    "presider" => "integer|exists:users,id",
                    "attendance" => "array|min:1"
                ];
        }
    }
}
