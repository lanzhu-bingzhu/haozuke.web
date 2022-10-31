<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'username' => ['required'],
            'sex' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'role_id' => ['required'],
            'desc' => ['present'],
        ];
    }
}
