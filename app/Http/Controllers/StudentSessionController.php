<?php

namespace App\Http\Controllers;

use App\student_session;
use Illuminate\Http\Request;

class StudentSessionController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $session = new student_session([
            'session_id'=>$request->input('session_id'),
            'admission_no'=>$request->input('admission_no'),
            'class_section_id'=>$request->input('class_section_id'),
            'route_id'=>$request->input('route_id'),
            'hostel_room_id'=>$request->input('hostel_room_id'),
            'is_active'=>$request->input('is_active'),
            'domain'=>$request->input('domain'),
        ]);
        $session->save();
    }

    
    public function show(student_session $student_session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student_session  $student_session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $session = DB::select('SELECT * FROM sessions');
    }

    
    public function update(Request $request,$id)
    {
        $session = student_session::where('admission_no',$id)->get();
        $session->update([
            'session_id'=>$request->input('session_id'),
            'admission_no'=>$request->input('admission_no'),
            'class_section_id'=>$request->input('class_section_id'),
            'route_id'=>$request->input('route_id'),
            'hostel_room_id'=>$request->input('hostel_room_id'),
            'is_active'=>$request->input('is_active'),
            'domain'=>$request->input('domain'),
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student_session  $student_session
     * @return \Illuminate\Http\Response
     */
    public function destroy(student_session $student_session)
    {
        //
    }
}
