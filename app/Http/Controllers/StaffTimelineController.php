<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\StaffTimeline;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffTimelineController extends Controller
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
        $staffs = StaffTimeline::where('is_active', 'yes')->with('staffs')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($staffs);
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
        $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
        for ($i = 0; $i < count($session); $i++) {
            $staffTimeline = new StaffTimeline([
                'staff_id' => $request->staff_id,
                'title' => $request->input('title'),
                'timeline_date' => $request->date,
                'description' => $request->input('description'),
                'session_id'  => $session[$i]['id'],
                'domain'  => 'TS',
                'is_active' => 'yes'
            ]);
            $staffTimeline->save();
            return response()->json(['text' => 'Staff Timeline added successfully', 'type' => 'success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffTimeline  $staffTimeline
     * @return \Illuminate\Http\Response
     */
    public function show(StaffTimeline $staffTimeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffTimeline  $staffTimeline
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffTimeline $staffTimeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffTimeline  $staffTimeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffTimeline $staffTimeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffTimeline  $staffTimeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffTimeline $staffTimeline)
    {
        //
    }
}
