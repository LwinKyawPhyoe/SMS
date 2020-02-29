<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Mail\SendMail;
use App\StaffDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class StaffDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $staffs = StaffDirectory::where('is_active', 'yes')->with('role', 'department', 'designation')
            ->where('domain', 'TS')
            ->where('session_id', $sessionid[0]->id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($staffs);
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
        /***
         * Random Password
         */
        $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
        for ($i = 0; $i < count($session); $i++) {
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 8);
            // Mail::to('waiyansoe4421@gmail.com')->send(new SendMail($password));
            /**
             * COUNT DATA
             */
            $check_staff_id = StaffDirectory::where('staff_id', $request->staff_id)->count();
            $check_email    = StaffDirectory::where('email', $request->email)->count();
            $check_phone    = StaffDirectory::where('phone', $request->phone)->count();

            if ($check_staff_id > 0) {
                return response()->json('Staff ID already exists!');
            }
            if ($check_email > 0) {
                return response()->json('Email already exists!');
            }
            if ($check_phone > 0) {
                return response()->json('Phone Number already exists!');
            } else {
                /**
                 * NAME OF IMAGE 
                 */
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('staff_images'), $imageName);
                /**
                 * Name OF File
                 */
                $resume  = '';
                $joining_letter = '';
                $other_document = '';
                if ($request->resume != 'undefined') {
                    $request->resume->move(public_path('staff_images'), 'Resume');
                    $resume = "Resume";
                }
                if ($request->joining_letter != 'undefined') {
                    $request->joining_letter->move(public_path('staff_images'), 'Joining Letter');
                    $joining_letter = "Joining Letter";
                }
                if ($request->other_document != 'undefined') {
                    $request->other_document->move(public_path('staff_images'), 'Other Documents');
                    $other_document = "Other Documents";
                }

                $staffDirectory = new StaffDirectory([
                    "staff_id"         => $request->staff_id,
                    "role_id"          => $request->role_id,
                    "designation_id"   => $request->designation_id,
                    "department_id"    => $request->department_id,
                    "name"             => $request->name,
                    "father_name"   => $request->father_name,
                    "mother_name"   => $request->mother_name,
                    "email"         => $request->email,
                    "gender"   => $request->gender,
                    "dob"   => $request->dob,
                    "phone"   => $request->phone,
                    "emergency_contact_no"   => $request->emergency_contact_no,
                    "marital_status"   => $request->marital_status,
                    "image"   => $imageName,
                    "current_address"   => $request->current_address,
                    "permanent_address"   => $request->permanent_address,
                    "qualification"   => $request->qualification,
                    "work_exp"   => $request->work_exp,
                    "note"   => $request->note,
                    "password"   => $request->password,
                    "epf_no"   => $request->epf_no,
                    "basic_salary"   => $request->basic_salary,
                    "contract_type"   => $request->contract_type,
                    "work_shift"   => $request->work_shift,
                    "location"   => $request->location,
                    "medical_leave"   => $request->medical_leave,
                    "casual_leave"   => $request->casual_leave,
                    "maternity_leave"   => $request->maternity_leave,
                    "account_title"   => $request->account_title,
                    "bank_account_no"   => $request->bank_account_no,
                    "ifsc_code"   => $request->ifsc_code,
                    "bank_branch_name"   => $request->bank_branch_name,
                    "facebook"   => $request->facebook,
                    "twitter"   => $request->twitter,
                    "instagram"   => $request->instagram,
                    "linkedin"   => $request->linkedin,
                    "resume"   => $resume,
                    "joining_letter"   => $joining_letter,
                    "other_document"   => $other_document,
                    "date_of_joining"   => $request->doj,
                    "is_active"   => "yes",
                    'session_id'  => $session[$i]['id'],
                    'domain'  => 'TS'
                ]);
                $staffDirectory->save();
                return response()->json('The StaffDirectory successfully deleted');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffDirectory  $staffDirectory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $staffDirectory  = StaffDirectory::with('role', 'department', 'designation')->find($id);
        // $count = StaffDirectory::where('id', $id)->count();
        return response()->json($staffDirectory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffDirectory  $staffDirectory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $staffDirectory  = StaffDirectory::find($id);
        return response()->json($staffDirectory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffDirectory  $staffDirectory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $session = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get();
        for ($i = 0; $i < count($session); $i++) {
            $staffDirectory = StaffDirectory::find($id);
            $filename = public_path() . '/staff_images/' . $request->image;
            // echo $filename;
            if (File::exists($filename)) {
                echo "exists";
                $staffDirectory->update([
                    "staff_id"         => $request->staff_id,
                    "role_id"          => $request->role_id,
                    "designation_id"   => $request->designation_id,
                    "department_id"    => $request->department_id,
                    "name"             => $request->name,
                    "father_name"   => $request->father_name,
                    "mother_name"   => $request->mother_name,
                    "email"         => $request->email,
                    "gender"   => $request->gender,
                    "dob"   => $request->dob,
                    "phone"   => $request->phone,
                    "emergency_contact_no"   => $request->emergency_contact_no,
                    "marital_status"   => $request->marital_status,
                    "image"   => $request->image,
                    "current_address"   => $request->current_address,
                    "permanent_address"   => $request->permanent_address,
                    "qualification"   => $request->qualification,
                    "work_exp"   => $request->work_exp,
                    "note"   => $request->note,
                    "password"   => $request->password,
                    "epf_no"   => $request->epf_no,
                    "basic_salary"   => $request->basic_salary,
                    "contract_type"   => $request->contract_type,
                    "work_shift"   => $request->work_shift,
                    "location"   => $request->location,
                    "medical_leave"   => $request->medical_leave,
                    "casual_leave"   => $request->casual_leave,
                    "maternity_leave"   => $request->maternity_leave,
                    "account_title"   => $request->account_title,
                    "bank_account_no"   => $request->bank_account_no,
                    "ifsc_code"   => $request->ifsc_code,
                    "bank_branch_name"   => $request->bank_branch_name,
                    "facebook"   => $request->facebook,
                    "twitter"   => $request->twitter,
                    "instagram"   => $request->instagram,
                    "linkedin"   => $request->linkedin,
                    "resume"   => "",
                    "joining_letter"   => "",
                    "other_document"   => ".",
                    "date_of_joining"   => $request->doj,
                    'session_id'  => $session[$i]['id'],
                    'domain'  => 'TS'
                ]);
            } else {
                // File::delete($filename);
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('staff_images'), $imageName);
                $staffDirectory->update([
                    "staff_id"         => $request->staff_id,
                    "role_id"          => $request->role_id,
                    "designation_id"   => $request->designation_id,
                    "department_id"    => $request->department_id,
                    "name"             => $request->name,
                    "father_name"   => $request->father_name,
                    "mother_name"   => $request->mother_name,
                    "email"         => $request->email,
                    "gender"   => $request->gender,
                    "dob"   => $request->dob,
                    "phone"   => $request->phone,
                    "emergency_contact_no"   => $request->emergency_contact_no,
                    "marital_status"   => $request->marital_status,
                    "image"   => $imageName,
                    "current_address"   => $request->current_address,
                    "permanent_address"   => $request->permanent_address,
                    "qualification"   => $request->qualification,
                    "work_exp"   => $request->work_exp,
                    "note"   => $request->note,
                    "password"   => $request->password,
                    "epf_no"   => $request->epf_no,
                    "basic_salary"   => $request->basic_salary,
                    "contract_type"   => $request->contract_type,
                    "work_shift"   => $request->work_shift,
                    "location"   => $request->location,
                    "medical_leave"   => $request->medical_leave,
                    "casual_leave"   => $request->casual_leave,
                    "maternity_leave"   => $request->maternity_leave,
                    "account_title"   => $request->account_title,
                    "bank_account_no"   => $request->bank_account_no,
                    "ifsc_code"   => $request->ifsc_code,
                    "bank_branch_name"   => $request->bank_branch_name,
                    "facebook"   => $request->facebook,
                    "twitter"   => $request->twitter,
                    "instagram"   => $request->instagram,
                    "linkedin"   => $request->linkedin,
                    "resume"   => "",
                    "joining_letter"   => "",
                    "other_document"   => ".",
                    "date_of_joining"   => $request->doj,
                    "is_active"   => "yes",
                    'session_id'  => $session[$i]['id'],
                    'domain'  => 'TS'
                ]);
            }
            return response()->json('Staff successfully updated');
            // $staffDirectory = StaffDirectory::find($id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffDirectory  $staffDirectory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffDirectory $staffDirectory)
    {
        //
    }

    /**
     * FIND with Role
     */
    // public function search_by_role($id)
    // {
    //     $sessionid = AcademicYear::where('is_active', 'yes')
    //     ->where('domain', 'TS')->get('id');
    //     $staffs = StaffDirectory::where('role_id', $id)
    //         ->where('is_active', 'yes')
    //         ->where('domain', 'TS')
    //         ->where('session_id', $sessionid[0]->id)
    //         ->orderBy('id', 'DESC')->get()->toArray();
    //     return array_reverse($staffs);
    // }

    // public function search_by_other($id)
    // {
    //     $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
    //     $staffs = StaffDirectory::with('role', 'department', 'designation')
    //         ->where('staff_id', 'like', '%' . $id . '%')
    //         ->orWhere('name', 'like', '%' . $id . '%')->where('is_active', 'yes')
    //         ->where('domain', 'TS')
    //         ->where('session_id', $sessionid[0]->id)
    //         ->orderBy('id', 'DESC')->get()->toArray();
    //     return array_reverse($staffs);
    // }


    /**
     * FIND with Role
     */
    public function search_by_role($id)
    {
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $staffs = StaffDirectory::with('role', 'department', 'designation')
            ->where('role_id', $id)
            ->where('session_id', $sessionid[0]->id)
            ->get()->toArray();
        return array_reverse($staffs);
    }

    public function search_by_other($id)
    {
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $staffs = StaffDirectory::with('role', 'department', 'designation')
            ->where('session_id', $sessionid[0]->id)
            ->where('staff_id', 'like', '%' . $id . '%')
            ->orWhere('name', 'like', '%' . $id . '%')
            ->get()
            ->toArray();
        return array_reverse($staffs);
    }
}
