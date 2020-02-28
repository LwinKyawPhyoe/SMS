<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::where('is_active', 'Yes')->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return array_reverse($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required'
        ]);
        $department = new Department([
            "department_name" => $request->input('department_name'),
        ]);
        $department->save();
        return response()->json(['text' => 'Department added successfully', 'type' => 'success']);
        return response()->json("The Designation successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $department = Department::find($id);
        $department->update($request->all());
        return response()->json(['text' => 'Department updated successfully', 'type' => 'success']);
        return response()->json("The Department successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $department = Department::find($id);
        $department->update([
            "is_active" => "No"
        ]);
        return response()->json(['text' => 'Department deleted successfully', 'type' => 'success']);
    }
}
