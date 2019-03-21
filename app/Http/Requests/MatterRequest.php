<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class MatterRequest extends FormRequest
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
        $status = Constants::MATTERS_STATUS;
        $status = implode(',', $status);
        //switch method
        switch($this->method())
        {
            case "POST":
                return [
                    "matter" => "required|string",
                    "status" => "required|string|in:{$status}"
            ];
            default:
            return [];
        }
    }
}
