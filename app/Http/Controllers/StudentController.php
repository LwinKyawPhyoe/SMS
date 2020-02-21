<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $allHostel = DB::select('select * from hostels where is_active="yes" and domain="TS" ');
        $allClass = DB::select('select * from classes where is_active="yes"  and domain="TS" and session_id="1" ');
        
        return ['class'=>$allClass,'hostel'=>$allHostel];
    }
    public function upload(Request $req){
        echo $req->file('image')->store('public');
        echo $req->file('father_photo')->store('public');
        echo $req->file('mother_photo')->store('public');
        echo $req->file('guardian_photo')->store('public');
    }

    public function section($id){
        $section = [];
        $classsection = DB::select('SELECT * FROM class_sections WHERE class_id =? AND is_active="yes"',[$id]);
        for($i = 0;$i<count($classsection);$i++){
            $test = DB::select('SELECT * FROM sections WHERE id=?',[$classsection[$i]->section_id]);
            foreach($test as $test1){
                array_push($section,$test1);
            }
        }
        return($section);
    }
    public function classSection($class_id,$section_id){
        $classsection = DB::select('SELECT * FROM class_sections WHERE class_id =? AND section_id=? AND is_active="yes"',[$class_id,$section_id]);
        return $classsection;
    }
    public function selectStudent($id){
        $student = DB::select('SELECT * FROM students WHERE class_sections_id=?',[$id]);
        return $student;
    }
    public function selectSibling($id){
        $student = DB::select('SELECT * FROM students WHERE admission_no=? and is_active="yes"',[$id]);
        return $student;
    }
    public function selectHostel($id){
        $rooms = DB::select('SELECT * FROM hostel_rooms WHERE admission_no=? and is_active="yes"',[$id]);
        return $rooms;
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
          $admision_no = DB::select('select * from students where admission_no =?',[$request->input('admission_no')]);
          $email = DB::select('select * from students where email =?',[$request->input('email')]);
          $phone = DB::select('select * from students where mobileno =?',[$request->input('mobileno')]);
          if($admision_no){
            return response()->json("not");
          }else if($email){
            return response()->json("not");
          }
          else{
            $fatherImageName='';
            $motherImageName='';
            $imageName='';
            $guardianImageName='';
            // student image

            if($request->image){
            $file1 = $request->image;
            $ext1 = strtolower($file1->getClientOriginalExtension());
            $imageName = time() . '.' . $ext1;
            $request->image->move(public_path('stu_image'), $imageName);
            }
            
            // father image
            if($request->father_photo){
            $file2 = $request->father_photo;
            $ext2 = strtolower($file2->getClientOriginalExtension());
            $fatherImageName = time() . '.' . $ext2;
            $request->father_photo->move(public_path('father_image'), $fatherImageName);
            }
            

            // mother image
            if($request->mother_photo){
            $file3 = $request->mother_photo;
            $ext3 = strtolower($file3->getClientOriginalExtension());
            $motherImageName = time() . '.' . $ext3;
            $request->mother_photo->move(public_path('mother_image'), $motherImageName);
            }
            
            // guardian image
            if($request->guardian_photo){
                $file4 = $request->guardian_photo;
                $ext4 = strtolower($file4->getClientOriginalExtension());
                $guardianImageName = time() . '.' . $ext4;
                $request->guardian_photo->move(public_path('guardian_image'), $guardianImageName);
            }
        

            $student = new student([
                'admission_no'=>$request->admission_no,
                'name'=>$request->name,
                'image'=>$imageName,
                'mobileno'=>$request->mobileno,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'dob'=>$request->dob,
                'religion'=>$request->religion,
                'blood_group'=>$request->blood_group,
                'height'=>$request->height,
                'weight'=>$request->weight,
  
                'roll_no'=>$request->roll_no,
                'class_sections_id'=>$request->class_sections_id,
                'admission_date'=>$request->admission_date,
                'register_date'=>$request->register_date,
                'father_name'=>$request->father_name,
                'father_phone'=>$request->father_phone,
                'father_nrc'=>$request->father_nrc,
                'father_job'=>$request->father_job,
                'father_photo'=>$fatherImageName,
  
                'mother_name'=>$request->mother_name,
                'mother_phone'=>$request->mother_phone,
                'mother_nrc'=>$request->mother_nrc,
                'mother_job'=>$request->mother_job,
                'mother_photo'=>$motherImageName,
  
                'guardian_name'=>$request->guardian_name,
                'guardian_nrc'=>$request->guardian_nrc,
                'guardian_phone'=>$request->guardian_phone,
                'guardian_job'=>$request->guardian_job,
                'guardian_relation'=>$request->guardian_relation,
                'guardian_email'=>$request->guardian_email,
                'guardian_photo'=>$guardianImageName,
                'guardian_address'=>$request->guardian_address,
                'current_address'=>$request->current_address,
                'permanent_address'=>$request->permanent_address,
                'previous_school'=>$request->previous_school,
                'route_id'=>$request->route_id,
                'hostel_room_id'=>$request->hostel_room_id,
                'session_start'=>$request->session_start,
                'session_end'=>$request->session_end,
                'note'=>$request->note,
                'disable_at'=>$request->disable_at,
                'is_active'=>$request->is_active,
                'domain'=>$request->domain,
                'session_id'=>$request->session_id,
            ]);
            $student->save();
            return response()->json("Save Success");
          }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        //
    }
}
