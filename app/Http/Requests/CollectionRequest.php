<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
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
        $collections = Constants::COLLECTION_TYPES;
        //switch method
        switch($this->method())
        {
            case "POST":
                return [
                    "type" => "required|in_array:{$collections}",
                    "amount" => "required|numeric",
                    "received" => "required|numeric",
                    "description" => 'string',
                    "balance" => 'numeric',
                    "member" => "integer|exists:users,id",
                    "collection_date" => "date",
                    "recorder" => "integer|exists:user,id",
                    "meeting_id" => "integer|exists:meetings,id",
                    "commitee_id" => "integer|exists:commitees,id",
                    "start_period" => "date",
                    "end_period" => "date"

                ];
            case "PUT":
                return [
                    "amount" => "numeric",
                    "received" => "numeric",
                    "description" => 'string',
                    "balance" => 'numeric',
                    "member" => "integer|exists:users,id",
                    "collection_date" => "date",
                    "recorder" => "integer|exists:user,id",
                    "meeting_id" => "integer|exists:meetings,id",
                    "commitee_id" => "integer|exists:commitees,id",
                    "start_period" => "date",
                    "end_period" => "date"
                ];
        }
    }
}
