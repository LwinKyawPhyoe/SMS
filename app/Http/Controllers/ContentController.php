<?php

namespace App\Http\Controllers;

use App\Content;
use App\AcademicYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = Content::where('route_title', $request->input('route_title'))
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)->count(); 
        if ($check > 0)
        {
            $checkActive = Content::where('route_title', $request->input('route_title'))
                                    ->where('domain', 'TS')
                                    ->where('session_id', $sessionid[0]->id)->get();
            if($checkActive[0]->is_active == 'delete')
            {
                $checkActive[0]->fare = $request->input('fare');
                $checkActive[0]->is_active = 'Yes';
                $checkActive[0]->save();                
                return response()->json(['text' => 'Route added successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Route already exists!', 'type' => 'error']);
        }
        else
        {
            $content = new Content([
                'route_title' => $request->input('route_title'),
                'fare' => $request->input('fare'),
                'domain' => 'TS',
                'session_id' => $sessionid[0]->id
            ]);

            $content->save();
            return response()->json(['text' => 'Route added successfully', 'type' => 'success']);
        }
    }

    public function show(content $content)
    {
        //
    }

    public function edit(content $content)
    {
        //
    }

    public function update(Request $request, content $content)
    {
        //
    }

    public function destroy(content $content)
    {
        //
    }
}
