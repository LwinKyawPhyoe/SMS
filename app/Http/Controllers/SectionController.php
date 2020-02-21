<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use App\AcademicYear;

class SectionController extends Controller
{

    public function Theinindex()
    {   $academicYearId = $this->getAcademicActiveId();
        $section = Section::where('is_active', 'yes')->where('domain', 'TS')->where('session_id',$academicYearId)->get();
        return response($section);
    }
    public function getAcademicActiveId(){
        $academicYear = AcademicYear::where('is_active','yes')->where('domain','TS')->get();
        $academicYearId ;
        foreach($academicYear as $academicYear1){
            $academicYearId = $academicYear1->id;
        }
        return $academicYearId;
    }

    public function index()
    {        
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $section = Section::where('is_active', 'yes')
                            ->where('domain', 'TS')
                            ->where('session_id', $sessionid[0]->id)
                            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($section);
    }

    public function store(Request $request)
    {   
        if($request->input('id') == "")
        {
            //Save
            return $this->SaveSection($request);
        }
        else
        {
            //Update
            return $this->UpdateSection($request);
        }
    }

    public function SaveSection($request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = Section::where('section', $request->input('section'))
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)->get()->count();
        if ($check > 0)
        {
            $checkActive = Section::where('section', $request->input('section'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get();
            if($checkActive[0]->is_active == 'delete')
            {
                //Save Update is_active
                $checkActive[0]->is_active = "yes";
                $checkActive[0]->save();
                return response()->json(['text' => 'Section added successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Section already exists', 'type' => 'error']);
        }
        else
        {
            $section = new Section([
                'section' => $request->input('section'),
                'domain' => 'TS',
                'session_id' => $sessionid[0]->id
            ]);
    
            $section->save();            
            return response()->json(['text' => 'Section added successfully', 'type' => 'success']);
        }
    }

    public function UpdateSection($request){
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = Section::where('section', $request->input('section'))
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)->get()->count();
        if($check > 0)
        {
            $checkActive = Section::where('section', $request->input('section'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get();
            $Section = Section::where('id', $request->input('id'))->get();
            if($checkActive[0]->is_active == 'delete' || $Section[0]->section == $request->input('section'))
            {
                $Section[0]->section = $request->input('section');                    
                $Section[0]->save();
                return response()->json(['text' => 'Session updated successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Section already exists', 'type' => 'error']);
        }
        else
        {
            $section = Section::find($request->input('id'));            
            $section->update($request->all());
            
            return response()->json(['text' => 'Section updated successfully', 'type' => 'success']);
        }
    }

    public function edit(Section $id)
    {
        $section = Section::find($id);
        return response()->json($section);
    }

    public function destroy($id)
    {        
        $section = Section::find($id);        

        $section->is_active = "delete";
        $section->save();
        
        return response()->json(['text' => 'Section deleted successfully', 'type' => 'success']);
    }
}
