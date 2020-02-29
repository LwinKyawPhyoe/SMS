<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;
use App\AcademicYear;

class RouteController extends Controller
{
    public function index()
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $route = Route::where('is_active', 'Yes')
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)
                        ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($route);
    }

    public function store(Request $request)
    {
        if($request->input('id') == "")
        {
            return $this->SaveRoute($request);
        }
        else
        {           
            return $this->EditRoute($request);
        }
    }

    public function SaveRoute($request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = Route::where('route_title', $request->input('route_title'))
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)->count(); 
        if ($check > 0)
        {
            $checkActive = Route::where('route_title', $request->input('route_title'))
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
            $route = new Route([
                'route_title' => $request->input('route_title'),
                'fare' => $request->input('fare'),
                'domain' => 'TS',
                'session_id' => $sessionid[0]->id
            ]);

            $route->save();
            return response()->json(['text' => 'Route added successfully', 'type' => 'success']);
        }
    }

    public function EditRoute($request)
    {
        $sessionid = AcademicYear::where('is_active','yes')->where('domain','TS')->get('id');
        $check = Route::where('route_title', $request->input('route_title'))
                        ->where('domain', 'TS')
                        ->where('session_id', $sessionid[0]->id)->count(); 
        if ($check > 0)
        {
            $checkActive = Route::where('route_title', $request->input('route_title'))
                            ->where('domain', 'TS')
                            ->where('session_id', $sessionid[0]->id)->get();
            $Route = Route::where('id', $request->input('id'))->get();
            if($checkActive[0]->is_active == 'delete' || $Route[0]->route_title == $request->input('route_title'))
            {                
                $Route[0]->route_title = $request->input('route_title');
                $Route[0]->fare = $request->input('fare');
                $Route[0]->save();
                return response()->json(['text' => 'Route updated successfully', 'type' => 'success']);
            }            
            else        return response()->json(['text' => 'Route already exists!', 'type' => 'error']);
        }
        else
        { 
            $route = Route::find($request->input('id'));            
            $route->update($request->all());

            return response()->json(['text' => 'Route updated successfully', 'type' => 'success']);
        }
    }

    public function edit($id)
    {
        $route = Route::find($id);
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Route::find($id);
        $route->is_active = 'delete';
        $route->save();       
        
        return response()->json(['text' => 'Route deleted successfully', 'type' => 'success']);
    }
}
