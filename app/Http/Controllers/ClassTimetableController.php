<?php

namespace App\Http\Controllers;

use App\class_timetable;
use Illuminate\Http\Request;
use App\class_section;
use App\AcademicYear;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class ClassTimetableController extends Controller
{

    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $query="SELECT
                    classtimetbl.id AS classTimeTblid,
                    c.id AS classid,
                    c.class,
                    s.id AS sectionid,
                    s.section,
                    classtimetbl.subject_id AS subid,
                    sub.name,
                    sub.type,
                    classtimetbl.staff_id,
                    classtimetbl.day,
                    classtimetbl.time_from,
                    classtimetbl.time_to,
                    classtimetbl.room_no
                FROM
                    class_timetables classtimetbl
                INNER JOIN class_sections cs ON
                    classtimetbl.class_section_id = cs.id
                INNER JOIN classes c ON
                    cs.class_id = c.id
                INNER JOIN Sections s ON
                    cs.section_id = s.id
                INNER JOIN subjects sub ON
                    classtimetbl.subject_id = sub.id
                WHERE                    
                    classtimetbl.is_active = 'yes' AND cs.is_active = 'yes' AND c.is_active = 'yes' AND s.is_active = 'yes' AND 
                    classtimetbl.domain = 'TS' AND cs.domain = 'TS' AND c.domain = 'TS' AND s.domain = 'TS' AND
                    classtimetbl.session_id = ? AND cs.session_id = ? AND c.session_id = ? AND s.session_id = ?                    
                ORDER BY classtimetbl.id DESC";
        $classtimetbl = DB::select($query, [$sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id]);
        return array_reverse($classtimetbl);
    }

    public function search(Request $request)
    {                

        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');        
        $ClassTimetbl = class_timetable::where('class_section_id', $ClassSectionID[0]->id)   
                                    ->where('subject_id', $request->input('subject_id'))
                                    ->where('domain', 'TS')
                                    ->where('is_active', 'yes')
                                    ->where('session_id', $sessionid[0]->id)->get()->toArray();        
        
        return $ClassTimetbl;        
    }

    public function viewsearch(Request $request)
    {                
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');

        $query="SELECT
                    classtimetbl.id AS classTimeTblid,
                    c.id AS classid,
                    c.class,
                    s.id AS sectionid,
                    s.section,
                    classtimetbl.subject_id AS subid,
                    sub.name,
                    sub.type,
                    classtimetbl.staff_id,
                    classtimetbl.day,
                    classtimetbl.time_from,
                    classtimetbl.time_to,
                    classtimetbl.room_no
                FROM
                    class_timetables classtimetbl
                INNER JOIN class_sections cs ON
                    classtimetbl.class_section_id = cs.id
                INNER JOIN classes c ON
                    cs.class_id = c.id
                INNER JOIN Sections s ON
                    cs.section_id = s.id
                INNER JOIN subjects sub ON
                    classtimetbl.subject_id = sub.id
                WHERE
                    classtimetbl.is_active = 'yes' AND cs.is_active = 'yes' AND c.is_active = 'yes' AND s.is_active = 'yes' AND 
                    classtimetbl.domain = 'TS' AND cs.domain = 'TS' AND c.domain = 'TS' AND s.domain = 'TS' AND
                    classtimetbl.session_id = ? AND cs.session_id = ? AND c.session_id = ? AND s.session_id = ? AND classtimetbl.class_section_id = ?                  
                ORDER BY classtimetbl.id DESC";
        $classtimetbl = DB::select($query, [$sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $ClassSectionID[0]->id]);
        
        return $classtimetbl;
    }

    public function store(Request $request)
    {        
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');  
                                    
        $ClassTimetbl = class_timetable::where('class_section_id', $ClassSectionID[0]->id)
                                    ->where('subject_id', $request->input('subject_id'))
                                    ->where('domain', 'TS')
                                    ->where('is_active', 'yes')
                                    ->where('session_id', $sessionid[0]->id)->get()->toArray();
        
        if($ClassTimetbl == [])
        {
            for($i = 0; $i<count($request->classtimetbl); $i++){                                    
                $classTimetbl = new class_timetable([
                    'class_section_id' => $ClassSectionID[0]->id,
                    'subject_id' => $request->input('subject_id'),
                    'staff_id' => $request->input('staff_id'),
                    'day' => $request->classtimetbl[$i]['day'],
                    'time_from' => $request->classtimetbl[$i]['time_from'],
                    'time_to' => $request->classtimetbl[$i]['time_to'],
                    'room_no' => $request->classtimetbl[$i]['room_no'],                
                    'is_active' => "yes",
                    'domain' => 'TS',
                    'session_id' => $sessionid[0]->id
                ]);
                $classTimetbl->save();
            }
            return response()->json(['text' => 'Class TimeTable added successfully', 'type' => 'success']);
        }
        else
        {
            for($a = 0; $a<count($request->classtimetbl); $a++){
                DB::Delete('Delete from class_timetables where id=?',[$request->classtimetbl[$a]['id']]);                
            }

            for($i = 0; $i<count($request->classtimetbl); $i++){                                    
                $classTimetbl = new class_timetable([
                    'class_section_id' => $ClassSectionID[0]->id,
                    'subject_id' => $request->input('subject_id'),
                    'staff_id' => $request->input('staff_id'),
                    'day' => $request->classtimetbl[$i]['day'],
                    'time_from' => $request->classtimetbl[$i]['time_from'],
                    'time_to' => $request->classtimetbl[$i]['time_to'],
                    'room_no' => $request->classtimetbl[$i]['room_no'],                
                    'is_active' => "yes",
                    'domain' => 'TS',
                    'session_id' => $sessionid[0]->id
                ]);
                $classTimetbl->save();
            }
            return response()->json(['text' => 'Class TimeTable updated successfully', 'type' => 'success']);
        }        
    }
    
    public function destroy($id)
    {
        
    }
}
