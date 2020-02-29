<?php

namespace App\Http\Controllers;

use App\schoolDetail;
use Illuminate\Http\Request;

class SchoolDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = schoolDetail::find('1')->toArray();
        return array_reverse($schools);
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
    public function store(schoolDetail $schoolDetail)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\schoolDetail  $schoolDetail
     * @return \Illuminate\Http\Response
     */
    public function show(schoolDetail $schoolDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\schoolDetail  $schoolDetail
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\schoolDetail  $schoolDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $school = schoolDetail::find($id);
        $school->update($request->all());
        return response($school);
    }

    public function updatePhoto(Request $request,$id){
        $school = schoolDetail::find($id);
        $imageName = time() . '.' . $request->schoollogo->getClientOriginalExtension();
        $request->schoollogo->move(public_path('SettingImages'), $imageName);
        $school->update([
            'schoollogo' => $imageName
        ]);
        return response($school);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\schoolDetail  $schoolDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(schoolDetail $schoolDetail)
    {
        //
    }
}
