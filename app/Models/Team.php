<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hr_teams';
    protected $fillable = ['company_id', 'location_id', 'division_id', 'department_id', 'team_code', 'team_name', 'team_lead'];

    public function location()
    {
        return $this->hasOne(Location::class, "id", "location_id");
    }
    public function division()
    {
        return $this->hasOne(Division::class, "id", "division_id");
    }
    public function department()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
}
