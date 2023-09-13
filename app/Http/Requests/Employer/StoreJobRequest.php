<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'title' => ['required','max:255'],
            'description' => ['required','max:255'],
            'salary' => ['required', 'numeric'],
            'work_type' => ['required','max:255'],
            'location' => ['required_if:work_type,Hybrid','required_if:work_type,Onsite','max:255']
        ];
    }
}
