<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
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
            //
        ];
    }
}


// <?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreAccommodationRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules for the accommodation details.
//      *
//      * @return array
//      */
//     protected function accommodationRules(): array
//     {
//         return [
//             'name' => 'required',
//             'rate' => 'required',
//             'mobile' => 'required',
//             'address' => 'required',
//             'email' => 'required',
//             'price_list_PDF' => 'required', // Add specific rules for the PDF if needed
//             'share' => 'required',
//             'note' => 'required',
//             'cover_photo' => 'required',
//             'video_link' => 'required',
//             'city_id' => ['required', 'exists:cities,id'], // Adjusted to use an array for validation
//             'accommodation_type_id' => ['required', 'exists:accommodation_types,id'], // Adjusted to use an array for validation
//         ];
//     }

//     /**
//      * Get the validation rules for the apartment details.
//      *
//      * @return array
//      */
//     protected function apartmentRules(): array
//     {
//         return [
//             'number_of_rooms' => 'required',
//             'number_of_peoples' => 'required',
//         ];
//     }

//     /**
//      * Get the validation rules for the photos.
//      *
//      * @return array
//      */
//     protected function photosRules(): array
//     {
//         return [
//             'photos' => 'required',
//         ];
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array
//      */
//     public function rules(): array
//     {
//         return [
//             'accommodation' => $this->accommodationRules(),
//             'apartment' => $this->apartmentRules(),
//             'photos' => $this->photosRules(),
//         ];
//     }
// }
