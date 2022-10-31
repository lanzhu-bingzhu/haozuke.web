<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FangUpdateRequest extends FormRequest
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
            "id" => ['required'],
            "fang_name" => ['required'],
            "fang_addr" => ['required'],
            "fang_xiaoqu" => ['required'],
            "fang_rent" => ['required', 'numeric'],
            "fang_floor" => ['required', 'numeric'],
            "fang_rent_type" => ['required', 'numeric'],
            "fang_shi" => ['required', 'numeric'],
            "fang_ting" => ['required', 'numeric'],
            "fang_wei" => ['required', 'numeric'],
            "fang_direction" => ['required', 'numeric'],
            "fang_rent_class" => ['required', 'numeric'],
            "fang_build_area" => ['required', 'numeric'],
            "fang_using_area" => ['required', 'numeric'],
            "fang_year" => ['required', 'numeric'],
            "fang_config" => ['required'],
            "fang_pic" => ['nullable'],
            "fang_owner" => ['required', 'numeric'],
            "is_recommend" => ['required', 'numeric'],
            "fang_desn" => ['required'],
            "fang_body" => ['required'],
            "fang_province" => ['nullable', 'numeric'],
            "fang_city" => ['nullable', 'numeric'],
            "fang_region" => ['nullable', 'numeric'],
        ];
    }
}
