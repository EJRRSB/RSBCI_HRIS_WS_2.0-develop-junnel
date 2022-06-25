<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employee\EmployeeListController;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\EmergencyDependentController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ValidationController;

use App\Http\Controllers\Onboarding\DepartmentListController;
use App\Http\Controllers\Onboarding\DivisionListController;
use App\Http\Controllers\Onboarding\LocationListController;
use App\Http\Controllers\Onboarding\TeamListController;
use App\Http\Controllers\Onboarding\CompanyListController;


// use App\Http\Controllers\Employee1\ProfileQuickAddController;
// use App\Http\Controllers\Employee1\ContactController;
// use App\Http\Controllers\Employee1\EducationController;
// use App\Http\Controllers\Employee1\WorkExperienceController;
// use App\Http\Controllers\Employee1\SkillController;
// use App\Http\Controllers\Employee1\BankInformationController;
// use App\Http\Controllers\Employee1\BenefitController;
// use App\Http\Controllers\Employee1\EmploymentController;
// use App\Http\Controllers\Employee1\PositionController;
// use App\Http\Controllers\Employee1\SalaryController;
// use App\Http\Controllers\Employee1\EarningController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(
    function () {
        // Route::post('employee-list', [EmployeeListController::class, 'index']);
        // Route::post('employee-list/{status}', [EmployeeListController::class, 'getEmployeesByStatus']);
        // Route::post('update-status/{id}/{statusCode}', [EmployeeListController::class, 'updateStatus']);

        // Route::post('tenant', [TenantController::class, 'validateTenantName']); // before
        Route::post('tenant', [ValidationController::class, 'validateTenantName']); // elton
        Route::post('validate/company_code', [ValidationController::class, 'validateCompanyCode']);
        Route::post('validate/work_email_address', [ValidationController::class, 'validateWorkEmailAddress']);
        Route::post('validate/username', [ValidationController::class, 'validateUsername']);

        Route::post('login', [AuthController::class, 'login']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
        Route::post('employee', [EmployeeController::class, 'store']);


        //Full add tabs
        // Route::post('profile', [ProfileController::class, 'storeProfile']);
        // Route::post('contact', [ProfileController::class, 'updateContactInfo']);
        // Route::post('government', [ProfileController::class, 'updateGovernmentInfo']);

        // Route::post('/emergency-details', [EmergencyDependentController::class, 'index']);
        // Route::post('/emergency', [EmergencyDependentController::class, 'storeEmergencyDependent']);
        // Route::post('/dependent', [EmergencyDependentController::class, 'storeEmergencyDependent']);
        // Route::post('/dependent/{id}', [EmergencyDependentController::class, 'updateDependent']);
        // Route::delete('/dependent/{id}', [EmergencyDependentController::class, 'deleteDependent']);
    }
);



// Route::post('validate/work_email', [UseController::class, 'validateWorkEmail']);
// Route::post('validate/username', [UseController::class, 'validateUsername']);

//Route::post('validate/username', [Controllers\ValidationController::class, 'validateUsername']);




Route::prefix('v1')->group(
    function () {
            Route::middleware(['tenant'])->group(function () {

            //Employee Management
            Route::prefix('employee')->group(function () {
                Route::apiResource('profiles/detailed', ProfileController::class);
                // Route::apiResource('profiles/quick', Profile1Controller::class);
                // Route::apiResource('contacts', ContactController::class);
                // Route::apiResource('educations', EducationController::class);
                // Route::apiResource('workExperiences', WorkExperienceController::class);
                // Route::apiResource('skills', SkillController::class);
                // Route::apiResource('bankInfos', BankInformationController::class);
                // Route::apiResource('benefits', BenefitController::class);
                // Route::apiResource('employments', EmploymentController::class);
                // Route::apiResource('positions', PositionController::class);
                // Route::apiResource('salaries', SalaryController::class);
                // Route::apiResource('earnings', EarningController::class);

                // Route::get('profiles/employee-list/{status}', [Profile1Controller::class, 'getEmployeesByStatus']);
                // Route::post('profiles/update-status/{id}/{statusCode}', [Profile1Controller::class, 'updateStatus']);

                Route::get('/profiles/lookup', [ProfileController::class, 'getLookupData']);
            });

            Route::post('/employee-list', [EmployeeListController::class, 'getAllEmployees']);
            Route::post('/employee-list/{status}', [EmployeeListController::class, 'getEmployeesByStatus']);
            Route::post('/employee-status/{id}/{statusCode}', [EmployeeListController::class, 'updateStatus']);


            
            // Onboarding
            Route::apiResource('departments', DepartmentListController::class);
            Route::apiResource('divisions', DivisionListController::class);
            Route::apiResource('locations', LocationListController::class);
            Route::apiResource('teams', TeamListController::class);
            Route::apiResource('companies', CompanyListController::class);
            
            // Route::apiResource('lookups', LookupController::class);
        });
    }
);
