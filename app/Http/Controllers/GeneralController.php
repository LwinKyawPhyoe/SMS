<?php

namespace App\Http\Controllers;

use App\general;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalSettings = general::find('1')->toArray();
        return array_reverse($generalSettings);
    }

    public function getColor() {
        $generals = general::all()->toArray();
        return array_reverse($generals);
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
    public function store($id)
    {
        $general = new general([
            'color' => $id
        ]);
        $general->save();
        return response()->json($general);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\general  $general
     * @return \Illuminate\Http\Response
     */
    public function show(general $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\general  $general
     * @return \Illuminate\Http\Response
     */
    public function edit(general $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\general  $general
     * @return \Illuminate\Http\Response
     */
    public function update($color)
    {
        $general = general::find(1);
        $general->update([
            "color" => $color
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\general  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(general $general)
    {
        //
    }
}
