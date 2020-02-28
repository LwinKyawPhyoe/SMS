<?php

namespace App\Http\Controllers;

use App\attendance_type;
use Illuminate\Http\Request;

class AttendanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance_type = attendance_type::where('is_active','yes')->get()->toArray();
        // print_r($attendance_type);
        return array_reverse($attendance_type);
    }
    /**
     * Displaty a listing of the staff attendance type  (P,L,A,HD,H) by wai yan soe
     */
    public function getTypes(){
        $attendance_type = attendance_type::where('is_active', '<=', 'yes')->get()->toArray();
        return array_reverse($attendance_type);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\attendance_type  $attendance_type
     * @return \Illuminate\Http\Response
     */
    public function show(attendance_type $attendance_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\attendance_type  $attendance_type
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance_type $attendance_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\attendance_type  $attendance_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance_type $attendance_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\attendance_type  $attendance_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance_type $attendance_type)
    {
        //
    }
}

