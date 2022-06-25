<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Constants\EmployeeConstants as constant;

class Lookup extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Primary key of the table
     */
    protected $primaryKey = constant::LOOKUP_PRIMARY_KEY;
    
    /**
     * Table name
     */
    protected $table = constant::LOOKUP_TABLE_NAME;

    /**
     * Guarded fields of the table
     */
    protected $guarded = [
        constant::ID,
        constant::DELETED_at,
        constant::CREATED_at,
        constant::UPDATED_at
    ];
}
