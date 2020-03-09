<?php

namespace App\Http\Controllers;

use App\student;
use App\AcademicYear;
use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    public function index()
    {   
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $allHostel = DB::select('select * from hostels where is_active="Yes" and  session_id=? and domain="TS"',[$sessionid[0]->id]);
        $allClass = DB::select('select * from classes where is_active="yes"  and domain="TS" and session_id=? ', [$sessionid[0]->id]);
        $route = DB::select('select * from routes where is_active="Yes"  and domain="TS" and session_id=? ',[$sessionid[0]->id]);
        return ['class'=>$allClass,'hostel'=>$allHostel,'routes'=>$route,'session'=>$sessionid];
    }
    public function searchsibling($sibling_id){
        $data=[];
        $test=[];
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        // $studnet = DB::select('SELECT * FROM student_siblings WHERE admission_number =? AND is_active="yes" AND session_id=?',[$id,$sessionid[0]->id]);
        $admission_no = DB::select('SELECT * FROM student_siblings WHERE admission_no =? AND is_active="yes" AND domain="TS" AND session_id=?',[$sibling_id,$sessionid[0]->id]);
        $sibling_admission_no = DB::select('SELECT * FROM student_siblings WHERE sibling_admission_no =? AND is_active="yes" AND domain="TS" AND session_id=?',[$sibling_id,$sessionid[0]->id]);

        if($admission_no || $sibling_admission_no){
            if(count($admission_no) > count($sibling_admission_no)){
                $students = DB::select('SELECT * FROM students WHERE admission_no =? AND is_active="yes" and session_id=? and domain="TS"',[$sibling_id,$sessionid[0]->id]);
                $class_section = DB::select('SELECT * FROM class_sections WHERE id =? AND is_active="yes" and session_id=? and domain="TS"',[$students[0]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->class_id,$sessionid[0]->id]);
                $section = DB::select('SELECT * FROM sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->section_id,$sessionid[0]->id]);
                $data[0]['id']=$students[0]->id;
                $data[0]['name']=$students[0]->name;
                $data[0]['admission_no']=$students[0]->admission_no;
                $data[0]['class']=$class[0]->class;
                $data[0]['section'] = $section[0]->section;
                $data[0]['class_sections_id'] =$students[0]->class_sections_id;
                for($i=0;$i<count($admission_no);$i++){
                    $student = DB::select('SELECT * FROM students WHERE admission_no =? AND is_active="yes" and domain="TS" and session_id=?',[$admission_no[$i]->sibling_admission_no,$sessionid[0]->id]);
                    $class_sections = DB::select('SELECT * FROM class_sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$student[0]->class_sections_id,$sessionid[0]->id]);
                    $classes = DB::select('SELECT * FROM classes WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_sections[0]->class_id,$sessionid[0]->id]);
                    $sections = DB::select('SELECT * FROM sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_sections[0]->section_id,$sessionid[0]->id]);
                    $data[$i+1]['id']=$student[0]->id;
                    $data[$i+1]['name']=$student[0]->name;
                    $data[$i+1]['admission_no']=$student[0]->admission_no;
                    $data[$i+1]['class']=$classes[0]->class;
                    $data[$i+1]['section'] = $sections[0]->section;
                    $data[$i+1]['class_sections_id'] =$students[0]->class_sections_id;
                }
                return $data;
            }else if(count($sibling_admission_no)>count($admission_no)){
                $students = DB::select('SELECT * FROM students WHERE admission_no =? AND is_active="yes" and domain="TS" and session_id=?',[$sibling_id,$sessionid[0]->id]);
                $class_section = DB::select('SELECT * FROM class_sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$students[0]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->class_id,$sessionid[0]->id]);
                $section = DB::select('SELECT * FROM sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->section_id,$sessionid[0]->id]);
                $data[0]['id']=$students[0]->id;
                $data[0]['name']=$students[0]->name;
                $data[0]['admission_no']=$students[0]->admission_no;
                $data[0]['class']=$class[0]->class;
                $data[0]['section'] = $section[0]->section;
                $data[0]['class_sections_id'] =$students[0]->class_sections_id;
                for($i=0;$i<count($sibling_admission_no);$i++){
                    $student = DB::select('SELECT * FROM students WHERE admission_no =? AND is_active="yes" and domain="TS" and session_id=?',[$sibling_admission_no[$i]->admission_no,$sessionid[0]->id]);
                    $class_sections = DB::select('SELECT * FROM class_sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$student[0]->class_sections_id,$sessionid[0]->id]);
                    $classes = DB::select('SELECT * FROM classes WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_sections[0]->class_id,$sessionid[0]->id]);
                    $sections = DB::select('SELECT * FROM sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_sections[0]->section_id,$sessionid[0]->id]);
                    $data[$i+1]['id']=$student[0]->id;
                    $data[$i+1]['name']=$student[0]->name;
                    $data[$i+1]['admission_no']=$student[0]->admission_no;
                    $data[$i+1]['class']=$classes[0]->class;
                    $data[$i+1]['section'] = $sections[0]->section;
                    $data[$i+1]['class_sections_id'] =$students[0]->class_sections_id;
                }
                return $data;
            }else{
                
            }
            
        }else{
            $students = DB::select('SELECT * FROM students WHERE admission_no =? AND is_active="yes" and domain="TS" and session_id=?',[$sibling_id,$sessionid[0]->id]);
            $class_section = DB::select('SELECT * FROM class_sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$students[0]->class_sections_id,$sessionid[0]->id]);
            $class = DB::select('SELECT * FROM classes WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->class_id,$sessionid[0]->id]);
            $section = DB::select('SELECT * FROM sections WHERE id =? AND is_active="yes" and domain="TS" and session_id=?',[$class_section[0]->section_id,$sessionid[0]->id]);
            $data[0]['id']=$students[0]->id;
            $data[0]['name']=$students[0]->name;
            $data[0]['admission_no']=$students[0]->admission_no;
            $data[0]['class']=$class[0]->class;
            $data[0]['section'] = $section[0]->section;
            $data[0]['class_sections_id'] =$students[0]->class_sections_id;
            return $data;
        }
       
    }
    public function section($id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $section = [];
        $classsection = DB::select('SELECT * FROM class_sections WHERE class_id =? AND is_active="yes" and domain="TS" and session_id=?',[$id,$sessionid[0]->id]);
        for($i = 0;$i<count($classsection);$i++){
            $test = DB::select('SELECT * FROM sections WHERE id=? and domain="TS" and session_id=?',[$classsection[$i]->section_id,$sessionid[0]->id]);
            foreach($test as $test1){
                array_push($section,$test1);
            }
        }
        return($section);
    }
    public function classSection($class_id,$section_id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $classsection = DB::select('SELECT * FROM class_sections WHERE class_id =? AND section_id=? AND is_active="yes" and session_id=? and domain="TS"',[$class_id,$section_id,$sessionid[0]->id]);
        return $classsection;
    }
    
    public function selectStudent($id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $student = DB::select('SELECT * FROM students WHERE class_sections_id=? and domain="TS" and session_id=?',[$id,$sessionid[0]->id]);
        return $student;
    }
    public function selectSibling($id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $student = DB::select('SELECT * FROM students WHERE admission_no=? and is_active="yes" and session_id=? and domain="TS"',[$id,$sessionid[0]->id]);
        return $student;
    }
    public function selectHostel($id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $rooms = DB::select('SELECT * FROM hostel_rooms WHERE hostel_id=? and domain="TS" and session_id=?',[$id,$sessionid[0]->id]);
        return $rooms;
    }
    public function selectClassSection($id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $classSection = DB::select('SELECT * FROM class_sections WHERE id = ? and domain="TS" and session_id=?',[$id,$sessionid[0]->id,$sessionid[0]->id]);
        $classes = DB::select('SELECT * FROM classes WHERE id = ? and domain="TS" and session_id = ?',[$classSection[0]->class_id,$sessionid[0]->id]);
        // print_r($classes);
        $sections = DB::select('SELECT * FROM sections WHERE id = ? and session_id=? and domain="TS"',[$classSection[0]->section_id,$sessionid[0]->id]);
        return ['classes'=>$classes,'sections'=>$sections];
    }
    
    public function selecthostelroom()
    {
        $classSection = DB::select('SELECT * FROM class_sections WHERE id = ?',[$id]);
    }

    public function create()
    {
        //
    }

    public function searchHostel($hostel_room_id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $hostel_room = DB::select('SELECT * FROM hostel_rooms where id =? and domain="TS" and session_id=?',[$hostel_room_id,$sessionid[0]->id]);
        $hostel = DB::select('SELECT * FROM hostels where id=? and domain="TS" and session_id=?',[$hostel_room[0]->hostel_id,$sessionid[0]->id]);
        return $hostel;
    }
    public function store(Request $request)
    {
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $viladition ="";
          $admision_no = DB::select('select * from students where admission_no =? and domain="TS" and session_id=?',[$request->input('admission_no'),$sessionid[0]->id]);

          $email = DB::select('select * from students where email =? and domain="TS" and session_id=?',[$request->input('email'),$sessionid[0]->id]);
          $phone = DB::select('select * from students where mobileno =?',[$request->input('mobileno')]);
        if($admision_no){
            $viladition = "admission_no";
        }

        if(!$request->input('email')){
            if($email){
                $viladition = "email";
            }
        }

        if(!$request->input('mobileno')){
            if($phone){
                $viladition = "phone";
            }
        }

        //   if($admision_no){
        //     return response()->json("not");
        //   }else if($email){
        //     return response()->json("not");
        //   }
        //   else if($phone){
        //     return response()->json("not");
        //   }
        //   else{
            if($viladition){
                return $viladition;
            }else{
                $data = DB::select('select * from students where admission_no =? and domain="TS" and session_id=?',[$request->input('sibling_admission_no'),$sessionid[0]->id]);
            
            $fatherImageName='';
            $motherImageName='';
            $imageName='';
            $guardianImageName='';
            // student image
            
            
                if($request->input('sibling_admission_no')){
                    if($data[0]->image != $request->image){
                        $file1 = $request->image;
                        $ext1 = strtolower($file1->getClientOriginalExtension());
                        $imageName = time() . '.' . $ext1;
                        $request->image->move(public_path('stu_image'), $imageName);
                    }else if($request->image){
                        $file1 = $request->image;
                        $ext1 = strtolower($file1->getClientOriginalExtension());
                        $imageName = time() . '.' . $ext1;
                        $request->image->move(public_path('stu_image'), $imageName);
                    }
                }else if($request->image){
                    $file1 = $request->image;
                    $ext1 = strtolower($file1->getClientOriginalExtension());
                    $imageName = time() . '.' . $ext1;
                    $request->image->move(public_path('stu_image'), $imageName);
                }
            
            
            // father image
           
            if($request->input('sibling_admission_no')){
                if($data[0]->father_photo != $request->father_photo){
                    $file2 = $request->father_photo;
                    $ext2 = strtolower($file2->getClientOriginalExtension());
                    $fatherImageName = time() . '.' . $ext2;
                    $request->father_photo->move(public_path('father_image'), $fatherImageName);
                }
                 else if($data[0]->father_photo == $request->father_photo){
                  $fatherImageName = $data[0]->father_photo;
                }
                else if($request->father_photo){
                    $file2 = $request->father_photo;
                    $ext2 = strtolower($file2->getClientOriginalExtension());
                    $fatherImageName = time() . '.' . $ext2;
                    $request->father_photo->move(public_path('father_image'), $fatherImageName);
                }
            }else if($request->father_photo){
                $file2 = $request->father_photo;
                $ext2 = strtolower($file2->getClientOriginalExtension());
                $fatherImageName = time() . '.' . $ext2;
                $request->father_photo->move(public_path('father_image'), $fatherImageName);
            }

            // mother image
           
            if($request->input('sibling_admission_no')){
                if($data[0]->mother_photo != $request->mother_photo){
                    $file3 = $request->mother_photo;
                    $ext3 = strtolower($file3->getClientOriginalExtension());
                    $motherImageName = time() . '.' . $ext3;
                    $request->mother_photo->move(public_path('mother_image'), $motherImageName);
                }
                else if($data[0]->mother_photo == $request->mother_photo){
                    $motherImageName = $data[0]->mother_photo;
                }
                else if($request->mother_photo){
                    $file3 = $request->mother_photo;
                    $ext3 = strtolower($file3->getClientOriginalExtension());
                    $motherImageName = time() . '.' . $ext3;
                    $request->mother_photo->move(public_path('mother_image'), $motherImageName);
                }
            }else if($request->mother_photo){
                $file3 = $request->mother_photo;
                $ext3 = strtolower($file3->getClientOriginalExtension());
                $motherImageName = time() . '.' . $ext3;
                $request->mother_photo->move(public_path('mother_image'), $motherImageName);
            }
            // guardian image
            
            if($request->input('sibling_admission_no')){
                if($data[0]->guardian_photo != $request->guardian_photo){
                    $file4 = $request->guardian_photo;
                    $ext4 = strtolower($file4->getClientOriginalExtension());
                    $guardianImageName = time() . '.' . $ext4;
                    $request->guardian_photo->move(public_path('guardian_image'), $guardianImageName);
                }
                 else if($data[0]->guardian_photo == $request->guardian_photo){
                    $guardianImageName = $data[0]->guardian_photo;
                }
                else if($request->guardian_photo){
                    $file4 = $request->guardian_photo;
                    $ext4 = strtolower($file4->getClientOriginalExtension());
                    $guardianImageName = time() . '.' . $ext4;
                    $request->guardian_photo->move(public_path('guardian_image'), $guardianImageName);
                }
            }else if($request->guardian_photo){
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
                'race'=>$request->race
            ]);
            $student->save();
            return response()->json("Saved Success");
            }
        
    }
    public function update(Request $request, $id)
    {
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $viladition="";
        $admision_no = DB::select('select * from students where admission_no =? and domain="TS" and session_id=?',[$request->input('admission_no'),$sessionid[0]->id]);
        if($admision_no[0]->email == $request->email){
            $viladition="";
        }
        if($admision_no[0]->mobileno == $request->mobileno){
            $viladition="";
        }
        
        if($admision_no[0]->email != $request->email){
          $email = DB::select('select * from students where email =? and domain="TS" and session_id=?',[$request->input('email'),$sessionid[0]->id]);
          if($email){
              $viladition = "This Email Already Exists";
          }
        }
        if($admision_no[0]->mobileno != $request->mobileno){
          $phone = DB::select('select * from students where mobileno =? and domain="TS" and session_id=?',[$request->input('mobileno'),$sessionid[0]->id]);
          if($phone){
            $viladition = "This Phone Already Exists";
          }
        }
        if($viladition){
            return $viladition;
        }else{
            $data = DB::select('select * from students where admission_no =? and domain="TS" and session_id=?',[$request->input('admission_no'),$sessionid[0]->id]);
            $fatherImageName='';
            $motherImageName='';
            $imageName='';
            $guardianImageName='';
            $imageName = $request->image;
            $fatherImageName = $request->father_photo;
            $motherImageName = $request->mother_photo;
            $guardianImageName = $request->guardian_photo;
            // student image
                    if($data[0]->image != $request->image){
                        $file1 = $request->image;
                        $ext1 = strtolower($file1->getClientOriginalExtension());
                        $imageName = time() . '.' . $ext1;
                        $request->image->move(public_path('stu_image'), $imageName);
                    }else{
                        $imageName = $request->image;
                    }
            // father image
                if($data[0]->father_photo != $request->father_photo){
                    $file2 = $request->father_photo;
                    $ext2 = strtolower($file2->getClientOriginalExtension());
                    $fatherImageName = time() . '.' . $ext2;
                    $request->father_photo->move(public_path('father_image'), $fatherImageName);
                }else{
                    $fatherImageName = $request->father_photo;
                }
            // mother image
                if($data[0]->mother_photo != $request->mother_photo){
                    $file3 = $request->mother_photo;
                    $ext3 = strtolower($file3->getClientOriginalExtension());
                    $motherImageName = time() . '.' . $ext3;
                    $request->mother_photo->move(public_path('mother_image'), $motherImageName);
                }else{
                    $motherImageName = $request->mother_photo;
                }
            // guardian image
                if($data[0]->guardian_photo != $request->guardian_photo){
                    $file4 = $request->guardian_photo;
                    $ext4 = strtolower($file4->getClientOriginalExtension());
                    $guardianImageName = time() . '.' . $ext4;
                    $request->guardian_photo->move(public_path('guardian_image'), $guardianImageName);
                }else{
                    $guardianImageName = $request->guardian_photo;
                }
                $student = student::find($id);
                $student->update([
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
                'race'=>$request->race
                ]);
                return response()->json('Successfully updated');
        }

    }
    public function studentReport($class_id,$section_id,$gender){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $data =[];
           $section= DB::select('SELECT * FROM class_sections WHERE class_id=? AND section_id=? and domain="TS" and session_id=?',[$class_id,$section_id,$sessionid[0]->id]);
           $student = DB::select('SELECT * FROM students WHERE class_sections_id=? AND gender=? and domain="TS" and session_id=?',[$section[0]->id,$gender,$sessionid[0]->id]);
           $class = DB::select('SELECT * FROM classes WHERE id=?',[$section[0]->class_id]);
           $section = DB::select('SELECT * FROM sections WHERE id=?',[$section[0]->section_id]);
           for($i=0;$i<count($student);$i++){
               $data[$i]['name'] = $student[$i]->name;
               $data[$i]['admission_no'] = $student[$i]->admission_no;
               $data[$i]['class'] = $class[0]->class;
               $data[$i]['section'] = $section[0]->section;
               $data[$i]['father_name'] = $student[$i]->father_name;
               $data[$i]['mother_name']=$student[$i]->mother_name;
               $data[$i]['dob'] = $student[$i]->dob;
               $data[$i]['gender'] = $student[$i]->gender;
               $data[$i]['mobileno'] = $student[$i]->mobileno;
               $data[$i]['guardian_name'] = $student[$i]->guardian_name;
               $data[$i]['guardian_phone'] = $student[$i]->guardian_phone;
           }
           return $data;
    }
    public function studentReport1($class_id,$section_id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $data=[];
        $section= DB::select('SELECT * FROM class_sections WHERE class_id=? AND section_id=? and domain="TS" and session_id=?',[$class_id,$section_id,$sessionid[0]->id]);
        $student = DB::select('SELECT * FROM students WHERE class_sections_id=? and domain="TS" and session_id=?',[$section[0]->id,$sessionid[0]->id]);
        for($i=0;$i<count($student);$i++){
            $section1= DB::select('SELECT * FROM class_sections WHERE id=? and domain="TS" and session_id=?',[$student[$i]->class_sections_id,$sessionid[0]->id]);
            $class = DB::select('SELECT * FROM classes WHERE id=? and domain="TS" and session_id=?',[$section1[0]->class_id,$sessionid[0]->id]);
            $section = DB::select('SELECT * FROM sections WHERE id=?',[$section1[0]->section_id]);
            $data[$i]['name'] = $student[$i]->name;
            $data[$i]['admission_no'] = $student[$i]->admission_no;
            $data[$i]['class'] = $class[0]->class;
            $data[$i]['section'] = $section[0]->section;
            $data[$i]['father_name'] = $student[$i]->father_name;
            $data[$i]['mother_name']=$student[$i]->mother_name;
            $data[$i]['dob'] = $student[$i]->dob;
            $data[$i]['gender'] = $student[$i]->gender;
            $data[$i]['mobileno'] = $student[$i]->mobileno;
            $data[$i]['guardian_name'] = $student[$i]->guardian_name;
            $data[$i]['guardian_phone'] = $student[$i]->guardian_phone;
        }
        return $data;
    }

    public function studentReport2($class_id,$gender){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $array=[];
        $data=[];
        $student=[];
        $section= DB::select('SELECT * FROM class_sections WHERE class_id=? and domain="TS" and session_id=?',[$class_id,$sessionid[0]->id]);
        for($i = 0;$i<count($section);$i++){
            $students = DB::select('SELECT * FROM students WHERE class_sections_id=? AND gender=? and domain="TS" and session_id=?',[$section[$i]->id,$gender,$sessionid[0]->id]);
            array_push($student,$students);
        }
        // $list = $student[0];
        for($i=0;$i<count($student);$i++){
            for($x =0;$x<count($student[$i]);$x++){
                $section1= DB::select('SELECT * FROM class_sections WHERE id=? and domain="TS" and session_id=?',[$student[$i][$x]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id=? and domain="TS" and session_id=?',[$section1[0]->class_id,$sessionid[0]->id]);
                $section = DB::select('SELECT * FROM sections WHERE id=? and domain="TS" and session_id=?',[$section1[0]->section_id,$sessionid[0]->id]);
                $data[$x]['name'] = $student[$i][$x]->name;
                $data[$x]['admission_no'] = $student[$i][$x]->admission_no;
                $data[$x]['class'] = $class[0]->class;
                $data[$x]['section'] = $section[0]->section;
                $data[$x]['father_name'] = $student[$i][$x]->father_name;
                $data[$x]['mother_name']=$student[$i][$x]->mother_name;
                $data[$x]['dob'] = $student[$i][$x]->dob;
                $data[$x]['gender'] = $student[$i][$x]->gender;
                $data[$x]['mobileno'] = $student[$i][$x]->mobileno;
                $data[$x]['guardian_name'] = $student[$i][$x]->guardian_name;
                $data[$x]['guardian_phone'] = $student[$i][$x]->guardian_phone;
                array_push($array,$data[$x]);
            }
            
        }
        // print_r(count($array));
        return $array;
    }
    public function studentReport3($class_id){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $array=[];
        $data=[];
        $student=[];
        $section= DB::select('SELECT * FROM class_sections WHERE class_id=? and domain="TS" and session_id=?',[$class_id,$sessionid[0]->id]);
        for($i = 0;$i<count($section);$i++){
            $students = DB::select('SELECT * FROM students WHERE class_sections_id=? and domain="TS" and session_id=?',[$section[$i]->id,$sessionid[0]->id]);
            array_push($student,$students);
        }
        // $list = $student[0];
        for($i=0;$i<count($student);$i++){
            for($x =0;$x<count($student[$i]);$x++){
                $section1= DB::select('SELECT * FROM class_sections WHERE id=? and domain="TS" and session_id=?',[$student[$i][$x]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id=? and domain="TS" and session_id=?',[$section1[0]->class_id,$sessionid[0]->id]);
                $section = DB::select('SELECT * FROM sections WHERE id=? domain="TS" and session_id=?',[$section1[0]->section_id,$sessionid[0]->id]);
                $data[$x]['name'] = $student[$i][$x]->name;
                $data[$x]['admission_no'] = $student[$i][$x]->admission_no;
                $data[$x]['class'] = $class[0]->class;
                $data[$x]['section'] = $section[0]->section;
                $data[$x]['father_name'] = $student[$i][$x]->father_name;
                $data[$x]['mother_name']=$student[$i][$x]->mother_name;
                $data[$x]['dob'] = $student[$i][$x]->dob;
                $data[$x]['gender'] = $student[$i][$x]->gender;
                $data[$x]['mobileno'] = $student[$i][$x]->mobileno;
                $data[$x]['guardian_name'] = $student[$i][$x]->guardian_name;
                $data[$x]['guardian_phone'] = $student[$i][$x]->guardian_phone;
                array_push($array,$data[$x]);
            }
            
        }
        // print_r(count($array));
        return $array;
    }
    public function studentReport4($gender){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $array=[];
        $data=[];
        $student=[];
        $student = DB::select('SELECT * FROM students WHERE gender=? and domain="TS" and session_id=?',[$gender,$sessionid[0]->id]);
        // return $student;
        // $list = $student[0];
        for($i=0;$i<count($student);$i++){
                $section1= DB::select('SELECT * FROM class_sections WHERE id=? and domain="TS" and session_id=?',[$student[$i]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id=? and domain="TS" and session_id=?',[$section1[0]->class_id,$sessionid[0]->id]);
                $section = DB::select('SELECT * FROM sections WHERE id=? and domain="TS" and session_id=?',[$section1[0]->section_id,$sessionid[0]->id]);
                $data[$i]['name'] = $student[$i]->name;
                $data[$i]['admission_no'] = $student[$i]->admission_no;
                $data[$i]['class'] = $class[0]->class;
                $data[$i]['section'] = $section[0]->section;
                $data[$i]['father_name'] = $student[$i]->father_name;
                $data[$i]['mother_name']=$student[$i]->mother_name;
                $data[$i]['dob'] = $student[$i]->dob;
                $data[$i]['gender'] = $student[$i]->gender;
                $data[$i]['mobileno'] = $student[$i]->mobileno;
                $data[$i]['guardian_name'] = $student[$i]->guardian_name;
                $data[$i]['guardian_phone'] = $student[$i]->guardian_phone;
        }
        // print_r(count($array));
        return $data;
    }
    public function show()
    {
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $array=[];
        $data=[];
        $student=[];
        $student = DB::select('SELECT * FROM students where session_id=? and domain="TS"',[$sessionid[0]->id]);
        // return $student;
        // $list = $student[0];
        for($i=0;$i<count($student);$i++){
                $section1= DB::select('SELECT * FROM class_sections WHERE id=? and domain="TS" and session_id=?',[$student[$i]->class_sections_id,$sessionid[0]->id]);
                $class = DB::select('SELECT * FROM classes WHERE id=? and session_id=? and domain="TS"',[$section1[0]->class_id]);
                $section = DB::select('SELECT * FROM sections WHERE id=? and session_id=? and domain="TS"',[$section1[0]->section_id,$sessionid[0]->id]);
                $data[$i]['name'] = $student[$i]->name;
                $data[$i]['admission_no'] = $student[$i]->admission_no;
                $data[$i]['class'] = $class[0]->class;
                $data[$i]['section'] = $section[0]->section;
                $data[$i]['father_name'] = $student[$i]->father_name;
                $data[$i]['mother_name']=$student[$i]->mother_name;
                $data[$i]['dob'] = $student[$i]->dob;
                $data[$i]['gender'] = $student[$i]->gender;
                $data[$i]['mobileno'] = $student[$i]->mobileno;
                $data[$i]['guardian_name'] = $student[$i]->guardian_name;
                $data[$i]['guardian_phone'] = $student[$i]->guardian_phone;
        }
        // print_r(count($array));
        return $data;
    }

    public function edit($id)
    {
        // print_r($id);
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        $student = DB::select('select * from students where id =? and domain="TS" and session_id=?',[$id,$sessionid[0]->id]);
        return $student;
    }

    public function selectByKeyword($keyword){
        $sessionid = DB::select('select * from academic_years where is_active="yes" and domain="TS"',[]);
        if($keyword != ''){
            $students = DB::select('SELECT * FROM students WHERE name LIKE ? OR admission_no LIKE ? OR father_name LIKE ? OR roll_no LIKE ? OR gender LIKE ? OR religion LIKE ? OR mother_name LIKE ? OR race LIKE ? OR email LIKE ? OR blood_group LIKE ? OR height LIKE ? OR weight LIKE ? OR guardian_name LIKE ? OR mobileno LIKE ? and domain="TS" and session_id=?',[$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$keyword,$sessionid[0]->id]);
            return $students;
        }
    }


    public function destroy(student $student)
    {
        //
    }
}
