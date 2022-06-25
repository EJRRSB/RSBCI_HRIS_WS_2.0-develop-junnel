<?php

namespace App\Models\Onboarding;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'hr_companies';
    protected $fillable = ['tenant_id', 'company_logo_url', 'company_name', 'doing_business_as', 'industry', 'company_website_url', 'location_id', 'business_phone_number', 'tin', 'company_code'];

    public function location()
    {
        return $this->hasOne(Location::class, "id", "location_id");
    }
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
