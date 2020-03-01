<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\AssignPermission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $roles = Role::where('is_active', 'yes')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($roles);
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
        //
        $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
        for ($i = 0; $i < count($session); $i++) {
            $role = new Role([
                "name" => $request->input('name'),
                'type' => "Custom",
                'session_id'  => $session[$i]['id'],
                'domain'  => 'TS'
            ]);
            $role->save();
            return response()->json(['text' => 'Role added successfully', 'type' => 'success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $role = Role::find($id);
        $role->update($request->all());
        return response()->json(['text' => 'Role updated successfully', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $role = Role::find($id);
        $role->update([
            "is_active" => "No"
        ]);
        return response()->json(['text' => 'Role deleted successfully', 'type' => 'success']);
    }
}
