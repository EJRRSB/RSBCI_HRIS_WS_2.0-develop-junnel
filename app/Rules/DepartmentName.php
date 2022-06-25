<?php

namespace App\Rules;

use App\Models\Onboarding\Company;
use App\Models\Onboarding\Department;
use App\Models\Onboarding\Tenant;
use Illuminate\Contracts\Validation\Rule;

class DepartmentName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $data = null;
    private $id = null;
    public function __construct($data, $id)
    {
        $this->data = $data;
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
        $deparment = Department::where('company_id',  $this->data['company_id'])->where('division_id', $this->data['division_id'])->where('department_name', $this->data['department_name'])->first();
        if (!$deparment) {
            return true;
        } else {
            if ($deparment->id == $this->id) {
                return true;
            }
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
        return 'The same department already exists.';
    }
}
