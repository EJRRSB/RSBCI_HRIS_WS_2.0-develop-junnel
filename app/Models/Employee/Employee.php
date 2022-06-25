<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Constants\EmployeeConstants;
use DateTimeInterface;
/**
 * Class Employee
 * @package App\Models\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.11
 */
class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Primary key of the table
     */
    protected $primaryKey = EmployeeConstants::EMPLOYEE_PRIMARY_KEY;
    
    /**
     * Table name
     */
    protected $table = EmployeeConstants::EMPLOYEE_TABLE_NAME;

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
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Function to get bank information of an Employee
     */
    public function bankInformation()
    {
        return $this->hasMany(BankInformation::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get benefit information of an Employee
     */
    public function benefit()
    {
        return $this->hasMany(Benefit::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get contact information of an Employee
     */
    public function contact()
    {
        return $this->hasMany(Contact::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get earning information of an Employee
     */
    public function earning()
    {
        return $this->hasMany(Earning::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get education information of an Employee
     */
    public function education()
    {
        return $this->hasMany(Education::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get employment information of an Employee
     */
    public function employment()
    {
        return $this->hasOne(Employment::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get work position information of an Employee
     */
    public function position()
    {
        return $this->hasMany(Position::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get salary information of an Employee
     */
    public function salary()
    {
        return $this->hasOne(Salary::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get skill information of an Employee
     */
    public function skill()
    {
        return $this->hasMany(Skill::class, EmployeeConstants::EMPLOYEE_ID);
    }

    /**
     * Function to get work experience information of an Employee
     */
    public function workExperience()
    {
        return $this->hasMany(WorkExperience::class, EmployeeConstants::EMPLOYEE_ID);
    }
}
