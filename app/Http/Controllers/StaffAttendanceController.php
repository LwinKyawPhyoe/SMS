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

    /***Get Year from db */
    public function getYears()
    {
        $years = StaffAttendance::selectRaw('YEAR(date) as year')
            ->orderBy('date', 'ASC')
            ->distinct()
            ->get();

        return $years;
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
        $data = StaffAttendance::where('date', $date)->get('id');
        if (count($data) > 0) {
            for ($i = 0; $i < count($formData); $i++) {
                $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
                for ($ii = 0; $ii < count($session); $ii++) {
                    $staffAttendance = StaffAttendance::find($data);
                    $input = [
                        'date'         => $formData[$i]['date'],
                        'staff_id'     => $formData[$i]['staff_id'],
                        'staff_attendance_type_id'     => $formData[$i]['staff_attendance_type_id'],
                        'note'        => $formData[$i]['note'],
                        'session_id'  => $session[$ii]['id'],
                        'domain'  => 'TS'
                    ];
                    $staffAttendance[$i]->update($input);
                    // echo $staffAttendance;
                    break;
                }
            }
        } else {
            for ($i = 0; $i < count($formData); $i++) {
                $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
                for ($ii = 0; $ii < count($session); $ii++) {
                    $staffAttendance = new StaffAttendance([
                        'date'         => $formData[$i]['date'],
                        'staff_id'     => $formData[$i]['staff_id'],
                        'staff_attendance_type_id'     => $formData[$i]['staff_attendance_type_id'],
                        'note'        => $formData[$i]['note'],
                        'session_id'  => $session[$ii]['id'],
                        'domain'  => 'TS'
                    ]);
                }
                $staffAttendance->save();
            }
        }


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
    public function search_by_role($id, $date)
    {
        $curdate = strtotime($date);
        $res = date('Y-m-d', $curdate);
        $data = "";
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $data = StaffAttendance::where('date', $res)->where('is_active', 'yes')->get();
        $attendance_staff_id = StaffAttendance::where('date', $res)
            ->where('is_active', 'yes')
            ->where('session_id', $sessionid[0]->id)
            ->get('staff_id');
        $ary = [];
        /***Update  */
        if (count($data) > 0) {
            $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
            for ($i = 0; $i < count($attendance_staff_id); $i++) {
                $staffs = StaffDirectory::with('role', 'department', 'designation')
                    ->where('role_id', $id)
                    ->where('is_active', 'yes')
                    ->where('domain', 'TS')
                    ->where('id', $attendance_staff_id[$i]->staff_id)
                    ->where('session_id', $sessionid[0]->id)
                    ->get()
                    ->toArray();
                array_push($ary, $staffs[0]);
            }
            return response()->json(['status' => 'update', 'data' => $ary, 'attendance' => $data]);
        } else {
            /***New */
            $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
            $staffs = StaffDirectory::with('role', 'department', 'designation')
                ->where('role_id', $id)
                ->where('is_active', 'yes')
                ->where('session_id', $sessionid[0]->id)
                ->where('domain', 'TS')
                ->get()->toArray();
            return response()->json(['status' => 'new', 'data' => $staffs]);
        }
    }
}
