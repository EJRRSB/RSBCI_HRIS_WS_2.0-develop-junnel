<?php

namespace App\Rules;

use App\Models\Onboarding\Team;
use Illuminate\Contracts\Validation\Rule;

class TeamName implements Rule
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
        $team = Team::where('company_id',  $this->data['company_id'])->where('division_id', $this->data['division_id'])->where('department_id', $this->data['department_id'])->where('team_name', $this->data['team_name'])->first();
        if (!$team) {
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
        return 'The same team already exists.';
    }
}
