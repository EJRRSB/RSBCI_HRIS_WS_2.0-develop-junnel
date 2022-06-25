<?php

namespace App\Models\Onboarding;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'hr_locations';
    protected $fillable = ['tenant_id', 'location_code', 'country', 'street_address', 'province', 'city', 'zip_code'];

    public function company()
    {
        return $this->belongsTo(company::class, 'id', 'location_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'id', 'location_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'id', 'location_id');
    }
}
