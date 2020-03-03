<?php

namespace App\Http\Controllers;

use App\student_attendance;
use Illuminate\Http\Request;
use DB;
class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // print_r($request->studObj[$i]['admission_no']);
            if($request->id){
                $student_attendances = student_attendance::find($request->id);
                $student_attendances->update([
                    'admission_no' => $request->admission_no,
                    'date' => $request->date,
                    'class_section_id'=> $request->class_section_id,
                    'attendance_type_id'=> $request->attendance_type_id,
                    'biometric_attendance'=> $request->biometric_attendance,
                    'remark'=> $request->remark,
                    'is_active'=> $request->is_active,
                    'session_id'=>$request->session_id,
                    'domain'=>$request->domain,
                ]);
                return ['text'=>"Successfully updated",'type'=>"success"];
            }else{
                $student_attendances = new student_attendance([
                    'admission_no' => $request->admission_no,
                    'date' => $request->date,
                    'class_section_id'=> $request->class_section_id,
                    'attendance_type_id'=> $request->attendance_type_id,
                    'biometric_attendance'=> $request->biometric_attendance,
                    'remark'=> $request->remark,
                    'is_active'=> $request->is_active,
                    'session_id'=>$request->session_id,
                    'domain'=>$request->domain,
                ]);
                 $student_attendances->save();
                 return ['text'=>"Successfully saved",'type'=>"success"];
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student_attendances  $student_attendances
     * @return \Illuminate\Http\Response
     */
    public function show($class_section_id,$date)
    {
        $data=[];
        $sessionid = DB::select('select * from academic_years where is_active="yes"',[]);
        $check = DB::select('select * from student_attendances WHERE class_section_id=? and date=? and session_id=?',[$class_section_id,$date,$sessionid[0]->id]);
        if(count($check)>0){
           for($i=0;$i<count($check);$i++){
            $student = DB::select('select * from students where admission_no=? and session_id=? and domain="TS" and is_active="yes"',[$check[$i]->admission_no,$sessionid[0]->id]);
            $data[$i]['id']=$check[$i]->id;
            $data[$i]['name'] = $student[0]->name;
            $data[$i]['admission_no'] = $check[$i]->admission_no;
            $data[$i]['class_section_id'] = $check[$i]->class_section_id;
            $data[$i]['date'] = $check[$i]->date;
            $data[$i]['attendance_type_id'] = $check[$i]->attendance_type_id;
            $data[$i]['biometric_attendance'] = $check[$i]->biometric_attendance;
            $data[$i]['remark'] = $check[$i]->remark;
            $data[$i]['is_active'] =$check[$i]->is_active;;
            $data[$i]['domain'] =$check[$i]->domain;
            $data[$i]['session_id'] = $check[$i]->session_id;
           }
        //    return $data;
           return ['data'=>$data,'text'=>"Attendance Already Submitted As Holiday. You Can Edit Record",'type'=>"warning"];
        }else{
            $student = DB::select('select * from students where class_sections_id=? and session_id=? and domain="TS" and is_active="yes"',[$class_section_id,$sessionid[0]->id]);
            for($i=0;$i<count($student);$i++){
                $data[$i]['name'] = $student[$i]->name;
                $data[$i]['admission_no'] = $student[$i]->admission_no;
                $data[$i]['class_section_id'] = $student[$i]->class_sections_id;
                $data[$i]['date'] = $date;
                $data[$i]['attendance_type_id'] = '1';
                $data[$i]['biometric_attendance'] = '';
                $data[$i]['remark'] ='';
                $data[$i]['is_active'] ='yes';
                $data[$i]['domain'] =$student[$i]->domain;
                $data[$i]['session_id'] = $student[$i]->session_id;
            }
            return ['data'=>$data,'text'=>"",'type'=>""];
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student_attendances  $student_attendances
     * @return \Illuminate\Http\Response
     */
    public function edit(student_attendances $student_attendances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student_attendances  $student_attendances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student_attendances $student_attendances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student_attendances  $student_attendances
     * @return \Illuminate\Http\Response
     */
    public function destroy(student_attendances $student_attendances)
    {
        //
    }
}
