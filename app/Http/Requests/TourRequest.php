<?php

namespace App\Http\Requests;

use App\Models\Tour;
use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required' , 'string'],
            'startingDate' => ['required', 'date' , 'date_format:m/d/Y'],
            'endingDate' => ['required' , 'date' ,'date_format:m/d/Y', 'after:starting_date'],
            'price' => ['required' , 'numeric' , 'min:0'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        return [
            'name' => $this->name,
            'starting_date' => $this->startingDate,
            'ending_date' => $this->endingDate,
            'price' => $this->price,
        ];
    }
}
