<?php

namespace App\Http\Controllers;

use App\homework;
use App\AcademicYear;
use App\class_section;
use App\Section;
use App\Classes;
use App\student;
use App\homework_evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $query =    "SELECT c.id AS classid, c.class, s.id AS sectionid, s.section, 
                    home.id AS homeworkId,sub.id AS subjectid,sub.name AS subject,
                    home.class_section_id, home.homework_date, home.submission_date,
                    home.document, home.description 
                    FROM homeworks home 
                    INNER JOIN subjects sub ON sub.id = home.subject_id
                    INNER JOIN class_sections cs ON home.class_section_id = cs.id 
                    INNER JOIN classes c ON cs.class_id = c.id
                    INNER JOIN Sections s ON cs.section_id = s.id 
                    WHERE home.is_active='yes' AND cs.is_active='yes' 
                    AND c.is_active='yes' AND s.is_active='yes' AND sub.is_active='yes' 
                    AND home.domain='TS' AND cs.domain='TS' 
                    AND c.domain='TS' AND s.domain='TS' AND sub.domain='TS' 
                    AND home.session_id=? AND cs.session_id=? 
                    AND c.session_id=? AND s.session_id=? AND sub.session_id=? 
                    ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id]);
        return $classList;
    }

    public function store(Request $request)
    {
        $fileName = "";
        if($request->document != "undefined"){
            $fileName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('homework_file'), $fileName);
        }
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
        $homework = new homework([
            "class_section_id"      =>      $ClassSectionID[0]->id,
            "session_id"            =>      $sessionid[0]->id,
            "homework_date"         =>      $request->homework_date,
            "submission_date"       =>      $request->submission_date,
            "subject_id"            =>      $request->subject,
            "document"              =>      $fileName,
            "description"           =>      $request->description,
            "is_active"             =>      'yes',
            "domain"                =>      'TS'
        ]);
        $homework->save();
        return response()->json(['text' => 'Homework added successfully', 'type' => 'success']);
    }

    public function edit(Request $request)
    {
        $homework = homework::find($request->homeworkId);
        $fileName = "";
        if($request->document != "undefined"){
            if($homework->document == ""){
                $fileName = time() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('homework_file'), $fileName);
            }else{
                $fileName = time() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path('homework_file'), $fileName);
                $deleteFile = public_path() . '/homework_file/' . $homework->document;
                File::delete($deleteFile);
            }
        }else{
            $fileName = $homework->document;
        }
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
        $homework->update([
            "class_section_id"      =>      $ClassSectionID[0]->id,
            "homework_date"         =>      $request->homework_date,
            "submission_date"       =>      $request->submission_date,
            "subject_id"            =>      $request->subject,
            "document"              =>      $fileName,
            "description"           =>      $request->description,
        ]);
        return response()->json(['text' => 'Homework updated successfully', 'type' => 'success']);
    }

    public function destroy($id)
    {
        homework::destroy($id);
        $evaluation = homework_evaluation::where('homework_id',$id)->get('id');
        homework_evaluation::destroy($evaluation[0]->id);
        return response()->json(['text' => 'Homework deleted successfully', 'type' => 'success']);
    }

    public function showStudent(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $query =    "SELECT id, admission_no, name From students 
                    WHERE is_active='yes' AND domain='TS' 
                    AND session_id=? AND class_sections_id=?";
        $student = DB::select($query,
        [$sessionid[0]->id,$request->id]);
        return $student;
    }

    public function show()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $query =    "SELECT c.id AS classid, c.class, s.id AS sectionid, s.section, 
                    home.id As homeworkId,sub.id AS subjectid,sub.name AS subject,
                    home.class_section_id, home.homework_date, home.submission_date,
                    home.document, home.description , he.homework_id,he.com_admission_no,
                    he.incom_admission_no, he.date
                    FROM homeworks home 
                    INNER JOIN subjects sub ON sub.id = home.subject_id
                    INNER JOIN homework_evaluations he ON he.homework_id = home.id
                    INNER JOIN class_sections cs ON home.class_section_id = cs.id 
                    INNER JOIN classes c ON cs.class_id = c.id 
                    INNER JOIN Sections s ON cs.section_id = s.id 
                    WHERE home.is_active='yes' AND cs.is_active='yes' AND c.is_active='yes' 
                    AND s.is_active='yes' AND he.is_active='yes' AND sub.is_active='yes'
                    AND home.domain='TS' AND cs.domain='TS' AND c.domain='TS' 
                    AND s.domain='TS' AND he.domain='TS' AND sub.domain='TS'
                    AND home.session_id=? AND cs.session_id=?  AND c.session_id=? 
                    AND s.session_id=? AND he.session_id=? AND sub.session_id=?
                    ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id]);
        return $classList;
    }

    public function searchHomework(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
        $query =    "SELECT c.id AS classid, c.class, s.id AS sectionid, s.section, 
                    home.id AS homeworkId,sub.id AS subjectid,sub.name AS subject,
                    home.class_section_id, home.homework_date, home.submission_date,
                    home.document, home.description 
                    FROM homeworks home 
                    INNER JOIN subjects sub ON sub.id = home.subject_id
                    INNER JOIN class_sections cs ON home.class_section_id = cs.id 
                    INNER JOIN classes c ON cs.class_id = c.id
                    INNER JOIN Sections s ON cs.section_id = s.id 
                    WHERE home.is_active='yes' AND cs.is_active='yes' 
                    AND c.is_active='yes' AND s.is_active='yes' AND sub.is_active='yes' 
                    AND home.domain='TS' AND cs.domain='TS' 
                    AND c.domain='TS' AND s.domain='TS' AND sub.domain='TS' 
                    AND home.session_id=? AND cs.session_id=? 
                    AND c.session_id=? AND s.session_id=? AND sub.session_id=? 
                    AND home.class_section_id=? ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,
        $sessionid[0]->id,$ClassSectionID[0]->id]);
        return $classList;
    }

    public function searchHomeworkSub(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
        $query =    "SELECT c.id AS classid, c.class, s.id AS sectionid, s.section, 
                    home.id AS homeworkId,sub.id AS subjectid,sub.name AS subject,
                    home.class_section_id, home.homework_date, home.submission_date,
                    home.document, home.description 
                    FROM homeworks home 
                    INNER JOIN subjects sub ON sub.id = home.subject_id
                    INNER JOIN class_sections cs ON home.class_section_id = cs.id 
                    INNER JOIN classes c ON cs.class_id = c.id
                    INNER JOIN Sections s ON cs.section_id = s.id 
                    WHERE home.is_active='yes' AND cs.is_active='yes' 
                    AND c.is_active='yes' AND s.is_active='yes' AND sub.is_active='yes' 
                    AND home.domain='TS' AND cs.domain='TS' 
                    AND c.domain='TS' AND s.domain='TS' AND sub.domain='TS' 
                    AND home.session_id=? AND cs.session_id=? 
                    AND c.session_id=? AND s.session_id=? AND sub.session_id=? 
                    AND home.class_section_id=? AND home.subject_id=? ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,
        $sessionid[0]->id,$ClassSectionID[0]->id,$request->subject]);
        return $classList;
    }

}
