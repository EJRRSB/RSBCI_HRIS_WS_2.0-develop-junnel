<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Constants\EmployeeConstants;

/**
 * Class Education
 * @package App\Models\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.13
 */
class Education extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Primary key of the table
     */
    protected $primaryKey = EmployeeConstants::EMPLOYEE_EDUCATIONS_PRIMARY_KEY;
    
    /**
     * Table name
     */
    protected $table = EmployeeConstants::EMPLOYEE_EDUCATIONS_TABLE_NAME;

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
     * Function to set the education information belong to an employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, EmployeeConstants::EMPLOYEE_ID);
    }
}
