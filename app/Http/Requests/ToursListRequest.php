<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ToursListRequest extends FormRequest
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
            'priceForm' => ['required' , 'numeric' , 'min:0'],
            'priceTo' => ['required' , 'numeric' , 'min:0'],
            'dateFrom' => ['date' , 'date_format:m/d/Y'],
            'dateTo' => ['date' , 'date_format:m/d/Y'],
            'sortBy' => Rule::in(['price']),
            'sortOrder' => Rule::in(['asc' , 'desc'])
        ];
    }

    public function messages(): array
    {
        return [
          'sortBy' => "The 'SortBy' parameter accepts only 'price' value",
           'sortOrder' => "The 'SortBy' parameter accepts only 'asc' or 'desc' value"
        ];
    }
}
