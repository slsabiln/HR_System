<?php

use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeAllowanceController;
use App\Http\Controllers\Api\EmployeeVacationController;*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::middleware('api')->prefix('api')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::get('employees/{employee}', [EmployeeController::class, 'show']);
    Route::put('employees/{employee}', [EmployeeController::class, 'update']);
    Route::delete('employees/{employee}', [EmployeeController::class, 'destroy']);
    Route::apiResource('employee-allowances', EmployeeAllowanceController::class);
    Route::apiResource('employee-vacations', EmployeeVacationController::class);
    Route::get('employees/search', [EmployeeController::class, 'search']);
    Route::get('employees/{id}/salary', [EmployeeController::class, 'salary']);

});*/