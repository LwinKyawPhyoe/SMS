<?php

namespace App\Http\Controllers;

use App\assign_subject;
use Illuminate\Http\Request;
use App\class_section;
use App\AcademicYear;
use Illuminate\Support\Facades\DB;

class AssignSubjectController extends Controller
{
    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $query = "SELECT
                    asssub.id AS AssSubId,
                    c.id AS classid,
                    c.class,
                    s.id AS sectionid,
                    s.section,
                    asssub.subject_id,
                    asssub.staff_id
                FROM
                    assign_subjects asssub
                INNER JOIN class_sections cs ON
                    asssub.class_section_id = cs.id
                INNER JOIN classes c ON
                    cs.class_id = c.id
                INNER JOIN Sections s ON
                    cs.section_id = s.id
                WHERE                    
                    asssub.is_active = 'yes' AND cs.is_active = 'yes' AND c.is_active = 'yes' AND s.is_active = 'yes' AND 
                    asssub.domain = 'TS' AND cs.domain = 'TS' AND c.domain = 'TS' AND s.domain = 'TS' AND
                    asssub.session_id = ? AND cs.session_id = ? AND c.session_id = ? AND s.session_id = ?
                ORDER BY
                    cs.class_id";
        $assSubject = DB::select($query, [$sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id]);
        return array_reverse($assSubject);
    }

    public function search(Request $request)
    {        
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
        
        $query = "SELECT
                    asssub.id AS AssSubId,
                    c.id AS classid,
                    c.class,
                    s.id AS sectionid,
                    s.section,
                    asssub.subject_id,
                    asssub.staff_id
                FROM
                    assign_subjects asssub
                INNER JOIN class_sections cs ON
                    asssub.class_section_id = cs.id
                INNER JOIN classes c ON
                    cs.class_id = c.id
                INNER JOIN Sections s ON
                    cs.section_id = s.id
                WHERE
                    asssub.is_active = 'yes' AND cs.is_active = 'yes' AND c.is_active = 'yes' AND s.is_active = 'yes' AND
                    asssub.domain = 'TS' AND cs.domain = 'TS' AND c.domain = 'TS' AND s.domain = 'TS' AND
                    asssub.session_id = ? AND cs.session_id = ? AND c.session_id = ? AND s.session_id = ? AND
                    asssub.class_section_id = ?";
        $AssSubject = DB::select($query, [$sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $sessionid[0]->id, $ClassSectionID[0]->id]);
        return $AssSubject;
    }

    public function editsearch($id)
    {        
        $AssSubId = assign_subject::find($id);        
        $ClassSectionID = class_section::find($AssSubId->class_section_id);        

        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $AssSubject = assign_subject::where('class_section_id', $AssSubId->class_section_id)
                                    ->where('domain', 'TS')
                                    ->where('is_active', 'yes')
                                    ->where('session_id', $sessionid[0]->id)->get()->toArray();
        return response()->json(['assSubject' => $AssSubject, 'classSection' => $ClassSectionID]);
    }

    public function store(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
                                    
        $check = assign_subject::where('class_section_id', $ClassSectionID[0]->id)
                                ->where('domain', 'TS')
                                ->where('session_id', $sessionid[0]->id)->get()->count();        
        if ($check > 0)
        {            
            return $this->SaveAlreadyRecord($request, $sessionid, $ClassSectionID);
        }
        else
        {
            return $this->SaveRecord($request, $sessionid, $ClassSectionID);
        }        
    }

    public function SaveAlreadyRecord($request, $sessionid, $ClassSectionID)
    {
        $checkisActive = assign_subject::where('class_section_id', $ClassSectionID[0]->id)
                            ->where('domain', 'TS')
                            ->where('session_id', $sessionid[0]->id)->get();
        for($a = 0; $a < count($checkisActive); $a++){
            $val = 0;
            if($checkisActive[$a]['is_active'] == 'yes'){
                $val = 1;
                break;
            }
        }

        if($val == 0){                
            DB::Delete('Delete from assign_subjects where class_section_id=? and domain=? and session_id=?',[$checkisActive[0]['class_section_id'],'TS', $sessionid[0]->id]);
        }

        for($d = 0; $d<count($request->delRecord); $d++){                        
            if($request->delRecord[$d]['aID'] != 0)
            {
                DB::Delete('Delete from assign_subjects where id=? and domain=? and session_id=?',[$request->delRecord[$d]['aID'],'TS', $sessionid[0]->id]);                
            }
        }

        for($i = 0; $i < count($request->assignSubject); $i++){               
            if($request->assignSubject[$i]['aID'] != 0)
            {
                $AssSub = assign_subject::find($request->assignSubject[$i]['aID']);
                $AssSub->class_section_id = $ClassSectionID[0]->id;
                $AssSub->subject_id = $request->assignSubject[$i]['SubValue'];
                $AssSub->staff_id = $request->assignSubject[$i]['TeacherValue'];
                $AssSub->save();
                
            }
            else
            {
                $assSubject = new assign_subject([
                    'class_section_id' => $ClassSectionID[0]->id,
                    'subject_id' => $request->assignSubject[$i]['SubValue'],
                    'staff_id' => $request->assignSubject[$i]['TeacherValue'],
                    'description' => "-",
                    'is_active' => "yes",
                    'domain' => 'TS',
                    'session_id' => $sessionid[0]->id
                ]);
                $assSubject->save();
            }            
        }    
        return response()->json(['text' => 'Assign Subject added successfully', 'type' => 'success']);
    }

    public function SaveRecord($request, $sessionid, $ClassSectionID)
    {
        for($i = 0; $i < count($request->assignSubject); $i++){               
            if($request->assignSubject[$i]['aID'] != 0)
            {
                $AssSub = assign_subject::find($request->assignSubject[$i]['aID']);
                $AssSub->class_section_id = $ClassSectionID[0]->id;
                $AssSub->subject_id = $request->assignSubject[$i]['SubValue'];
                $AssSub->staff_id = $request->assignSubject[$i]['TeacherValue'];
                $AssSub->save();
                
            }
            else
            {
                $assSubject = new assign_subject([
                    'class_section_id' => $ClassSectionID[0]->id,
                    'subject_id' => $request->assignSubject[$i]['SubValue'],
                    'staff_id' => $request->assignSubject[$i]['TeacherValue'],
                    'description' => "-",
                    'is_active' => "yes",
                    'domain' => 'TS',
                    'session_id' => $sessionid[0]->id
                ]);
                $assSubject->save();
            }            
        }

        return response()->json(['text' => 'Assign Subject added successfully', 'type' => 'success']);
    }

    public function edit(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $ClassSectionID = class_section::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');

        $check = assign_subject::where('class_section_id', $ClassSectionID[0]->id)->where('domain', 'TS')->where('session_id',$sessionid[0]->id)->get()->count();                
        if ($check > 0)
        {
            $checkisActive = assign_subject::where('class_section_id', $ClassSectionID[0]->id)
                            ->where('domain', 'TS')
                            ->where('session_id', $sessionid[0]->id)->get();                       
            
            
            $asssub = assign_subject::where('id', $request->assignSubject[0]['id'])->get();
            if($checkisActive[0]['is_active'] == 'delete' || $asssub[0]['class_section_id'] == $ClassSectionID[0]->id){                 
                DB::Delete('Delete from assign_subjects where class_section_id=? and domain=? and session_id=?',[$checkisActive[0]['class_section_id'],'TS', $sessionid[0]->id]);                
        
                for($i = 0; $i < count($request->assignSubject); $i++){
                    $assSubject = new assign_subject([
                        'class_section_id' => $ClassSectionID[0]->id,
                        'subject_id' => $request->assignSubject[$i]['SubValue'],
                        'staff_id' => $request->assignSubject[$i]['TeacherValue'],
                        'description' => "-",
                        'is_active' => "yes",
                        'domain' => 'TS',
                        'session_id' => $sessionid[0]->id
                    ]);
                    $assSubject->save();                              
                }    
                return response()->json(['text' => 'Assign Subject updated successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Assign Subject already exists', 'type' => 'error']);
        }
        else
        {
            for($d = 0; $d<count($request->delRecord); $d++){                        
                if($request->delRecord[$d]['id'] != 0)
                {
                    DB::Delete('Delete from assign_subjects where id=? and domain=? and session_id=?',[$request->delRecord[$d]['id'],'TS', $sessionid[0]->id]);
                    // $AssSub = assign_subject::find($request->delRecord[$d]['id']);
                    // $AssSub->is_active = "delete";
                    // $AssSub->save();
                }
            }
    
            for($i = 0; $i < count($request->assignSubject); $i++){               
                if($request->assignSubject[$i]['id'] != 0)
                {
                    $AssSub = assign_subject::find($request->assignSubject[$i]['id']);
                    $AssSub->class_section_id = $ClassSectionID[0]->id;
                    $AssSub->subject_id = $request->assignSubject[$i]['SubValue'];
                    $AssSub->staff_id = $request->assignSubject[$i]['TeacherValue'];
                    $AssSub->save();
                    
                }
                else
                {
                    $assSubject = new assign_subject([
                        'class_section_id' => $ClassSectionID[0]->id,
                        'subject_id' => $request->assignSubject[$i]['SubValue'],
                        'staff_id' => $request->assignSubject[$i]['TeacherValue'],
                        'description' => "-",
                        'is_active' => "yes",
                        'domain' => 'TS',
                        'session_id' => $sessionid[0]->id
                    ]);
                    $assSubject->save();
                }            
            }
            return response()->json(['text' => 'Assign Subject updated successfully', 'type' => 'success']);
        }        
    }

    public function destroy($id)
    {        
        $AssSubId = assign_subject::find($id);

        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $AssSubject = assign_subject::where('class_section_id', $AssSubId->class_section_id)
                                    ->where('domain', 'TS')
                                    ->where('is_active', 'yes')
                                    ->where('session_id', $sessionid[0]->id)->get()->toArray();
        
        DB::Update('UPDATE assign_subjects SET is_active=? WHERE class_section_id=?',['delete', $AssSubject[0]['class_section_id']]);
        return response()->json(['text' => 'Assign Subject deleted successfully', 'type' => 'success']);
    }
}
