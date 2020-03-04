<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $roomtypes = RoomType::where('is_active', 'yes')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($roomtypes);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
        for ($i = 0; $i < count($session); $i++) {
            $roomtype = new RoomType([
                'room_type' => $request->input('room_type'),
                'description' => $request->input('description'),
                'session_id'  => $session[$i]['id'],
                'domain'  => 'TS',
                'is_active' => 'yes',
            ]);
            $roomtype->save();
            return response()->json(['text' => 'RoomType added successfully', 'type' => 'success']);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $roomtype = RoomType::find($id);
        return response()->json($roomtype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roomtype = RoomType::find($id);
        $roomtype->update($request->all());
        return response()->json(['text' => 'RoomType updated successfully', 'type' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $roomtype = RoomType::find($id);
        $roomtype->update([
            "is_active" => "delete"
        ]);
        return response()->json(['text' => 'RoomType deleted successfully', 'type' => 'success']);
    }

    public function search($data)
    {
        $roomtypes = RoomType::where('room_type', 'like', '%' . $data . '%')
            ->orderBy('id', 'desc')
            ->get()->toArray();
        return array_reverse($roomtypes);
    }
}
