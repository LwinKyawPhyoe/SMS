<?php

namespace App\Http\Controllers;

use App\examResults;
use App\AcademicYear;
use App\student;
use App\examSchadule;
use App\assign_subject;
use App\StudentExmaData;
use App\StudentExamDataSubjects;
use App\class_section;
use Illuminate\Http\Request;

class ExamResultsController extends Controller
{
    public function store(Request $request){
        $academicYearId = $this->getAcademicActiveId();
        for($i =0;$i< count($request->examResults);$i++){
            $ExamResultsArray = [];
            $exam_results = examResults::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('admission_no',$request->examResults[$i]['admission_no'])->where('exam_schadule_id',$request->examResults[$i]['exam_schadule_id'])->get();
            foreach($exam_results  as $exam_results1){
                array_push($ExamResultsArray,$exam_results1);
            }
            $attendence = '';
                $get_marks = '';
                if($request->examResults[$i]['attendence'] == 'A'){
                    $attendence = 'A';
                    $get_marks = '0';
                }else{
                    $attendence = 'yes';
                    $get_marks = $request->examResults[$i]['get_marks'];
                }
            if($ExamResultsArray == []){
                $examResultsObj = new examResults([
                    'is_active' => 'yes',
                    'domain' => 'TS',
                    'session_id' => $academicYearId,
                    'attendence' => $attendence,
                    'exam_schadule_id' => $request->examResults[$i]['exam_schadule_id'],
                    'admission_no' => $request->examResults[$i]['admission_no'],
                    'get_marks' => $get_marks,
                    'note' => 'no'
                ]);
                $examResultsObj->save();
            }else{
                $exam_results[0]->get_marks = $get_marks;
                $exam_results[0]->attendence = $attendence;

                $exam_results[0]->save();
            }
        }
    }
    public function getAcademicActiveId(){
        $academicYear = AcademicYear::where('is_active','yes')->where('domain','TS')->get();
        $academicYearId ;
        foreach($academicYear as $academicYear1){
            $academicYearId = $academicYear1->id;
        }
        return $academicYearId;
    }
    public function getExamResultData($idsArray){

        $academicYearId = $this->getAcademicActiveId();
        $returnStudentExamData = [];
        $returnResult = '';
        
        $class_section = class_section::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('class_id',$idsArray[2])->where('section_id',$idsArray[4])->get();
        $class_section_id = '';
        foreach($class_section as $class_section1){
            $class_section_id = $class_section1->id;
        }
        $examSchaduleArray = [];
        $assign_subject = assign_subject::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('class_section_id',$class_section_id)->get();
        foreach($assign_subject as $assign_subject1){
            $exam_schadule =examSchadule::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('assign_subject_id',$assign_subject1->id)->where('exam_id',$idsArray[0])->get();
            foreach($exam_schadule as $exam_schadule1){
                array_push($examSchaduleArray,$exam_schadule1);
            }
        }
        $students = student::where('session_id',$academicYearId)->where('domain','TS')->where('is_active','yes')->where('class_sections_id',$class_section_id)->get();
        if(count($students) >0){
            if(count($examSchaduleArray) > 0){
                foreach($students as $students1){
                    $StudentExamData = new StudentExmaData();
                    $StudentExamData->admission_no = $students1->admission_no;
                    $StudentExamData->roll_number = $students1->roll_no;
                    $StudentExamData->student_name = $students1->name;
                    $StudentExamData->father_name = $students1->father_name;
                    $studentExamDataSubjects = [];
                    $grandTotal = 0;
                    $fullMarks = 0;
                    $result = 'pass';
                    foreach($examSchaduleArray as $examSchaduleArray1){
                        $fullMarks = $fullMarks + (int)$examSchaduleArray1->full_marks;
                        $exam_results = examResults::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('exam_schadule_id',$examSchaduleArray1->id)->where('admission_no',$students1->admission_no)->get();
                        
                            if(count($exam_results) > 0){
                                foreach($exam_results as $exam_results1){
                                    $studentExamDataSubjectsObj = new StudentExamDataSubjects();
                                    $studentExamDataSubjectsObj->get_marks = $exam_results1->get_marks;
                                    $studentExamDataSubjectsObj->passing_marks = $examSchaduleArray1->passing_marks;
                                    $studentExamDataSubjectsObj->exam_schadule_id = $exam_results1->exam_schadule_id;
                                    $studentExamDataSubjectsObj->attendence = $exam_results1->attendence;
                                    $studentExamDataSubjectsObj->full_marks = $examSchaduleArray1->full_marks;
                                    $studentExamDataSubjectsObj->id = $examSchaduleArray1->id;
                                    array_push($studentExamDataSubjects,$studentExamDataSubjectsObj);
                                    $grandTotal = $grandTotal + (int)$exam_results1->get_marks;
                                    if($exam_results1->get_marks < $examSchaduleArray1->passing_marks){
                                        $result = 'failed';
                                    }
                                }
                            }else{
                                $studentExamDataSubjectsObj = new StudentExamDataSubjects();
                                    $studentExamDataSubjectsObj->get_marks = 'No Marks';
                                    $studentExamDataSubjectsObj->passing_marks = $examSchaduleArray1->passing_marks;
                                    $studentExamDataSubjectsObj->exam_schadule_id = $exam_results1->exam_schadule_id;
                                    $studentExamDataSubjectsObj->attendence = $exam_results1->attendence;
                                    $studentExamDataSubjectsObj->full_marks = $examSchaduleArray1->full_marks;
                                    $studentExamDataSubjectsObj->id = $examSchaduleArray1->id;
                                    array_push($studentExamDataSubjects,$studentExamDataSubjectsObj);
                            }
                    }
                    if(count($studentExamDataSubjects) >0 ){
                        $StudentExamData->subjects = $studentExamDataSubjects;
                        $StudentExamData->grand_total = $grandTotal;
                        $perCent = $grandTotal/$fullMarks * 100;
                        $stringPercent = (string)$perCent;
                        $subStringPercent = substr($stringPercent,0,5);
                        $StudentExamData->Result = $result;
                        $StudentExamData->percent = $subStringPercent;
                        
                        array_push($returnStudentExamData,$StudentExamData);
                    }else{
                        $returnResult = 'no';
                    }
        
                }
            }else{
                $returnResult = 'no';
            }
        }else{
            $returnResult = 'no';
        }

        if($returnResult == 'no'){
            return response('no data');
        }else{
            return response($returnStudentExamData);
        }

    }
    public function update(Request $request){
        $academicYearId = $this->getAcademicActiveId();
        $success = 'Exam Result is updated Successfully';
        for($i=0;$i<count($request->Examresult);$i++){
            $attendence = '';
            $get_marks = '';
            if($request->Examresult[$i]['attendence'] == 'A'){
                $attendence = 'A';
                $get_marks = '0';
            }else{
                $attendence = 'yes';
                $get_marks = $request->Examresult[$i]['get_marks'];
            }

            $exam_results = examResults::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearId)->where('exam_schadule_id',$request->Examresult[$i]['exam_schadule_id'])->where('admission_no',$request->Examresult[$i]['admission_no'])->get();
            $exam_results[0]->get_marks = $get_marks;
            $exam_results[0]->attendence = $attendence;
            $exam_results[0]->save();
            print_r($request->Examresult[$i]['get_marks']);
            foreach($exam_results as $exam_results1){
                print_r($exam_results1->get_marks);
            }
        }
        return response($success);
    }
}