<?php

namespace App\Http\Controllers;

use App\StaffDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
        $staffs = StaffDirectory::where('is_active', 'Yes')->with('role', 'department', 'designation')->orderBy('id', 'desc')->get()->toArray();
        return array_reverse($staffs);
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
        /***
         * Random Password
         */
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 8);
        echo $password;
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
            $request->resume->move(public_path('staff_images'), 'Resume');
            $request->joining_letter->move(public_path('staff_images'), 'Joining Letter');
            $request->other_document->move(public_path('staff_images'), 'Ohter Documents');
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
                "resume"   => "Resume",
                "joining_letter"   => "Joining Letter",
                "other_document"   => "Other Documents",
                "date_of_joining"   => $request->doj,
                "is_active"   => "Yes",
                "domain"   => "Three Stars",
            ]);
            $staffDirectory->save();
            return response()->json('The StaffDirectory successfully deleted');
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
                "domain"   => "Three Stars"
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
                "is_active"   => "Yes",
                "domain"   => "Three Stars"
            ]);
        }
        return response()->json('Staff successfully updated');
        // $staffDirectory = StaffDirectory::find($id);

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
    public function search_by_role($id)
    {
        $staffs = StaffDirectory::with('role', 'department', 'designation')->where('role_id', $id)->get()->toArray();
        return array_reverse($staffs);
    }

    public function search_by_other($id)
    {
        $staffs = StaffDirectory::with('role', 'department', 'designation')
            ->where('staff_id', 'like', '%' . $id . '%')
            ->orWhere('name', 'like', '%' . $id . '%')
            ->get()
            ->toArray();
        return array_reverse($staffs);
    }
}
