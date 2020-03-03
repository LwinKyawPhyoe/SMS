<?php

namespace App\Http\Controllers;

use App\exams;
use App\classes;
use App\Section;
use App\AcademicYear;
use App\class_section;
use App\examResults;
use App\examSchadule;
use App\assign_subject;
use App\SubjectsGetMarks;
use App\ExamStudent;
use App\subject;
use App\marksGrade;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
   
    public function index()
    {   $academicYearId1 = $this->getAcademicActiveId();
        $exams = exams::where('session_id',$academicYearId1)->where('is_active','yes')->where('domain','TS')->get();
        return response($exams);
        
    }
    public function Theinindex()
    {   $academicYearId=$this->getAcademicActiveId();
        $classes = classes::where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->get();
        return response($classes);
    }
    public function Zheinindex()
    {   $academicYearId = $this->getAcademicActiveId();
        $section = Section::where('is_active', 'yes')->where('domain', 'TS')->where('session_id',$academicYearId)->get();
        return response($section);
    }
    public function getAssignSub_id($arrayids){
        $academicYearId = $this->getAcademicActiveId();
        $examNames = [];
        $responseExamNames = [];
        $finalResponse = [];
        $class_section_ids=class_section::where('class_id',$arrayids[0])->where('section_id',$arrayids[2])->where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->get();

        foreach($class_section_ids as $class_section_ids){
        $assign_subject=assign_subject::where('class_section_id',$class_section_ids->id)->where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->get();
        foreach($assign_subject as $assign_subject1){
            
            $exam_schadule = examSchadule::where('assign_subject_id',$assign_subject1->id)->where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->get();
            foreach($exam_schadule as $exam_schadule1){
                $exams = exams::where('id',$exam_schadule1->exam_id)->get();
                foreach($exams as $exams1){
                    array_push($examNames,$exams1->name);
                }
            }
        }
        }
        $checkValue = 'aa';
        for($i=0;$i<count($examNames);$i++){
            if($examNames[$i] == $checkValue){
            }else{
                array_push($responseExamNames,$examNames[$i]);
            }
            $checkValue = $examNames[$i];
        }
        foreach($responseExamNames as $responseExamNames1){
            $exam = exams::where('name',$responseExamNames1)->where('domain','TS')->where('session_id',$academicYearId)->where('is_active','yes')->get();
            foreach($exam as $exam1){
                array_push($finalResponse,$exam1);
            }
        }
        return response($finalResponse);
        
    }
    

    public function CSZTheinindex($id)
    {   $academicYearId= $this->getAcademicActiveId();
        $array = [];
        $objects= [];
        $sections = class_section::where('class_id', $id)->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();
        
        foreach($sections as $sections){
            
            $section = Section::where('id',$sections->section_id)->where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->get();
            foreach($section as $section){
                array_push($array,$section);
            }
            
        }

        return $array;
    }
    public function getAcademicActiveId(){
        $academicYear = AcademicYear::where('is_active','yes')->where('domain','TS')->get();
        $academicYearId ;
        foreach($academicYear as $academicYear1){
            $academicYearId = $academicYear1->id;
        }
        return $academicYearId;
    }
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $academicYearId1 = $this->getAcademicActiveId();
        if($request->input('id') == "")
        {          
            //Save  
            $request->validate([
                'name' => 'required'
            ]);

            $check = exams::where('name', $request->input('name'))->count();            
            if ($check > 0)
            {
                $checkActive = exams::where('name', $request->input('name'))->get();                
                if($checkActive[0]->is_active == 'delete')
                {
                    //Save Update is_active
                    $checkActive[0]->is_active = "yes";
                    $checkActive[0]->save(); 
                    return response()->json('Exam added successfully');
                }
                else        return response()->json('Exam already exists!');                
            }
            else
            {   
                $exams = new exams([
                    'name' => $request->input('name'),
                    'remark'=>$request->input('remark'),
                    'session_id'=>$academicYearId1,
                    'domain' => 'TS',
                    'is_active' => 'yes'
                ]);
        
                $exams->save();
                return response()->json('Exam added successfully');
            }
        }
        else
        {       
            //Update     
            $exmas = exams::find($request->input('id'));
            $exmas->update($request->all());
            return response()->json('Exam updated successfully');
        }
    }

    
    public function show(exams $exams)
    {
        //
    }

    
    public function edit($id)
    {
        $exams = exams::find($id);
        return response()->json($exams);
    }

    
    public function update(Request $request, exams $exams)
    {
        //
    }

    
    public function destroy($id)
    {
        $exams = exams::find($id);        

        $exams->is_active = "delete";
        $exams->save();    

        return response()->json('Exam deleted successfully');
    }
    public function getStudentExam($admission_no){
        
        $academicYearId = $this->getAcademicActiveId();
        $exam_result = examResults::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('admission_no',$admission_no)->get();
        $returnArray = [];
        $exam_Name = [];
        $examName = '';
        $reCheckExamData = '';
        foreach($exam_result as $exam_result1){
            
            $SubjectsGetMarks = new SubjectsGetMarks();

            $exam_schadule = examSchadule::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('id',$exam_result1->exam_schadule_id)->get();
            foreach($exam_schadule as $exam_schadule1){
                
                if($exam_schadule1->exam_id != $examName){
                    array_push($exam_Name,$exam_schadule1);
                }
                $examName = $exam_schadule1->exam_id;
            }
        }

            foreach($exam_Name as $exam_Name1){
                
                $ExamStudent = new ExamStudent();
                $exams = exams::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('id',$exam_Name1->exam_id)->get();
                $ExamStudent->name = $exams[0]->name;
                $Exam_Data = [];
                $exam_schadule2 = examSchadule::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('exam_id',$exam_Name1->exam_id)->get();
                $totalResult = 'passed';
                $totalGetMarks = 0;
                $totalFullMarks = 0;
                foreach($exam_schadule2 as $exam_schadule3){
                    
                    $SubjectsGetMarks = new SubjectsGetMarks();

                    $exam_result2 = examResults::where('session_id',$academicYearId)->where('domain','TS')->where('is_active','yes')->where('exam_schadule_id',$exam_schadule3->id)->get();
                    $assign_subject2 = assign_subject::where('is_active','yes')->where('session_id',$academicYearId)->where('domain','TS')->where('id',$exam_schadule3->assign_subject_id)->get();
                    $subjects2 = subject::where('session_id',$academicYearId)->where('domain','TS')->where('is_active','yes')->where('id',$assign_subject2[0]->subject_id)->get();

                    $SubjectsGetMarks->subject_name = $subjects2[0]->name;
                    $SubjectsGetMarks->get_marks = $exam_result2[0]->get_marks;
                    $SubjectsGetMarks->full_marks = $exam_schadule3->full_marks;
                    $SubjectsGetMarks->passing_marks = $exam_schadule3->passing_marks;

                    $totalGetMarks = (int)$exam_result2[0]->get_marks + $totalGetMarks;
                    $totalFullMarks = (int)$exam_schadule3->full_marks + $totalFullMarks;

                    if($exam_result2[0]->get_marks >= $exam_schadule3->passing_marks){
                        $SubjectsGetMarks->result = 'passed';
                    }else{
                        $SubjectsGetMarks->result = 'failed';
                        $totalResult = 'failed';
                    }
                    array_push($Exam_Data,$SubjectsGetMarks);

                }
                $ExamStudent->exam_data = $Exam_Data;
                $ExamStudent->Result = $totalResult;
                $ExamStudent->total_get_marks = $totalGetMarks;
                $ExamStudent->total_full_marks = $totalFullMarks;
                $totalPercentage = $totalGetMarks/$totalFullMarks * 100;
                $ExamStudent->percentage = $totalPercentage ;
                $totalMarksGrade = '';
                $marksGrade = marksGrade::where('session_id',$academicYearId)->where('is_active','yes')->where('domain','TS')->get();
                foreach($marksGrade as $marksGrade1){
                    if($totalPercentage>= $marksGrade1->mark_from && $totalPercentage <= $marksGrade1->marks_upto){
                        $totalMarksGrade = $marksGrade1->name;
                    }
                }
                $ExamStudent->grade = $totalMarksGrade;
                array_push($returnArray,$ExamStudent);
                
            }

        return response($returnArray);

    }
}