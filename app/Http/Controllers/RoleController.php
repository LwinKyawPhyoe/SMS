<?php

namespace App\Http\Controllers;

use App\AssignPermission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::where('is_active', 'Yes')->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return array_reverse($roles);
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
        $role = new Role([
            "name" => $request->input('name'),
        ]);
        // $role->save();


        $features = [
            [
                'id'      => '1',
                'module'  => '<b>Student Information</b>',
                'feature' => 'Student',
                'view'    =>  false,
                'add'     => false,
                'edit'    => false,
                'delete'  => false,
            ],
            [
                'id'      => '2',
                'feature' => 'Student Report',
                'view'    =>  false,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ],
            [
                'id'      => '3',
                'feature' => 'Guardient Report',
                'view'    =>  false,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ],
            [
                'id'      => '4',
                'feature' => 'Student History',
                'view'    =>  false,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ],
            [
                'id'      => '5',
                'feature' => 'Student Timeline',
                'view'    =>  false,
                'add'     => false,
                'can_edit'    => false,
                'delete'  => false,
            ],

            /***Student Attendance */
            //       [
            //             'id'      => '1',
            //             'module'  => '<b>Student Attendance</b>',
            //             'feature' => 'Student Attendance',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //       ],
            //    [
            //             'id'      => '3',
            //             'feature' => 'Student Attendance Report',
            //             'view'    =>  false,
            //             'can_add' => false,
            //             'can_edit' => false,
            //             'can_delete' => false,
            //    ],
            //       [
            //             'id'      => '4',
            //             'feature' => 'Attendance By Date',
            //             'view'    =>  false,
            //             'can_add' => false,
            //             'can_edit' => false,
            //             'can_delete' => false,
            //       ],
            //         /***Examinations */
            //        [
            //             'id'      => '1',
            //             'module'  => '<b>Examination</b>',
            //             'feature' => 'Exam',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //        [
            //             'id'      => '3',
            //             'feature' => 'Exam Schedule',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //        ],
            //         [
            //             'id'      => '4',
            //             'feature' => 'Marks Grade',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //         ],
            //       [
            //             'id'      => '4',
            //             'feature' => 'Marks Register',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //       ],
            //         /**
            //          * Academics
            //          */
            //        [
            //             'id'      => '1',
            //             'module'  => '<b>Academics</b>',
            //             'feature' => 'Class Timetable',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //        ],
            //      [
            //             'id'      => '3',
            //             'feature' => 'Assign Subject',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //      ],
            //        [
            //             'id'      => '4',
            //             'feature' => 'Subject',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //        [
            //             'id'      => '4',
            //             'feature' => 'Class',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //       [
            //             'id'      => '4',
            //             'feature' => 'Section',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //       ],
            //        [
            //             'id'      => '4',
            //             'feature' => 'Promote Student',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'can_edit'    => false,
            //             'can_delete'  => false,
            //        ],
            //        [
            //             'id'      => '4',
            //             'feature' => '	Assign Class Teacher',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //         /**DownLoad Center */
            //      [
            //             'id'      => '4',
            //             'module'  => '<b>Download Center</b>',
            //             'feature' => 'Upload Content',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'can_edit'    => false,
            //             'delete'  => false,
            //      ],
            //         /** Transport  */
            //       [
            //             'id'      => '4',
            //             'module'  => '<b>Transport</b>',
            //             'feature' => 'Routes',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //       ],
            //     [
            //             'id'      => '4',
            //             'feature' => 'Vehicle',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //     ],
            //      [
            //             'id'      => '4',
            //             'feature' => 'Assign Vehicle',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //      ],
            //   [
            //             'id'      => '4',
            //             'feature' => 'Student Transport Report',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'can_edit'    => false,
            //             'can_delete'  => false,
            //   ],
            //         /***Hostel */
            //    [
            //             'id'      => '4',
            //             'module'  => '<b>Hostel</b>',
            //             'feature' => 'Hostel',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //    ],
            //        [
            //             'id'      => '4',
            //             'feature' => 'Room Type',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //        [
            //             'id'      => '4',
            //             'feature' => 'Hostel Rooms',
            //             'view'    =>  false,
            //             'add'     => false,
            //             'edit'    => false,
            //             'delete'  => false,
            //        ],
            //     [
            //             'id'      => '4',
            //             'feature' => 'Student Hostel Report',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'can_edit'    => false,
            //             'can_delete'  => false,
            //     ],
            //         /**Report */
            //         [
            //             'id'      => '4',
            //             'module'  => '<b>Reports</b>',
            //             'feature' => 'User Log',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'can_edit'    => false,
            //             'can_delete'  => false,
            //         ],
            //         /**System settings */
            // [
            //             'id'      => '4',
            //             'module'  => '<b>System settings</b>',
            //             'feature' => 'General Setting',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            // ],
            //         [
            //             'id'      => '4',
            //             'feature' => 'Roles Permissions',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //         ],

            //        [
            //             'id'      => '4',
            //             'feature' => 'Users',
            //             'view'    =>  false,
            //             'can_add'     => false,
            //             'edit'    => false,
            //             'can_delete'  => false,
            //        ],

            //     /**HRM */
            // [
            //         'id'      => '4',
            //         'module'  => '<b>HRM</b>',
            //         'feature' => 'Staff',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'edit'    => false,
            //         'delete'  => false,
            // ],

            //    [
            //         'id'      => '4',
            //         'feature' => 'Staff Attendance',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'edit'    => false,
            //         'can_delete'  => false,
            //     ),

            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Staff Attendance Report',
            //         'view'    =>  false,
            //         'can_add'     => false,
            //         'can_edit'    => false,
            //         'can_delete'  => false,
            //     ),

            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Department',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'edit'    => false,
            //         'delete'  => false,
            //     ),
            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Designation',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'edit'    => false,
            //         'delete'  => false,
            //     ),
            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Can See Other Users Profile',
            //         'view'    =>  false,
            //         'can_add'     => false,
            //         'can_edit'    => false,
            //         'can_delete'  => false,
            //     ),
            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Staff Timeline',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'can_edit'    => false,
            //         'delete'  => false,
            //     ),
            //     /**System settings */
            //     (object) array(
            //         'id'      => '4',
            //         'module'  => '<b>Homework</b>',
            //         'feature' => 'Homework',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'edit'    => false,
            //         'delete'  => false,
            //     ),
            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Homework Elevation',
            //         'view'    =>  false,
            //         'add'     => false,
            //         'can_edit'    => false,
            //         'can_delete'  => false,
            //     ),
            //     (object) array(
            //         'id'      => '4',
            //         'feature' => 'Homework Report',
            //         'view'    =>  false,
            //         'can_add'     => false,
            //         'can_edit'    => false,
            //         'can_delete'  => false,
            //     ),

        ];
        //  $d = get_object_vars($features);
        foreach ($features as $i) {
            DB::table('assign-permissions')->insert([
                'type' => $i['type'],
                'key_value' => $i['key_value'],
                'is_active' => $i['is_active'],
                'domain' => $i['domain'],
                'session_id' => $i['session_id']
            ]);
        }
        // foreach ($features as $i) {
        //     print_r($i);
        // }
        // $assign = new AssignPermission([

        // ]);
        // return response()->json("The Role successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $role = Role::find($id);
        $role->update($request->all());
        return response()->json('The role successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $role = Role::find($id);
        $role->update([
            "is_active" => "No"
        ]);
        return response()->json('The role successfully deleted');
    }
}
