<?php

namespace App\Http\Controllers;

use App\AssignPermission;
use App\Http\Controllers\Controller;
use App\Role;
use App\StaffDirectory;
use Illuminate\Http\Request;

class AssignPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function find($id){
        $staffid = Role::where('id',$id)->count();
        return response()->json($staffid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        echo $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignPermission  $assignPermission
     * @return \Illuminate\Http\Response
     */
    public function show(AssignPermission $assignPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignPermission  $assignPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignPermission $assignPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignPermission  $assignPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignPermission $assignPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignPermission  $assignPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignPermission $assignPermission)
    {
        //
    }
}
