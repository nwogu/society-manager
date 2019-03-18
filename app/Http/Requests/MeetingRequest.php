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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $meetingTypes = Constants::MEETING_TYPES;
        $meetingTypes = implode(',', $meetingTypes);
        //switch method
        switch($this->method())
        {
            case "POST":
                return [
                    "type" => "required|string|in:{$meetingTypes}",
                    "minute" => "required",
                    "meeting_date" => "required|string",
                    "start_time" => "required|string",
                    "end_time" => "required|string",
                    "presider" => "required|integer|exists:users,id",
                    "attendance" => "required|array|min:1"
                ];
            case "PUT":
                return [
                    "type" => "string|in:{$meetingTypes}",
                    "minute" => "string",
                    "meeting_date" => "string",
                    "start_time" => "string",
                    "end_time" => "string",
                    "presider" => "integer|exists:users,id",
                    "attendance" => "array|min:1"
                ];
            default:
            return [];
        }
    }
}
