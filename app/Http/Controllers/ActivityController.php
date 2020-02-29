<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $val = "2";
        $features = array(
            (object) array(
                'id'      => '1',
                'module'  => '<b>Student Information</b>',
                'feature' => 'Student',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '2',
                'feature' => 'Student Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '3',
                'feature' => 'Guardient Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '4',
                'feature' => 'Student History',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '5',
                'feature' => 'Student Timeline',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => $val,
                'can_edit'    => false,
                'delete'  => 1,
            ),

            /***Student Attendance */
            (object) array(
                'id'      => '6',
                'module'  => '<b>Student Attendance</b>',
                'feature' => 'Student Attendance',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => $val,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '7',
                'feature' => 'Student Attendance Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add' => false,
                'can_edit' => false,
                'can_delete' => false,
            ),
            (object) array(
                'id'      => '8',
                'feature' => 'Attendance By Date',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add' => false,
                'can_edit' => false,
                'can_delete' => false,
            ),
            /***Examinations */
            (object) array(
                'id'      => '9',
                'module'  => '<b>Examination</b>',
                'feature' => 'Exam',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '10',
                'feature' => 'Exam Schedule',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => $val,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '11',
                'feature' => 'Marks Grade',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '12',
                'feature' => 'Marks Register',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'   => $val,
                'can_delete'  => false,
            ),
            /**
             * Academics
             */
            (object) array(
                'id'      => '13',
                'module'  => '<b>Academics</b>',
                'feature' => 'Class Timetable',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete' => $val,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '14',
                'feature' => 'Assign Subject',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '15',
                'feature' => 'Subject',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '16',
                'feature' => 'Class',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '17',
                'feature' => 'Section',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '18',
                'feature' => 'Promote Student',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '19',
                'feature' => '	Assign Class Teacher',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            /**DownLoad Center */
            (object) array(
                'id'      => '20',
                'module'  => '<b>Download Center</b>',
                'feature' => 'Upload Content',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => $val,
                'can_edit'    => false,
                'delete'  => 1,
            ),
            /** Transport  */
            (object) array(
                'id'      => '21',
                'module'  => '<b>Transport</b>',
                'feature' => 'Routes',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '22',
                'feature' => 'Vehicle',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '23',
                'feature' => 'Assign Vehicle',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '24',
                'feature' => 'Student Transport Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            /***Hostel */
            (object) array(
                'id'      => '25',
                'module'  => '<b>Hostel</b>',
                'feature' => 'Hostel',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '26',
                'feature' => 'Room Type',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '27',
                'feature' => 'Hostel Rooms',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '28',
                'feature' => 'Student Hostel Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            /**Report */
            (object) array(
                'id'      => '29',
                'module'  => '<b>Reports</b>',
                'feature' => 'User Log',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            /**System settings */
            (object) array(
                'id'      => '30',
                'module'  => '<b>System settings</b>',
                'feature' => 'General Setting',
                'view'    =>  1,
                'add'     => $val,
                'can_add'     => false,
                'edit'    => 1,
                'delete'  => $val,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '31',
                'feature' => 'Roles Permissions',
                'view'    =>  1,
                'can_add'     => false,
                'edit'    => 1,
                'add'     => $val,

                'delete'  => $val,
                'can_delete'  => false,
            ),

            (object) array(
                'id'      => '32',
                'feature' => 'Users',
                'view'    =>  1,
                'add'  => $val,
                'can_add'     => false,
                'edit'    => 1,

                'delete'  => $val,
                'can_delete'  => false,
            ),

            /**HRM */
            (object) array(
                'id'      => '33',
                'module'  => '<b>HRM</b>',
                'feature' => 'Staff',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),

            (object) array(
                'id'      => '34',
                'feature' => 'Staff Attendance',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,

                'delete'  => $val,
                'can_delete'  => false,
            ),

            (object) array(
                'id'      => '35',
                'feature' => 'Staff Attendance Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),

            (object) array(
                'id'      => '36',
                'feature' => 'Department',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '37',
                'feature' => 'Designation',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '38',
                'feature' => 'Can See Other Users Profile',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '39',
                'feature' => 'Staff Timeline',
                'view'    =>  1,
                'add'     => 1,

                'edit'    => $val,

                'can_edit'    => false,
                'delete'  => 1,
            ),
            /**Homework */
            (object) array(
                'id'      => '40',
                'module'  => '<b>Homework</b>',
                'feature' => 'Homework',
                'view'    =>  1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1,
            ),
            (object) array(
                'id'      => '41',
                'feature' => 'Homework Elevation',
                'view'    =>  1,
                'add'     => 1,

                'edit'    => $val,
                'delete'  => $val,
                'can_edit'    => false,
                'can_delete'  => false,
            ),
            (object) array(
                'id'      => '42',
                'feature' => 'Homework Report',
                'view'    =>  1,
                'add'     => $val,
                'edit'    => $val,
                'delete'  => $val,
                'can_add'     => false,
                'can_edit'    => false,
                'can_delete'  => false,
            ),

        );




        return ($features);
    }

    public function month()
    {
        $months = array(
            (object) array(
                'id'      => '1',
                'month'  => 'Jan',
            ),
            (object) array(
                'id'      => '2',
                'month'  => 'Feb',
            ),
            (object) array(
                'id'      => '3',
                'month'  => 'Mar',
            ),
            (object) array(
                'id'      => '4',
                'month'  => 'Apr',
            ),
            (object) array(
                'id'      => '5',
                'month'  => 'May',
            ),
            (object) array(
                'id'      => '6',
                'month'  => 'Jun',
            ),
            (object) array(
                'id'      => '7',
                'month'  => 'Jul',
            ),
            (object) array(
                'id'      => '8',
                'month'  => 'Aug',
            ),
            (object) array(
                'id'      => '9',
                'month'  => 'Sep',
            ),
            (object) array(
                'id'      => '10',
                'month'  => 'Oct',
            ),
            (object) array(
                'id'      => '11',
                'month'  => 'Nov',
            ),
            (object) array(
                'id'      => '12',
                'month'  => 'Dec',
            ),
        );
        asort($months);
        return ($months);
    }
}
