<?php

namespace App\Http\Controllers;

use App\assignclassteacher;
use Illuminate\Http\Request;
use App\AcademicYear;

class AssignclassteacherController extends Controller
{

    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $assclassteacher = assignclassteacher::where('is_active', 'yes')
                                            ->where('domain', 'TS')
                                            ->where('session_id', $sessionid[0]->id)
                                            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($assclassteacher);
    }

    public function search(Request $request)
    {        
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $assclassteacher = assignclassteacher::where('class_id', $request->input('class_id'))
                                            ->where('section_id', $request->input('section_id'))
                                            ->where('is_active', 'yes')
                                            ->where('domain', 'TS')
                                            ->where('session_id', $sessionid[0]->id)
                                            ->orderBy('id', 'DESC')->get()->toArray();
        return $assclassteacher;                        
    }

    public function store(Request $request)
    {
        if($request->input('id') == "")
        {
            return $this->SaveAssClassTeacher($request);
        }
        else
        {
            return $this->UpdateAssClassTeacher($request);
        }        
    }

    public function SaveAssClassTeacher($request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = assignclassteacher::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get()->count();
        if($check > 0)
        {
            $checkActive = assignclassteacher::where('class_id', $request->input('class_id'))
                                                ->where('section_id', $request->input('section_id'))
                                                ->where('domain', 'TS')
                                                ->where('session_id', $sessionid[0]->id)->get();
            if($checkActive[0]->is_active == 'delete')
            {
                //Save Update is_active
                $checkActive[0]->is_active = 'yes';
                $checkActive[0]->staff_id = $request->input('Teacher');
                $checkActive[0]->save();
                return response()->json(['text' => 'Class Teacher added successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Record already exists', 'type' => 'error']);
        }
        else
        {
            $assignclassteacher = new assignclassteacher([
                'class_id' => $request->input('class_id'),
                'staff_id' => $request->input('Teacher'),
                'section_id' => $request->input('section_id'),
                'domain' => 'TS',
                'session_id' => $sessionid[0]->id
            ]);    
            $assignclassteacher->save();
            return response()->json(['text' => 'Class Teacher added successfully', 'type' => 'success']);
        }        
    }

    public function UpdateAssClassTeacher($request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = assignclassteacher::where('class_id', $request->input('class_id'))
                                    ->where('section_id', $request->input('section_id'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get()->count();
        if($check > 0)
        {
            $checkActive = assignclassteacher::where('class_id', $request->input('class_id'))
                                            ->where('section_id', $request->input('section_id'))
                                            ->where('domain', 'TS')
                                            ->where('session_id', $sessionid[0]->id)->get();
            $assclassteacher = assignclassteacher::where('id', $request->input('id'))->get();
            if($checkActive[0]->is_active == 'delete' ||
                ($assclassteacher[0]->class_id == $request->input('class_id') && $assclassteacher[0]->section_id == $request->input('section_id')))
            {
                //Save Update is_active
                $assclassteacher[0]->class_id = $request->input('class_id');
                $assclassteacher[0]->staff_id = $request->input('Teacher');
                $assclassteacher[0]->section_id = $request->input('section_id');
                $assclassteacher[0]->save(); 
                return response()->json(['text' => 'Class Teacher updated successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Record already exists', 'type' => 'error']);
        }
        else
        {
            $assclassteacher = assignclassteacher::find($request->input('id'));
            $assclassteacher->class_id = $request->input('class_id');
            $assclassteacher->staff_id = $request->input('Teacher');
            $assclassteacher->section_id = $request->input('section_id');
            $assclassteacher->save();
            return response()->json(['text' => 'Class Teacher updated successfully', 'type' => 'success']);
        }        
    }

    public function destroy($id)
    {        
        $assclassteacher = assignclassteacher::find($id);
        $assclassteacher->is_active = "delete";
        $assclassteacher->save();
        
        return response()->json(['text' => 'Class Teacher deleted successfully', 'type' => 'success']);
    }
}
