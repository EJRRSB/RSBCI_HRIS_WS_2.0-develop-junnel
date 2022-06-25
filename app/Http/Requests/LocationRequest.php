<?php

namespace App\Http\Requests;

use App\Rules\LocationExactDuplicate;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'location_code' => ['required', 'min:1', 'max:6', 'unique:hr_locations,location_code,' .  $this->route('location') . ',id,tenant_id,' .  $this->input('tenant_id') . ',deleted_at,NULL'],
            'country' => ['required', 'max:100'],
            'street_address' => ['required', 'max:150'],
            'province' => ['required', 'max:100'],
            'city' => ['required', 'max:100'],
            'zip_code' => ['required', 'max:15', new LocationExactDuplicate($this->input(), $this->route('location'))],
        ];
    }
}
