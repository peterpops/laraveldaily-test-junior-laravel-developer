<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\storeRequest;
use App\Http\Requests\Employees\updateRequest;
use App\Models\Companies;
use App\Models\Employees;
use Inertia\Inertia;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function index()
    {
        // return inertia
        return Inertia::render('Employees/index', [
            'employees' => function () {
                return Employees::latest()->paginate(10);
            }
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Inertia
     */
    public function create()
    {
        // return inertia
        return Inertia::render(
            'Employees/create',
            [
                'companies' => function () {
                    return Companies::all('id', 'name');
                }
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Employees\storeRequest $storeRequest
     * @return void
     */
    public function store(storeRequest $storeRequest)
    {
        $validated = $storeRequest->validated();
        $validated = $validated['addForm'];

        // create employee
        Employees::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_id' => $validated['company'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        return Inertia::render(
            'Employees/show',
            [
                'employee' => function () use ($employee_id) {
                    return $result = Employees::with('company')->findOrFail($employee_id);
                },
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Inertia
     */
    public function edit($employee_id)
    {
        // return inertia
        return Inertia::render(
            'Employees/edit',
            [
                'companies' => function () use ($employee_id) {
                    return Companies::orderBy('name')->get(['id', 'name']);
                },
                'employee' => function () use ($employee_id) {
                    return Employees::findOrFail($employee_id);
                },
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Employees\updateRequest  $updateRequest
     * @param  int  $employee_id
     * @return void
     */
    public function update(updateRequest $updateRequest, $employee_id)
    {
        $validated = $updateRequest->validated();
        $validated = $validated['editForm'];

        $employee = Employees::findOrFail($employee_id);

        $employee->update([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_id' => $validated['company'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employee_id
     * @return void
     */
    public function destroy($employee_id)
    {
        $employee = Employees::findOrFail($employee_id);

        $employee->delete();
    }
}
