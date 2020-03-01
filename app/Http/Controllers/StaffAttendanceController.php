<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\StaffAttendance;
use App\Http\Controllers\Controller;
use App\StaffDirectory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $year)
    {
        //
        // $data = DB::table("student_attendances")->select(
        //     'attendance_management.*',
        //     DB::raw('group_concat(attendance ORDER BY date) as atten'),
        //     DB::raw('group_concat(date ORDER BY date) as date_att'))->whereYear('date', '=', $year)
        //     ->get();
        // echo $year;

        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $data = StaffAttendance::where('staff_id', $id)
            ->whereYear('date', '=', $year)
            ->where('is_active', 'yes')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($data);



        // $data =  StaffAttendance::where('staff_id', $id)
        //     ->whereYear('date', '=', $year)
        //     ->get();
        // return response()->json($data);
    }
    public function getYears()
    {

        // $years = StaffAttendance::distinct('created_at')->get('created_at')
        //     ->groupBy(function ($val) {
        //         return  Carbon::parse($val->created_at)->format('YYYY');
        //     });
        // return response()->json($years);
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
        $formData = $request->data;
        $curdate = strtotime($formData[0]['date']);
        $date = date('Y-m-d', $curdate);
        $data = "";
        $data = StaffAttendance::where('staff_id', $formData[0]['staff_id'])->where('date', $date)->get('id');
        if(count($data) > 0 ) {
            echo "edit";
        }
        else{
            echo "add";
        }
        for ($i = 0; $i < count($formData); $i++) {
          
            // $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
            // for ($ii = 0; $ii < count($session); $ii++) {
            //     $staffAttendance = new StaffAttendance([
            //         'date'         => $formData[$i]['date'],
            //         'staff_id'     => $formData[$i]['staff_id'],
            //         'staff_attendance_type_id'     => $formData[$i]['staff_attendance_type_id'],
            //         'note'        => $formData[$i]['note'],
            //         'session_id'  => $session[$ii]['id'],
            //         'domain'  => 'TS'
            //     ]);
            // }
            // $staffAttendance->save();
        }
        echo ($data);

     

        return response()->json(['data' => $data, 'text' => 'Staff Attendance added successfully', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $staffAttendances = StaffAttendance::where('staff_id', $id)->get();
        $attendance =  StaffAttendance::where("staff_id", $id)->get();
        $present = $attendance->where('staff_attendance_type_id', 1)->count();
        $late    = $attendance->where('staff_attendance_type_id', 2)->count();
        $absent    = $attendance->where('staff_attendance_type_id', 3)->count();
        $half    = $attendance->where('staff_attendance_type_id', 4)->count();
        $holiday    = $attendance->where('staff_attendance_type_id', 5)->count();


        $data = [
            [
                "name" => "Present",
                "data" =>  $present
            ],
            [
                "name" => "Late",
                "data" => $late
            ],
            [
                "name" => "Absent",
                "data" => $absent
            ],
            [
                "name" => "Half Day",
                "data" => $half
            ],
            [
                "name" => "Holiday",
                "data" => $holiday
            ]
        ];
        return response()->json($data);



        // return response()->json($staffAttendances);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffAttendance $staffAttendance)
    {
        //
    }
}
