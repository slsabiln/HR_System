<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Employee $employee)
    {
        //
    }

    public function update(Request $request, Employee $employee)
    {
        //
    }


    public function destroy(Employee $employee)
    {
        //
    }

    public function search(Request $request)
    {
        dd($request->all());
        $keyword = $request->input('keyword');

        $employees = Employee::query()
            ->where('full_name', 'like', "%{$keyword}%")
            ->orWhere('code', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->get();

        return response()->json($employees);
    }


    public function salary($id)
    {
        $employee = Employee::with(['salaryBases', 'allowances'])->findOrFail($id);

        $baseSalary = $employee->salaryBases->sum('amount');
        $allowances = $employee->allowances->sum('amount');

        $totalSalary = $baseSalary + $allowances;

        return response()->json([
            'employee_id' => $id,
            'total_monthly_salary' => $totalSalary,
        ]);
    }
}
