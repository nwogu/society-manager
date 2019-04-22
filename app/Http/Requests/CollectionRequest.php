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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $collections = function () {
            return implode("," , Constants::COLLECTION_TYPES);
        };
        //switch method
        switch($this->method())
        {
            case "POST":
                return [
                    "type" => "required|in:{$collections()}",
                    "amount" => "required|numeric",
                    "received" => "required|numeric"
                ];
        }
    }
}
