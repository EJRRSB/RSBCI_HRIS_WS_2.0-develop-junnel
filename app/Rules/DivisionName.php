<?php

namespace App\Rules;

use App\Models\Onboarding\Company;
use App\Models\Onboarding\Division;
use App\Models\Onboarding\Tenant;
use Illuminate\Contracts\Validation\Rule;

class DivisionName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $data = null;
    public function __construct($data)
    {
        $this->data = $data;
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
        $company = Division::where('company_id',  $this->data['company_id'])->where('division_name', $this->data['division_name'])->first();
        if (!$company) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The division name has already been taken by the same company.';
    }
}
