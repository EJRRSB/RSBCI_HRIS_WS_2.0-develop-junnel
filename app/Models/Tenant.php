<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;
    protected $connection = 'landlord';

    protected $table = 'hr_tenants';
    protected $fillable = [
        'first_name', 
        'last_name', 
        'work_email', 
        'country', 
        'mobile_number', 
        'company_name', 
        'industry', 
        'company_size', 
        'first_name', 
        'first_name', 
        'domain_name', 
        'inquiry', 
        'is_agree'
    ];
    use HasFactory;
}
