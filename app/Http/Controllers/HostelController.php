<?php

namespace App\Http\Controllers;

use App\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hostels = Hostel::where('is_active','Yes')->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return array_reverse($hostels);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // if ($request->input('hostel_name') == "") {
        // } else {
        $request->validate([
            'hostel_name' => 'required'
        ]);
        $hostel = new Hostel([
            'hostel_name' => $request->input('hostel_name'),
            'type'        => $request->input('type'),
            'address'     => $request->input('address'),
            'intake'      => $request->input('intake'),
            'description' => $request->input('description'),
        ]);
        $hostel->save();
        return response()->json(['text' => 'Hostel added successfully', 'type' => 'success']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hostel = Hostel::find($id);
        return response()->json($hostel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $hostel = Hostel::find($id);
        $hostel->update($request->all());
        return response()->json('The Hostel successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $hostel = Hostel::find($id);
        $hostel->update([
            "is_active" => "No"
        ]);
        return response()->json('The Hostel successfully deleted');
    }
    public function search($data)
    {
        $hostel = Hostel::where('hostel_name', 'like', '%' . $data . '%')
            ->orWhere('type' , 'like' , '%' . $data . '%')
            ->orWhere('address' , 'like' , '%' . $data . '%')
            ->orWhere('intake' , 'like' , '%' . $data . '%')
            ->orderBy('id', 'desc')
            ->get()->toArray();
        return array_reverse($hostel);
    }
}
