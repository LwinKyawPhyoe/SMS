<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {        
        $section = Section::where('is_active', 'yes')->where('domain', 'TS')->get()->toArray();
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
        $check = Section::where('section', $request->input('section'))->where('domain', 'TS')->get()->count();
        if ($check > 0)
        {
            $checkActive = Section::where('section', $request->input('section'))->where('domain', 'TS')->get();
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
                'domain' => 'TS'
            ]);
    
            $section->save();            
            return response()->json(['text' => 'Section added successfully', 'type' => 'success']);
        }
    }

    public function UpdateSection($request){
        $check = Section::where('section', $request->input('section'))->where('domain', 'TS')->get()->count();
        if($check > 0)
        {
            $checkActive = Section::where('section', $request->input('section'))->where('domain', 'TS')->get();
            $Section = Section::where('id', $request->input('id'))->where('domain', 'TS')->get();
            if($checkActive[0]->is_active == 'delete')
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
