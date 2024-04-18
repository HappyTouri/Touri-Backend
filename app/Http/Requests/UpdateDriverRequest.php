<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
            "name" => "required",
            "mobile" => "required",
            "car_model" => "required",
            "number_of_seats" => "required|integer",
            "driver_rate" => "required",
            "driver_price" => "required",
            "note" => "sometimes",
            "city_id" => "required|exists:cities,id",
            "transportation_id" => "required|exists:transportations,id",
        ];
    }
}
