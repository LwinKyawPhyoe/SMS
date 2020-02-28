<?php

namespace App\Http\Controllers;

use App\homework;
use App\AcademicYear;
use App\class_section;
use App\Section;
use App\Classes;
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
                    home.id As homeworkId,
                    home.class_section_id, home.homework_date, home.submission_date, home.document, home.description 
                    FROM homeworks home 
                    INNER JOIN class_sections cs ON home.class_section_id = cs.id 
                    INNER JOIN classes c ON cs.class_id = c.id 
                    INNER JOIN Sections s ON cs.section_id = s.id 
                    WHERE home.is_active='yes' AND cs.is_active='yes' AND c.is_active='yes' AND s.is_active='yes' 
                    AND home.domain='TS' AND cs.domain='TS' AND c.domain='TS' AND s.domain='TS' 
                    AND home.session_id=? AND cs.session_id=?  AND c.session_id=? AND s.session_id=? ORDER BY home.id";
        $classList = DB::select($query,
        [$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id,$sessionid[0]->id]);
        return $classList;
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
        return response()->json('Saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\homework  $homework
     * @return \Illuminate\Http\Response
     */
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
        return response()->json('Homework successfully updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, homework $homework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(homework $homework)
    {
        //
    }
}
