<?php

namespace App\Models\Onboarding;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $cascadeDeletes = ['hr_locationss'];


    protected $table = 'hr_divisions';
    protected $fillable = ['company_id', 'location_id', 'division_code', 'division_name', 'division_head'];

    public function location()
    {
        return $this->hasOne(Location::class, "id", "location_id");
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'id', 'department_id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'id', 'team_id');
    }
}
