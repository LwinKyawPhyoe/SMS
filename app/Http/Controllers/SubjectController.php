<?php

namespace App\Http\Controllers;

use App\subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {        
        $sub1 = subject::where('is_active', 'yes')->where('domain', 'TS')->get()->toArray();
        return array_reverse($sub1);
    }

    public function store(Request $request)
    {
        if($request->input('id') == "")
        {
            //Save
            return $this->SaveSubject($request);
        }
        else
        {
            //Update
            return $this->UpdateSubject($request);
        }
    }

    public function SaveSubject($request)
    {
        $check = subject::where('name', $request->input('name'))->count();
        if ($check > 0)
        {
            $checkActive = subject::where('name', $request->input('name'))->get();
            if($checkActive[0]->is_active == 'delete')
            {
                //Save Update is_active
                $checkActive[0]->is_active = "yes";
                $checkActive[0]->code = $request->input('code');
                $checkActive[0]->save(); 
                return response()->json(['text' => 'Subject added successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Subject already exists', 'type' => 'error']);
        }
        else
        {
            //Save
            $sub = new subject([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'type' => $request->input('type'),
                'domain' => 'TS'
            ]);
    
            $sub->save();
            return response()->json(['text' => 'Subject added successfully', 'type' => 'success']);
        }
    }

    public function UpdateSection($request){
        $check = subject::where('name', $request->input('name'))->count();
        if($check > 0)
        {
            $checkActive = subject::where('name', $request->input('name'))->get();
            $Subjects = subject::where('id', $request->input('id'))->get();
            if($checkActive[0]->is_active == 'delete')
            {
                $Subjects[0]->name = $request->input('name');
                $Subjects[0]->code = $request->input('code');
                $Subjects[0]->type = $request->input('type');
                $Subjects[0]->save();               
                return response()->json(['text' => 'Subject updated successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Subject already exists', 'type' => 'error']);
        }
        else
        {
            $sub = subject::find($request->input('id'));
            $sub->update($request->all());
            
            return response()->json(['text' => 'Subject updated successfully', 'type' => 'success']);
        }
    }

    public function edit(subject $id)
    {
        $sub = subject::find($id);
        return response()->json($sub);
    }

    public function destroy($id)
    {
        $sub = subject::find($id);
        $sub->is_active = "delete";
        $sub->save();
        
        return response()->json(['text' => 'Subject deleted successfully', 'type' => 'success']);
    }
}
