<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\HostelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $hostelrooms = HostelRoom::all()->toArray();
        // return array_reverse($hostelrooms);
        $hostelrooms = HostelRoom::where('is_active','Yes')->with('roomType', 'hostel')->orderBy('id', 'desc')->get()->toArray();
        return array_reverse($hostelrooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $hostelroom = new HostelRoom([
            "room_no" => $request->input("room_no"),
            "hostel_id" =>  $request->input("hostel_id"),
            "room_type_id" => $request->input("room_type_id"),
            "no_of_bed" => $request->input("no_of_bed"),
            "cost_per_bed" => $request->input("cost_per_bed"),
            "description" => $request->input("description"),
        ]);
        $hostelroom->save();
        return response()->json('The HostelRoom successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HostelRoom  $hostelRoom
     * @return \Illuminate\Http\Response
     */
    public function show(HostelRoom $hostelRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HostelRoom  $hostelRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(HostelRoom $hostelRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HostelRoom  $hostelRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $hostelroom = HostelRoom::find($id);
        $hostelroom->update($request->all());
        return response()->json('The HostelRoom successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HostelRoom  $hostelRoom
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $hostelroom = HostelRoom::find($id);
        $hostelroom->update([
            "is_active" => "No"
        ]);
        return response()->json('The HostelRoom successfully deleted');
    }


    public function search($data)
    {
        // $hostelrooms = DB::table('hostel_rooms')
        //     ->select('hostels.hostel_name as hostel_name')
        //     ->leftJoin('hostels', 'hostels.id', '=', 'hostel_rooms.hostel_id');
        // ->where('hostels.hostel_name' , 'like', '%' . $data . '%')->with('roomType','hostel')->get()->toArray();
        // echo ($hostelrooms);
        $hostelrooms = HostelRoom::where('room_no', 'like', '%' . $data . '%')
            ->orWhere('hostel_id', '=', '"{{$hostel.id}}"', 'like', '%' . $data . '%')
            ->with('roomType', 'hostel')
            ->orderBy('id', 'desc')
            ->get()->toArray();
        return array_reverse($hostelrooms);
    }
}
