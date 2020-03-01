<?php

namespace App\Http\Controllers;

use App\exams;
use App\classes;
use App\Section;
use App\AcademicYear;
use App\class_section;
use App\examSchadule;
use App\assign_subject;
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
}
