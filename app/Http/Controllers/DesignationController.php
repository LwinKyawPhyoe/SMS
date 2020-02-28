<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $designations = Designation::where('is_active','Yes')->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return array_reverse($designations);
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
        $designation = new Designation([
            'designation_name' => $request->input('designation_name'),
        ]);
        $designation->save();
        return response()->json('The Designation successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $designation = Designation::find($id);
        $designation->update($request->all());
        return response()->json('The Designation successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $designation = Designation::find($id);
        $designation->update([
            "is_active" => "No"
        ]);
        return response()->json('The Designation successfully deleted');
    }
}
