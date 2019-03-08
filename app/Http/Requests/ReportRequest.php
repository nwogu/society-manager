<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
                    "title" => "required|string",
                    "meeting_id" => "integer|exists:meetings,id",
                    "reporter_type" => "required|string|in:" . Constants::REPORTER_TYPES,
                    "reporter_id" => "required|integer",
                    "report" => "required|string"
            ];
        }
    }
}
