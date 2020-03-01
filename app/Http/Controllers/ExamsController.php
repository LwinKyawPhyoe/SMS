<?php

namespace App\Http\Controllers;

use App\exams;
use App\AcademicYear;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
   
    public function index()
    {   $academicYearId1 = $this->getAcademicActiveId();
        $exams = exams::where('session_id',$academicYearId1)->where('is_active','yes')->where('domain','TS')->get();
        return response($exams);
        // return response($academicYearId1);
        
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
        //
    }

    public function store(Request $request)
    {
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
                    'session_id'=>$request->input('session_id'),
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
