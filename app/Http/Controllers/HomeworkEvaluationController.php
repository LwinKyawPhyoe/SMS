<?php

namespace App\Http\Controllers;
use App\homework_evaluation;
use App\class_section;
use App\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeworkEvaluationController extends Controller
{

    public function index()
    {
        $evaluation = homework_evaluation::where('is_active','yes')->where('domain','TS')->get();
        return $evaluation;
    }

    public function store(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $evaluation = new homework_evaluation([
            "homework_id"           =>      $request->homework_id,
            "com_admission_no"      =>      $request->com_admission_no,
            "incom_admission_no"    =>      $request->incom_admission_no,
            "date"                  =>      $request->date,
            "session_id"            =>      $sessionid[0]->id,
            "is_active"             =>      'yes',
            "domain"                =>      'TS'
        ]);
        $evaluation->save();
        return response()->json(['text' => 'Homework Evaluation added successfully', 'type' => 'success']);
    }

    public function show(Request $request)
    {
        $evaluation = homework_evaluation::where('is_active','yes')->where('domain','TS')
                        ->where('homework_id',$request->id)->get();
        return $evaluation;
    }

    public function update(Request $request)
    {
        $evaluation = homework_evaluation::find($request->id);
        $evaluation->update([
            "homework_id"           =>      $request->homework_id,
            "com_admission_no"      =>      $request->com_admission_no,
            "incom_admission_no"    =>      $request->incom_admission_no,
            "date"                  =>      $request->date,
        ]);
        
        return response()->json(['text' => 'Homework Evaluation updated successfully', 'type' => 'success']);
    }

    public function searchEvaluation(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
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
                    AND home.class_section_id=? ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,
        $sessionid[0]->id,$sessionid[0]->id,$ClassSectionID[0]->id]);
        return $classList;
    }

    public function searchEvaluationSub(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
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
                    AND home.class_section_id=? AND home.subject_id=? ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,
        $sessionid[0]->id,$sessionid[0]->id,$ClassSectionID[0]->id,$request->subject]);
        return $classList;
    }
}
