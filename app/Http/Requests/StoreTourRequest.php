<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
            // 'tour_title_EN' => 'required',
            // 'tour_title_AR' => 'required',
            // 'tour_title_RU' => 'required',
            // 'tour_title_local' => 'required',
            // 'tour_description_EN' => 'required',
            // 'tour_description_AR' => 'required',
            // 'tour_description_RU' => 'required',
            // 'tour_description_local' => 'required',
            // 'video_link' => 'required',
            // 'city_id' => 'required',

        ];
    }
}
