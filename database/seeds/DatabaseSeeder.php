<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $items = [
            [
                'type' => 'Present',
                'key_value' => '<b class="text-success">P<b>',
                'is_active' => 'yes',
                'domain' => 'all',
                'session_id' => '1',
            ],
            [
                'type' => 'Late',
                'key_value' => '<b class="text-warning">L<b>',
                'is_active' => 'yes',
                'domain' => 'all',
                'session_id' => '1',
            ],
            [
                'type' => 'Absent',
                'key_value' => '<b class="text-danger">A<b>',
                'is_active' => 'yes',
                'domain' => 'all',
                'session_id' => '1',
            ],
            [
                'type' => 'Half',
                'key_value' => '<b class="text-warning">F<b>',
                'is_active' => 'yes',
                'domain' => 'all',
                'session_id' => '1'
            ],
            [
                'type' => 'Holiday',
                'key_value' => '<b class="text-danger">A<b>',
                'is_active' => 'no',
                'domain' => 'all',
                'session_id' => '1'
            ],
            [
                'type' => 'Absent',
                'key_value' => '<b class="text-danger">A<b>',
                'is_active' => 'yes',
                'domain' => 'all',
                'session_id' => '1'
            ]
        ];
        $roles = [
            [
                'name' => "Super Admin",
                'is_active' => "No",
                "domain"  => "sms"
            ],
            [
                'name' => "Teacher",
                'is_active' => "No",
                "domain"  => "sms"
            ],
            [
                'name' => "Student",
                'is_active' => "No",
                "domain"  => "sms"
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'type' => 'System',
                'is_active' => $role['is_active'],
                'domain' => $role['domain'],
            ]);
        }
        DB::table('departments')->insert([
            'department_name' => "Arts"
        ]);
        DB::table('designations')->insert([
            'designation_name' => "Teacher"
        ]);

        foreach ($items as $item) {
            DB::table('attendance_types')->insert([
                'type' => $item['type'],
                'key_value' => $item['key_value'],
                'is_active' => $item['is_active'],
                'domain' => $item['domain'],
                'session_id' => $item['session_id']
            ]);
        }
        DB::table('generals')->insert([
            'color'=> 'defaultColor'
        ]);
    }
}
