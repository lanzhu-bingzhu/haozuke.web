<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerPostRequest extends FormRequest
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
            "name" => ["required"],
            "age" => ["required"],
            "phone" => ["required"],
            "email" => ["required"],
            "card" => ["required"],
            "address" => ["required"],
            "sex" => ["required"],
            "pic" => ["exclude_if:if_pic,true", "required"],
        ];
    }
}
