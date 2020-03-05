<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Mail\SendMail;
use App\StaffAttendance;
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

            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp'
            ];

            Mail::to('waiyansoe4421@gmail.com')->send(new SendMail($details));
            /**
             * COUNT DATA
             */
            $check_staff_id = StaffDirectory::where('staff_id', $request->staff_id)->count();
            $check_email    = StaffDirectory::where('email', $request->email)->count();
            $check_phone    = StaffDirectory::where('phone', $request->phone)->count();

            if ($check_staff_id > 0) {
                return response()->json(['text' => 'Staff ID already exists!', 'type' => "error"]);
            }
            if ($check_email > 0) {
                return response()->json(['text' => 'Email already exists!', 'type' => "error"]);
            }
            if ($check_phone > 0) {
                return response()->json(['text' => 'Phone Number already exists!', 'type' => "error"]);
            } else {
                /**
                 * NAME OF IMAGE 
                 */
                $imageName = "";
                if ($request->image) {
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('staff_images'), $imageName);
                } else {
                    $imageName = "";
                }

                /**
                 * Name OF File
                 */
                $resume  = '';
                $joining_letter = '';
                $other_document = '';
                if ($request->resume) {
                    $resume = time() . $request->staff_id . "resume" . '.' . $request->resume->getClientOriginalExtension();
                    $request->resume->move(public_path('staff_images'), $resume);
                }
                if ($request->joining_letter) {
                    $joining_letter = time() . $request->staff_id . "joiningletter" . '.' .  $request->joining_letter->getClientOriginalExtension();
                    $request->joining_letter->move(public_path('staff_images'), $joining_letter);
                }
                if ($request->other_document) {
                    $other_document = time() . $request->staff_id . "otherdocument" .  '.' . $request->other_document->getClientOriginalExtension();
                    $request->other_document->move(public_path('staff_images'), $other_document);
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
                return response()->json(['text' => 'Staff Directory added successfully', 'type' => 'success']);
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
            $resumefilename = public_path() . '/staff_images/' . $request->resume;
            $jlfilename = public_path() . '/staff_images/' . $request->joining_letter;
            $odfilename = public_path() . '/staff_images/' . $request->joining_letter;
            // echo $filename;
            /**
             * Name OF File
             */
            $imageName = '';
            $resume  = '';
            $joining_letter = '';
            $other_document = '';
            /**Image */
            if (File::exists($filename)) {
                $imageName = $request->image;
            } else {
                if ($request->image != "") {
                    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('staff_images'), $imageName);
                }
            }
            /**Documents */
            if (File::exists($resumefilename)) {
                $resume = $request->resume;
            } else {
                if ($request->resume != "") {
                    $resume = time() . $request->staff_id . "resume" . '.' . $request->resume->getClientOriginalExtension();
                    $request->resume->move(public_path('staff_images'), $resume);
                }
            }

            if (File::exists($jlfilename)) {
                $joining_letter = $request->joining_letter;
            } else {
                if ($request->joining_letter != "") {
                    $joining_letter = time() . $request->staff_id . "joiningletter" . '.' .  $request->joining_letter->getClientOriginalExtension();
                    $request->joining_letter->move(public_path('staff_images'), $joining_letter);
                }
            }


            if (File::exists($odfilename)) {
                $other_document = $request->other_document;
            } else {
                if ($request->other_document != "") {
                    $other_document = time() . $request->staff_id . "otherdocument" .  '.' . $request->other_document->getClientOriginalExtension();
                    $request->other_document->move(public_path('staff_images'), $other_document);
                }
            }


            // File::delete($filename);




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
                "resume"   => $resume,
                "joining_letter"   => $joining_letter,
                "other_document"   => $other_document,
                "date_of_joining"   => $request->doj,
                "is_active"   => "yes",
                'session_id'  => $session[$i]['id'],
                'domain'  => 'TS'
            ]);
            return response()->json(['text' => 'Staff Directory updated successfully', 'type' => 'success']);

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

    public function search_staff_lists($id)
    {
        $sessionid = AcademicYear::where('is_active', 'yes')->where('domain', 'TS')->get('id');
        $staffs = StaffDirectory::with('role', 'department', 'designation')
            ->where('session_id', $sessionid[0]->id)
            ->where('role_id', $id)
            ->where('is_active', '<>', 'delete')
            ->get()
            ->toArray();
        return array_reverse($staffs);
    }


    /***Disable record */

    public function disable($id)
    {
        $data = StaffDirectory::find($id);
        $data->update([
            'is_active' => 'no'
        ]);
        $attendanc = StaffAttendance::where('staff_id', $id);
        $attendanc->update([
            'is_active' => 'no'
        ]);
        return response()->json(['text' => 'Staff Directory added successfully', 'type' => 'success']);
    }
    /***Enable record */

    public function enable($id)
    {
        $data = StaffDirectory::find($id);
        $data->update([
            'is_active' => 'yes'
        ]);
        $attendanc = StaffAttendance::where('staff_id', $id);
        $attendanc->update([
            'is_active' => 'yes'
        ]);
        return response()->json(['text' => 'Staff Directory added successfully', 'type' => 'success']);
    }
    /** Delete Staff */
    public function delete($id)
    {
        $data = StaffDirectory::find($id);
        $data->update([
            'is_active' => 'delete'
        ]);
        $attendanc = StaffAttendance::where('staff_id', $id);
        $attendanc->update([
            'is_active' => 'delete'
        ]);
        return response()->json(['text' => 'Staff Directory deleted successfully', 'type' => 'success']);
    }
}
