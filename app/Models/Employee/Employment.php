<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Constants\EmployeeConstants;

/**
 * Class Employment
 * @package App\Models\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.20
 */
class Employment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Primary key of the table
     */
    protected $primaryKey = EmployeeConstants::EMPLOYEE_EMPLOYMENT_PRIMARY_KEY;
    
    /**
     * Table name
     */
    protected $table = EmployeeConstants::EMPLOYEE_EMPLOYMENT_TABLE_NAME;

    /**
     * Guarded fields of the table
     */
    protected $guarded = [
        EmployeeConstants::ID,
        EmployeeConstants::DELETED_at,
        EmployeeConstants::CREATED_at,
        EmployeeConstants::UPDATED_at
    ];

    /**
     * Function to set the employment information belong to an employee
     */
    public function Employment()
    {
        return $this->belongsTo(Employment::class, EmployeeConstants::EMPLOYEE_ID);
    }
}
