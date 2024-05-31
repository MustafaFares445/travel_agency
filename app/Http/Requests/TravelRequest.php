<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'isPublic' => ['required' , 'boolean'],
            'name' => ['required' , 'unique:travels'],
            'description' => ['required' , 'string'],
            'numberOfDays' => ['required' , 'integer' , 'min:1'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        return [
            'is_public' => $this->isPublic,
            'name' => $this->name,
            'description' => $this->description,
            'number_of_days' => $this->numberOfDays,
        ];
    }
}
