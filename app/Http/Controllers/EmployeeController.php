<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Model\Campaign;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.index')->with('employees', Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create')->with('campaigns', Campaign::all());
    }

    public function activate($id)
    {
        $employee = Employee::find($id);
        $employee->status = 1;
        $employee->save();
        return redirect()->back()->with('success', 'Employee activated!');
    }

    public function deactivate($id)
    {
        $employee = Employee::find($id);
        $employee->status = 0;
        $employee->save();
        return redirect()->back()->with('success', 'Employee deactivated!');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->all());
        return redirect()->route('employee.index')->with('success', 'Successfully added new employee!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.edit', ['employee' => $employee, 'campaigns' => Campaign::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('success', 'Successfully updated employee!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
