<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hr_departments';
    protected $fillable = ['company_id', 'location_id', 'division_id', 'department_code', 'department_name', 'department_head'];

    public function location()
    {
        return $this->hasOne(Location::class, "id", "location_id");
    }
    public function division()
    {
        return $this->hasOne(Division::class, "id", "division_id");
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'id', 'team_id');
    }
}
