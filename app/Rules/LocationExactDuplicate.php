<?php

namespace App\Rules;

use App\Models\Onboarding\Location;
use Illuminate\Contracts\Validation\Rule;

class LocationExactDuplicate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $input = null;
    private $id = null;
    public function __construct($input, $id)
    {

        $this->input = $input;
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        //First Get All records with this given street address and tenant id
        $locations = Location::where('street_address', '=', $this->input['street_address'])->where('tenant_id', '=', $this->input['tenant_id'])->get();
        if ($locations) {
            //After Getting all matched check if it will also match to other input
            foreach ($locations as $location) {
                if ($location->location_code == $this->input['location_code'] && $location->country == $this->input['country'] && $location->province == $this->input['province'] && $location->city == $this->input['city'] && $location->zip_code == $this->input['zip_code']) {
                    if ($this->id == $location->id) {
                        return true;
                    }
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The same location already exists.';
    }
}
