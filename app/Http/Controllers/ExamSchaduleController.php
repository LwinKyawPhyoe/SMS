<?php

namespace App\Http\Controllers;

use App\class_section;
use App\examSchadule;
use App\assign_subject;
use App\arrayExamSchadule;
use App\subject;
use App\arrayAssignSubject;
use App\classes;
use App\Section;
use App\AcademicYear;
use Illuminate\Http\Request;

class ExamSchaduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($arrayClassSectionExam)
    {
        $academicYearId = $this->getAcademicActiveId();
        $arrayExamSchadule = [];
        $arrayAssignSubject = [];

        $finalArrayAssignSubject = [];

        $class_section=class_section::where('class_id',$arrayClassSectionExam[2])->where('section_id',$arrayClassSectionExam[4])->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();

        foreach($class_section as $class_section1){}

        $assign_subject = assign_subject::where('class_section_id',$class_section1->id)->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();

        foreach($assign_subject as $assign_subject1){
            array_push($arrayAssignSubject,$assign_subject1);
        }

        foreach($arrayAssignSubject as $arrayAssignSubject1){
            $get_subject = subject::where('id',$arrayAssignSubject1->subject_id)->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();
        
            foreach($get_subject as $get_subject1){

                $exam_schadule = examSchadule::where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->where('assign_subject_id',$arrayAssignSubject1->id)->where('exam_id',$arrayClassSectionExam[0])->get();
                foreach($exam_schadule as $exam_schadule1){
                    array_push($arrayExamSchadule,$exam_schadule1);
                }
            }
            if($arrayExamSchadule == []){
                $objForFinal = new arrayAssignSubject();
                $objForFinal->id = $arrayAssignSubject1->id;
                $objForFinal->subject = $get_subject1->name;
                $objForFinal->date = '';
                $objForFinal->start_time = '';
                $objForFinal->end_time = '';
                $objForFinal->room = '';
                $objForFinal->full_marks = '';
                $objForFinal->passing_marks = '';
                array_push($finalArrayAssignSubject,$objForFinal);
            }else{
                    $objForFinal = new arrayAssignSubject();
                    $objForFinal->subject = $get_subject1->name;
                    $objForFinal->id = $arrayAssignSubject1->id;
                    $objForFinal->date = '';
                    $objForFinal->start_time = '';
                    $objForFinal->end_time = '';
                    $objForFinal->room = '';
                    $objForFinal->full_marks = '';
                    $objForFinal->passing_marks = '';
                foreach($exam_schadule as $exam_schadule1){
                    $objForFinal->id = $arrayAssignSubject1->id;
                    $objForFinal->date = $exam_schadule1->date_of_exam;
                    $objForFinal->start_time = $exam_schadule1->start_time;
                    $objForFinal->end_time = $exam_schadule1->end_time;
                    $objForFinal->room = $exam_schadule1->room_no;
                    $objForFinal->full_marks = $exam_schadule1->full_marks;
                    $objForFinal->passing_marks = $exam_schadule1->passing_marks;
                    }
                    array_push($finalArrayAssignSubject,$objForFinal);
            }
        }
        return response($finalArrayAssignSubject);
    }

    public function getAcademicActiveId(){
        $academicYear = AcademicYear::where('is_active','yes')->where('domain','TS')->get();
        $academicYearId ;
        foreach($academicYear as $academicYear1){
            $academicYearId = $academicYear1->id;
        }
        return $academicYearId;
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
    {   $academicYearId = $this->getAcademicActiveId();
        for($i = 0;$i<count($request->examSchaduleObj);$i++){
            $examSchaduleArraySSES = [];
            $exam_SsSchadule = examSchadule::where('session_id',$academicYearId)->where('exam_id',$request->examSchaduleObj[$i]['exam_id'])->where('assign_subject_id',$request->examSchaduleObj[$i]['assign_subject_id'])->where('is_active','yes')->where('domain','TS')->get();
            foreach($exam_SsSchadule as $exam_SsSchadule1){
                array_push($examSchaduleArraySSES,$exam_SsSchadule1);
            }
            if($examSchaduleArraySSES == []){
                $examSchaudleSaveObj = new examSchadule ([
                    'session_id'=> $academicYearId,
                    'exam_id'=> $request->examSchaduleObj[$i]['exam_id'],
                    'assign_subject_id'=> $request->examSchaduleObj[$i]['assign_subject_id'],
                    'date_of_exam'=> $request->examSchaduleObj[$i]['date_of_exam'],
                    'start_time'=> $request->examSchaduleObj[$i]['start_time'],
                    'end_time'=> $request->examSchaduleObj[$i]['end_time'],
                    'room_no'=> $request->examSchaduleObj[$i]['room_no'],
                    'full_marks'=> $request->examSchaduleObj[$i]['full_marks'],
                    'passing_marks'=> $request->examSchaduleObj[$i]['passing_marks'],
                    'note'=> $request->examSchaduleObj[$i]['note'],
                    'is_active'=> $request->examSchaduleObj[$i]['is_active'],
                    'domain'=>'TS',
                    ]);
                    $examSchaudleSaveObj->save();
            }else{
                $exam_SsSchadule[0]->session_id = $academicYearId;
                $exam_SsSchadule[0]->exam_id = $request->examSchaduleObj[$i]['exam_id'];
                $exam_SsSchadule[0]->assign_subject_id = $request->examSchaduleObj[$i]['assign_subject_id'];
                $exam_SsSchadule[0]->date_of_exam = $request->examSchaduleObj[$i]['date_of_exam'];
                $exam_SsSchadule[0]->start_time = $request->examSchaduleObj[$i]['start_time'];
                $exam_SsSchadule[0]->end_time = $request->examSchaduleObj[$i]['end_time'];
                $exam_SsSchadule[0]->room_no = $request->examSchaduleObj[$i]['room_no'];
                $exam_SsSchadule[0]->full_marks = $request->examSchaduleObj[$i]['full_marks'];
                $exam_SsSchadule[0]->passing_marks = $request->examSchaduleObj[$i]['passing_marks'];
                $exam_SsSchadule[0]->note = $request->examSchaduleObj[$i]['note'];
                $exam_SsSchadule[0]->is_active = $request->examSchaduleObj[$i]['is_active'];

                $exam_SsSchadule[0]->save();
                // $exam_SsSchadule = save($examSchaudleSaveObj->all());
            }
        }
        return response()->json('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\examSchadule  $examSchadule
     * @return \Illuminate\Http\Response
     */
    public function show(examSchadule $examSchadule)
    {
        //
    }

    public function getClassName($class_ID){
        
        $class5 = classes::where('id',$class_ID)->get();
        $Class_Name='';
        foreach($class5 as $class51){
            $Class_Name = $class51->class;
        }
        return response($Class_Name);
    }
    public function getSectionName($section_ID){

        $section5 = Section::where('id',$section_ID)->get();
        $Section_Name = '';
        foreach($section5 as $section51){
            $Section_Name = $section51->section;
        }
        return response($Section_Name);
    }


    public function getExamData($arrayForExamData){

        $academicYearId = $this->getAcademicActiveId();

        $responseExamData = [];

        // print_r($academicYearId);
        // print_r($arrayForExamData[0]);
        // print_r($arrayForExamData[2]);
        // print_r($arrayForExamData[4]);

        $class_section4 = class_section::where('class_id',$arrayForExamData[0])->where('section_id',$arrayForExamData[2])->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();
        foreach($class_section4 as $class_section41){

            $assign_subject4 = assign_subject::where('class_section_id',$class_section41->id)->where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->get();
            foreach($assign_subject4 as $assign_subject41){
                
                $getSubject4 = subject::where('id',$assign_subject41->subject_id)->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();
                
                foreach($getSubject4 as $getSubject41){
                    
                    $exam_schadule4 = examSchadule::where('assign_subject_id',$assign_subject41->id)->where('exam_id',$arrayForExamData[4])->where('session_id',$academicYearId)->where('domain','TS')->where('is_active','yes')->get();
                    foreach($exam_schadule4 as $exam_schadule41){
                        
                        $ExamDataObj = new arrayAssignSubject();
                        $ExamDataObj->id = $assign_subject41->id;
                        $ExamDataObj->subject = $getSubject41->name;
                        $ExamDataObj->date = $exam_schadule41->date_of_exam;
                        $ExamDataObj->start_time = $exam_schadule41->start_time;
                        $ExamDataObj->end_time = $exam_schadule41->end_time;
                        $ExamDataObj->room = $exam_schadule41->room_no;
                        $ExamDataObj->full_marks = $exam_schadule41->full_marks;
                        $ExamDataObj->passing_marks = $exam_schadule41->passing_marks;
                        array_push($responseExamData,$ExamDataObj);
                    }
                }
            }
        }

        return response($responseExamData);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\examSchadule  $examSchadule
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\examSchadule  $examSchadule
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $academicYearId = $this->getAcademicActiveId();
        $returnValue = 'Updated Successfully';
        for($i=0;$i<count($request->examSchaduleObj);$i++){
            $exam_SsSchadule1 = examSchadule::where('session_id',$academicYearId)->where('exam_id',$request->examSchaduleObj[$i]['exam_id'])->where('assign_subject_id',$request->examSchaduleObj[$i]['assign_subject_id'])->where('is_active','yes')->where('domain','TS')->count();
            if($exam_SsSchadule1 > 0){
                $returnValue = 'This Exam Schadule List Is already Exists';
            }
            else{
            $exam_SsSchadule = examSchadule::where('session_id',$academicYearId)->where('exam_id',$id)->where('assign_subject_id',$request->examSchaduleObj[$i]['assign_subject_id'])->where('is_active','yes')->where('domain','TS')->get();
            $exam_SsSchadule[0]->session_id = $academicYearId;
            $exam_SsSchadule[0]->exam_id = $request->examSchaduleObj[$i]['exam_id'];
            $exam_SsSchadule[0]->assign_subject_id = $request->examSchaduleObj[$i]['assign_subject_id'];
            $exam_SsSchadule[0]->date_of_exam = $request->examSchaduleObj[$i]['date_of_exam'];
            $exam_SsSchadule[0]->start_time = $request->examSchaduleObj[$i]['start_time'];
            $exam_SsSchadule[0]->end_time = $request->examSchaduleObj[$i]['end_time'];
            $exam_SsSchadule[0]->room_no = $request->examSchaduleObj[$i]['room_no'];
            $exam_SsSchadule[0]->full_marks = $request->examSchaduleObj[$i]['full_marks'];
            $exam_SsSchadule[0]->passing_marks = $request->examSchaduleObj[$i]['passing_marks'];
            $exam_SsSchadule[0]->note = $request->examSchaduleObj[$i]['note'];
            $exam_SsSchadule[0]->is_active = $request->examSchaduleObj[$i]['is_active'];
            $exam_SsSchadule[0]->save();
            }
        }
        return response($returnValue);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\examSchadule  $examSchadule
     * @return \Illuminate\Http\Response
     */
    public function destroy(examSchadule $examSchadule)
    {
        //
    }
}
