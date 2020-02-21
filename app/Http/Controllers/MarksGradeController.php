<?php

namespace App\Http\Controllers;

use App\marksGrade;
use App\AcademicYear;
use App\class_section;
use App\assign_subject;
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

        $class_sectoin =class_section::where('domain','TS')->where('session_id',$academicYearID)->where('is_active','yes')->where('class_id',$idsArray[2])->where('section_id',$idsArray[4])->get();
        $class_sectoin_id = '';
        foreach($class_sectoin as $class_sectoin1){
            $class_sectoin_id = $class_sectoin1->id;
        }
        $assign_subject = assign_subject::where('class_section_id',$class_sectoin_id)->where('domain','TS')->where('session_id',$academicYearID)->where('is_active','yes')->get();
        foreach($assign_subject as $assign_subject1){
            print_r($assign_subject1->id);
        }
    }
}
