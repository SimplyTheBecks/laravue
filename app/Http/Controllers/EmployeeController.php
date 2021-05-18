<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Exception;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Employee::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $employeeRequest
     * @return JsonResponse
     */
    public function store(EmployeeRequest $employeeRequest): JsonResponse
    {
        $employee = (new Employee())->create($employeeRequest->validated());

        return response()->json(['id' => $employee->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        return response()->json($employee->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $employeeRequest
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(
        EmployeeRequest $employeeRequest,
        Employee $employee
    ): JsonResponse {
        $employee->update($employeeRequest->validated());

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json([]);
    }
}
