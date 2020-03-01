<?php

namespace App\Http\Controllers;

use App\AcademicYear;
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
    public function find($id)
    {
        $staffid = Role::where('id', $id)->count();
        return response()->json($staffid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        AssignPermission::where('role_id', $id)->delete();
        $formData = $request->ary;
        for ($i = 0; $i < count($formData); $i++) {
            $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
            for ($ii = 0; $ii < count($session); $ii++) {
                $assignPermission = new AssignPermission([
                    'role_id' => $id,
                    'feature_id' => $formData[$i]['id'],
                    'feature'         => $formData[$i]['feature'],
                    'can_view'     => $formData[$i]['view'],
                    'can_add'     => $formData[$i]['add'],
                    'can_edit'        => $formData[$i]['edit'],
                    'can_delete'        => $formData[$i]['delete'],
                    'session_id'  => $session[$ii]['id'],
                    'domain'  => 'TS'
                ]);
            }
            $assignPermission->save();
        }

        return response()->json(['text' => 'Assign Permission added successfully', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignPermission  $assignPermission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $session = AcademicYear::where('is_active', 'yes')->where('domain', 'ts')->get();
        // for ($i = 0; $i < count($session); $i++){
        // }

        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $roles = AssignPermission::where('role_id', $id)->where('is_active', 'yes')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($roles);


        // $staffid = AssignPermission::where('role_id', $id)->get();
        // $session_id = AssignPermission::where('session_id',)->get();


        return response()->json($roles);
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
