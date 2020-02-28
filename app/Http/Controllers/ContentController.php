<?php

namespace App\Http\Controllers;

use App\Content;
use App\AcademicYear;
use App\class_section;
use App\Section;
use App\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $content = Content::where('is_active','yes')->where('domain','TS')->where('session_id',$sessionid[0]->id)->get()->toArray();
        return $content;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $fileName = time() . '.' . $request->contentFile->getClientOriginalExtension();
        $saved_id = null;
        if($request->Available != "1"){
            if($request->class_section == "true"){
                $saved_id = 0;
            }else{
                $ClassSectionID = class_section::where('class_id', $request->class)
                                    ->where('section_id', $request->section)
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get('id');
                $saved_id = $ClassSectionID[0]->id;
            }
        }
        $check = Content::where('title', $request->title)->where('domain', 'TS')
                                ->where('session_id', $sessionid[0]->id)->get()->count();
        if($check > 0)
        {
            $checkActive = Content::where('title', $request->title)->where('domain', 'TS')
                                ->where('session_id', $sessionid[0]->id)->get();
            if($checkActive[0]->is_active == 'delete'){
                $request->contentFile->move(public_path('content'), $fileName);
                $deleteFile = public_path() . '/content/' . $checkActive[0]->file;
                File::delete($deleteFile);
                $updateContent = Content::find($checkActive[0]->id);
                $updateContent->type = $request->type;
                $updateContent->available_for = $request->Available;
                $updateContent->class_section_id = $saved_id;
                $updateContent->date = $request->date;
                $updateContent->description = $request->description;
                $updateContent->session_id = $sessionid[0]->id;
                $updateContent->file = $fileName;
                $updateContent->is_active = 'yes';
                $updateContent->save();
                return response()->json(['text' => 'Content added successfully', 'type' => 'success']);
            }else{
                return response()->json(['text' => 'Content already exists', 'type' => 'error']);
            }
        }
        else
        {
            $request->contentFile->move(public_path('content'), $fileName);
            $content = new Content([
                "title"                 =>      $request->title,
                "type"                  =>      $request->type,
                "available_for"         =>      $request->Available,
                "class_section_id"      =>      $saved_id,
                "date"                  =>      $request->date,
                "description"           =>      $request->description,
                "session_id"            =>      $sessionid[0]->id,
                "file"                  =>      $fileName,
                "is_active"             =>      'yes',
                "domain"                =>      'TS'
            ]);
            $content->save();
            return response()->json(['text' => 'Content added successfully', 'type' => 'success']);
        }
    }

    public function show(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $content = Content::where('is_active','yes')->where('domain','TS')->where('type',$request->type) 
        ->where('session_id',$sessionid[0]->id)->get()->toArray();
        return $content;
    }

    public function edit(content $content)
    {
        //
    }

    public function update(Request $request, content $content)
    {
        //
    }

    public function destroy($id)
    {
        $content = Content::find($id);        
        $content->is_active = "delete";
        $content->save();
        return response()->json(['text' => 'Content deleted successfully', 'type' => 'success']);
    }
}
