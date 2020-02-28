<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\student_document;
use DB;
class StudentDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->file){
            $file = $request->file;
            $ext = strtolower($file->getClientOriginalExtension());
            $imageName = time() . '.' . $ext;
            $request->file->move(public_path('stu_document'), $imageName);
        }
        $document = new student_document([
            'admission_no'=>$request->admission_no,
            'document_title'=>$request->document_title,
            'document_name'=>$imageName,
            'is_active'=>$request->is_active,
            'domain'=>$request->domain,
            'session_id'=>$request->session_id
        ]);
            $document->save();
            return response()->json("Saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = DB::select('SELECT * FROM student_documents WHERE admission_no=?',[$id]);
        return $documents;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
