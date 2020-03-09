<?php

namespace App\Http\Controllers;

use App\student;
use App\AcademicYear;
use App\class_section;
use App\student_session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class studentPromoteController extends Controller
{
    public function SearchByKeyword($keyword)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $stud = student::where('session_id', $sessionid[0]['id'])->where('is_active','yes')->where('domain','TS')->get()->count();         
        if($stud > 0){
            $query ='SELECT
                        *
                    FROM
                        students
                    WHERE NAME LIKE
                        ? OR admission_no LIKE ? OR father_name LIKE ? OR roll_no LIKE ? OR gender LIKE
                        ? OR religion LIKE ? OR mother_name LIKE ? OR race LIKE ? OR email LIKE ? OR blood_group LIKE
                        ? OR height LIKE ? OR weight LIKE ? OR guardian_name LIKE ? OR mobileno LIKE
                        ? AND domain = "TS" AND session_id = ?';
            $students = DB::select($query,[$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$sessionid[0]['id']]);
            return $students;
        }        
    }

    public function promote(Request $request)
    {
        // note shi yin update lote yan and search shar yan and
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $request->input('promote_session'))->get('id');

        for($i = 0; $i < count($request->promoteStudList); $i++){
            $checkHasRecord = student::where('admission_no', $request->promoteStudList[$i]['admission_no'])
                                    ->where('class_sections_id', $ClassSectionID[0]['id'])                                    
                                    ->where('domain', 'TS')
                                    ->where('session_id', $request->input('promote_session'))->get()->count();
                        
            if($checkHasRecord > 0){                
                $updatestudent = student::find($request->promoteStudList[$i]['id']);
                $updatestudent->update([
                    'result' => $request->promoteStudList[$i]['result'],
                    'session_status' => $request->promoteStudList[$i]['session_status']
                ]);

                $UpdateRecord = student::where('admission_no', $request->promoteStudList[$i]['admission_no'])
                                    ->where('class_sections_id', $ClassSectionID[0]['id'])                                    
                                    ->where('domain', 'TS')
                                    ->where('session_id', $request->input('promote_session'))->get();
                $UpdateRecord[0]->update([
                    'admission_no'=>$request->promoteStudList[$i]['admission_no'],
                    'name'=>$request->promoteStudList[$i]['name'],
                    'image'=>$request->promoteStudList[$i]['image'],
                    'mobileno'=>$request->promoteStudList[$i]['mobileno'],
                    'email'=>$request->promoteStudList[$i]['email'],
                    'gender'=>$request->promoteStudList[$i]['gender'],
                    'dob'=>$request->promoteStudList[$i]['dob'],
                    'religion'=>$request->promoteStudList[$i]['religion'],
                    'blood_group'=>$request->promoteStudList[$i]['blood_group'],
                    'height'=>$request->promoteStudList[$i]['height'],
                    'weight'=>$request->promoteStudList[$i]['weight'],
    
                    'roll_no'=>$request->promoteStudList[$i]['roll_no'],
                    'class_sections_id'=>$ClassSectionID[0]['id'],
                    'admission_date'=>$request->promoteStudList[$i]['admission_date'],
                    'register_date'=>$request->promoteStudList[$i]['register_date'],
                    'father_name'=>$request->promoteStudList[$i]['father_name'],
                    'father_phone'=>$request->promoteStudList[$i]['father_phone'],
                    'father_nrc'=>$request->promoteStudList[$i]['father_nrc'],
                    'father_job'=>$request->promoteStudList[$i]['father_job'],
                    'father_photo'=>$request->promoteStudList[$i]['father_photo'],
    
                    'mother_name'=>$request->promoteStudList[$i]['mother_name'],
                    'mother_phone'=>$request->promoteStudList[$i]['mother_phone'],
                    'mother_nrc'=>$request->promoteStudList[$i]['mother_nrc'],
                    'mother_job'=>$request->promoteStudList[$i]['mother_job'],
                    'mother_photo'=>$request->promoteStudList[$i]['mother_photo'],
    
                    'guardian_name'=>$request->promoteStudList[$i]['guardian_name'],
                    'guardian_nrc'=>$request->promoteStudList[$i]['guardian_nrc'],
                    'guardian_phone'=>$request->promoteStudList[$i]['guardian_phone'],
                    'guardian_job'=>$request->promoteStudList[$i]['guardian_job'],
                    'guardian_relation'=>$request->promoteStudList[$i]['guardian_relation'],
                    'guardian_email'=>$request->promoteStudList[$i]['guardian_email'],
                    'guardian_photo'=>$request->promoteStudList[$i]['guardian_photo'],
                    'guardian_address'=>$request->promoteStudList[$i]['guardian_address'],
                    'current_address'=>$request->promoteStudList[$i]['current_address'],
                    'permanent_address'=>$request->promoteStudList[$i]['permanent_address'],
                    'previous_school'=>$request->promoteStudList[$i]['previous_school'],
                    'route_id'=>$request->promoteStudList[$i]['route_id'],
                    'hostel_room_id'=>$request->promoteStudList[$i]['hostel_room_id'],
                    'session_start'=>$request->promoteStudList[$i]['session_start'],
                    'session_end'=>$request->promoteStudList[$i]['session_end'],
                    'note'=>$request->promoteStudList[$i]['note'],
                    'disable_at'=>$request->promoteStudList[$i]['disable_at'],
                    'is_active'=>$request->promoteStudList[$i]['is_active'],
                    'domain'=>$request->promoteStudList[$i]['domain'],
                    'session_id'=>$request->input('promote_session'),
                    'race'=>$request->promoteStudList[$i]['race'],
                    'result'=> '',
                    'session_status' => ''
                ]);
            }
            else
            {                
                $updatestudent = student::find($request->promoteStudList[$i]['id']);
                //Already Student Update for result and session_status
                $updatestudent->update([
                    'result' => $request->promoteStudList[$i]['result'],
                    'session_status' => $request->promoteStudList[$i]['session_status']
                ]);

                //New Student Save
                $Addstudent = new student([
                    'admission_no'=>$request->promoteStudList[$i]['admission_no'],
                    'name'=>$request->promoteStudList[$i]['name'],
                    'image'=>$request->promoteStudList[$i]['image'],
                    'mobileno'=>$request->promoteStudList[$i]['mobileno'],
                    'email'=>$request->promoteStudList[$i]['email'],
                    'gender'=>$request->promoteStudList[$i]['gender'],
                    'dob'=>$request->promoteStudList[$i]['dob'],
                    'religion'=>$request->promoteStudList[$i]['religion'],
                    'blood_group'=>$request->promoteStudList[$i]['blood_group'],
                    'height'=>$request->promoteStudList[$i]['height'],
                    'weight'=>$request->promoteStudList[$i]['weight'],
    
                    'roll_no'=>$request->promoteStudList[$i]['roll_no'],
                    'class_sections_id'=>$ClassSectionID[0]['id'],
                    'admission_date'=>$request->promoteStudList[$i]['admission_date'],
                    'register_date'=>$request->promoteStudList[$i]['register_date'],
                    'father_name'=>$request->promoteStudList[$i]['father_name'],
                    'father_phone'=>$request->promoteStudList[$i]['father_phone'],
                    'father_nrc'=>$request->promoteStudList[$i]['father_nrc'],
                    'father_job'=>$request->promoteStudList[$i]['father_job'],
                    'father_photo'=>$request->promoteStudList[$i]['father_photo'],
    
                    'mother_name'=>$request->promoteStudList[$i]['mother_name'],
                    'mother_phone'=>$request->promoteStudList[$i]['mother_phone'],
                    'mother_nrc'=>$request->promoteStudList[$i]['mother_nrc'],
                    'mother_job'=>$request->promoteStudList[$i]['mother_job'],
                    'mother_photo'=>$request->promoteStudList[$i]['mother_photo'],
    
                    'guardian_name'=>$request->promoteStudList[$i]['guardian_name'],
                    'guardian_nrc'=>$request->promoteStudList[$i]['guardian_nrc'],
                    'guardian_phone'=>$request->promoteStudList[$i]['guardian_phone'],
                    'guardian_job'=>$request->promoteStudList[$i]['guardian_job'],
                    'guardian_relation'=>$request->promoteStudList[$i]['guardian_relation'],
                    'guardian_email'=>$request->promoteStudList[$i]['guardian_email'],
                    'guardian_photo'=>$request->promoteStudList[$i]['guardian_photo'],
                    'guardian_address'=>$request->promoteStudList[$i]['guardian_address'],
                    'current_address'=>$request->promoteStudList[$i]['current_address'],
                    'permanent_address'=>$request->promoteStudList[$i]['permanent_address'],
                    'previous_school'=>$request->promoteStudList[$i]['previous_school'],
                    'route_id'=>$request->promoteStudList[$i]['route_id'],
                    'hostel_room_id'=>$request->promoteStudList[$i]['hostel_room_id'],
                    'session_start'=>$request->promoteStudList[$i]['session_start'],
                    'session_end'=>$request->promoteStudList[$i]['session_end'],
                    'note'=>$request->promoteStudList[$i]['note'],
                    'disable_at'=>$request->promoteStudList[$i]['disable_at'],
                    'is_active'=>$request->promoteStudList[$i]['is_active'],
                    'domain'=>$request->promoteStudList[$i]['domain'],
                    'session_id'=>$request->input('promote_session'),
                    'race'=>$request->promoteStudList[$i]['race'],
                    'result'=> '',
                    'session_status' => ''
                ]);
                $Addstudent->save();

                //For Student Session
                $session = new student_session([
                    'session_id'=>$request->input('promote_session'),
                    'admission_no'=>$request->promoteStudList[$i]['admission_no'],
                    'class_section_id'=>$ClassSectionID[0]['id'],
                    'route_id'=>$request->promoteStudList[$i]['route_id'],
                    'hostel_room_id'=>$request->promoteStudList[$i]['hostel_room_id'],
                    'is_active'=> $request->promoteStudList[$i]['is_active'],
                    'domain'=>$request->promoteStudList[$i]['domain'],
                ]);
                $session->save();
            }
        }
        return response()->json(['text' => 'Student Promote added successfully', 'type' => 'success']);
    }
}
