<?php

namespace WeatherGuru\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchForecastRequest extends FormRequest
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
            'location' => 'string|required',
            'lng' => 'longitude|required',
            'lat' => 'latitude|required',
            'unit' => 'string|required',
        ];
    }
}
