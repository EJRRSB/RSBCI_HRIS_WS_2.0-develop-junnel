<?php

namespace App\Http\Requests;

use App\Rules\TeamName;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'company_id' => ['required', 'exists:hr_companies,id,deleted_at,NULL'],
            'location_id' => ['nullable', 'exists:hr_locations,id,deleted_at,NULL'],
            'division_id' => ['nullable', 'exists:hr_divisions,id,deleted_at,NULL'],
            'department_id' => ['nullable', 'exists:hr_departments,id,deleted_at,NULL'],
            //'team_code' => ['required', 'max:6', 'unique:hr_teams,team_code,' .  $this->route('team')],
            'team_name' => ['required', 'max:80', new TeamName($this->input(), $this->route('team'))],
            'team_lead' => ['nullable'], //Add the exists employee rule here once its become available
        ];
    }
}
