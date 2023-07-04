<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElevePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "firstname" => "required",
            "lastname" => "required",
            "birthdate" => "sometimes:required|date_format:Y-m-d",
            "birthplace" => "sometimes:required",
            "profil" => "required",
            "sex" => "required",
            "classe" => "required",
            "year" => "required"
        ];
    }
}
