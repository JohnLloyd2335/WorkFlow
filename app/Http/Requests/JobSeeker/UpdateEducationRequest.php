<?php

namespace App\Http\Requests\JobSeeker;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'highest_education' => ['required','string','max:255'],
            'field_of_study' => ['required','string','max:255'],
            'date_graduated' => ['required','string','max:255'],
            'school_name' => ['required','string','max:255']
        ];
    }
}
