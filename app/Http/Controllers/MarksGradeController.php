<?php

namespace App\Http\Controllers;

use App\marksGrade;
use App\AcademicYear;
use App\class_section;
use App\assign_subject;
use App\examSchadule;
use App\fillMarksTH;
use App\student;
use App\subject;
use App\StudentExam;
use App\examResults;
use Illuminate\Http\Request;

class MarksGradeController extends Controller
{
    public function index()
    {   $academicYearID = $this->getAcademicActiveId();
        $marksGrade = marksGrade::where('domain','TS')->where('is_active','yes')->where('session_id',$academicYearID)->get();
        return response($marksGrade);
    }
    public function getAcademicActiveId(){
        $academicYear = AcademicYear::where('is_active','yes')->where('domain','TS')->get();
        $academicYearId ;
        foreach($academicYear as $academicYear1){
            $academicYearId = $academicYear1->id;
        }
        return $academicYearId;
    }

    public function store(Request $request)
    {  
        $academicYearID = $this->getAcademicActiveId();
        if($request->input('id') == "")
        {          
            //Save  
            $request->validate([
                'name' => 'required',
                'mark_from'=>'required',
                'marks_upto'=>'required'
            ]);

            $check = marksGrade::where('name', $request->input('name'))->where('domain','TS')->where('session_id',$academicYearID)->where('mark_from',$request->mark_from)->where('marks_upto')->count();         
            if ($check > 0)
            {
                $checkActive = marksGrade::where('name', $request->input('name'))->where('domain','TS')->where('session_id',$academicYearID)->where('mark_from',$request->mark_from)->where('marks_upto')->get();             
                if($checkActive[0]->is_active == 'delete')
                {
                    $checkActive[0]->is_active = "yes";
                    $checkActive[0]->save();
                    return response()->json('Marks Grade added successfully');
                }
                else    return response()->json('Marks Grade already exists!');                
            }
            else
            {   
                $marksGrade = new marksGrade([
                    'session_id'=>$academicYearID,
                    'domain'=>'TS',
                    'is_active'=>'yes',
                    'name' => $request->input('name'),
                    'mark_from'=>$request->input('mark_from'),
                    'marks_upto'=>$request->input('marks_upto'),
                    'description'=>$request->input('description'),

                ]);
                $marksGrade->save();
                return response()->json('Marks Grade added successfully');
            }
        }
        else
        {       
            
            $request->validate([
                'name' => 'required',
                'mark_from'=>'required',
                'marks_upto'=>'required'
            ]);

            $check = marksGrade::where('name', $request->input('name'))->where('domain','TS')->where('session_id',$academicYearID)->where('mark_from',$request->mark_from)->where('marks_upto')->count();        
            if ($check > 0)
            {
                return response()->json('Marks Grade already exists!');                
            }
            else
            {   
            $marksGrade = marksGrade::find($request->input('id'));
            $marksGrade->update($request->all());
            return response()->json('Marks Grade updated successfully');
            }
        }
    }

    public function edit($id)
    {
        $marksGrade = marksGrade::find($id);
        return response()->json($marksGrade);
    }

    public function destroy($id){
        $marksGrade = marksGrade::find($id);        
        $marksGrade->is_active = "delete";
        $marksGrade->save(); 
        return response()->json('Marks Grade deleted successfully');
    }
    
    public function getSearchData($idsArray){

        $academicYearID = $this->getAcademicActiveId();
        $returnArrayFillMarksTH = [];

        $class_sectoin =class_section::where('domain','TS')->where('session_id',$academicYearID)->where('is_active','yes')->where('class_id',$idsArray[2])->where('section_id',$idsArray[4])->get();
        $class_sectoin_id = '';
        foreach($class_sectoin as $class_sectoin1){
            $class_sectoin_id = $class_sectoin1->id;
        }
        $assign_subject = assign_subject::where('class_section_id',$class_sectoin_id)->where('domain','TS')->where('session_id',$academicYearID)->where('is_active','yes')->get();
        foreach($assign_subject as $assign_subject1){
            $exam_schadule = examSchadule::where('assign_subject_id',$assign_subject1->id)->where('exam_id',$idsArray[0])->where('is_active','yes')->where('session_id',$academicYearID)->where('domain','TS')->get();
            $subject = '';
            $subjects = subject::where('id',$assign_subject1->subject_id)->where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearID)->get();
            foreach($subjects as $subjects1){
                $subject = $subjects1->name;
            }
            foreach($exam_schadule as $exam_schadule1){
            $fillMarksTHObj = new fillMarksTH();
            $fillMarksTHObj->subject = $subject;
            $fillMarksTHObj->full_marks = $exam_schadule1->full_marks;
            $fillMarksTHObj->passing_marks = $exam_schadule1->passing_marks;
            array_push($returnArrayFillMarksTH,$fillMarksTHObj);
            }

        }
        return response($returnArrayFillMarksTH);
    }
    public function GetStudentAndExam($idsArray){

        $returnArrayStudentExam = [];
        $returnResult = '';

        $academicYearID = $this->getAcademicActiveId();
        $class_sectoin = class_section::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearID)->where('class_id',$idsArray[2])->where('section_id',$idsArray[4])->get();
        $class_section_id = '';
        foreach($class_sectoin as $class_sectoin1){
            $class_section_id = $class_sectoin1->id;
        }
        
        $students = student::where('session_id',$academicYearID)->where('domain','TS')->where('is_active','yes')->where('class_sections_id',$class_section_id)->get();
        if(count($students) > 0){
        foreach($students as $students1){
            $StudentExam = new StudentExam();
            $StudentExam->admission_no = $students1->admission_no;
            $StudentExam->roll_no = $students1->roll_no;
            $StudentExam->student_name = $students1->name;
            $assign_subject = assign_subject::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearID)->where('class_section_id',$class_section_id)->get();
            $ExamSchaduleObj = [];
            
                if(count($assign_subject) > 0){
                    foreach($assign_subject as $assign_subject1){
                        $exam_schadule = examSchadule::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearID)->where('exam_id',$idsArray[0])->where('assign_subject_id',$assign_subject1->id)->get();
                        if(count($exam_schadule) > 0){
                            foreach($exam_schadule as $exam_schadule1){  
                                $examResultsObj = [];
                                $exam_results = examResults::where('is_active','yes')->where('domain','TS')->where('session_id',$academicYearID)->where('exam_schadule_id',$exam_schadule1->id)->where('admission_no',$students1->admission_no)->get();
                                foreach($exam_results as $exam_results1){
                                    array_push($examResultsObj,$exam_results1);
                                }
                                if($examResultsObj == []){
                                    
                                    $exam_schadule1->note = '';
                                    array_push($ExamSchaduleObj,$exam_schadule1);
                                }else{
                                foreach($examResultsObj as $examResultsObj1){
                                $exam_schadule1->note = $examResultsObj1->get_marks ;
                                $exam_schadule1->start_time = $examResultsObj1->attendence;
                                array_push($ExamSchaduleObj,$exam_schadule1);
                                }
                            }
                            }
                        }else{
                            $returnResult = 'no';
                        }
                    }
                }else{
                    $returnResult = 'no';
                }
    
                $StudentExam->subjects = $ExamSchaduleObj;
                array_push($returnArrayStudentExam,$StudentExam);
    
            }
            }else{
                $returnResult = 'no';
            }
            if($returnResult == 'no'){
                return response('no data');
            }else{
                return response($returnArrayStudentExam);
            }
    }
}
