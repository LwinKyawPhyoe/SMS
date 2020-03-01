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
        
    

        foreach ($items as $item) {
            DB::table('attendance_types')->insert([
                'type' => $item['type'],
                'key_value' => $item['key_value'],
                'is_active' => $item['is_active'],
                'domain' => $item['domain'],
                'session_id' => $item['session_id']
            ]);
        }
        $this->call([
            StudentsTableSeeder::class,
            AcademicsMenuSeeder::class,
        ]);


        /***By Wai Yan Soe */
        $roles = [
            [
                'name' => "Admin",
                'is_active' => "yes",
                "domain"  => "TS"
            ],
            [
                'name' => "Teacher",
                'is_active' => "yes",
                "domain"  => "TS"
            ],
            [
                'name' => "Parent",
                'is_active' => "No",
                "domain"  => "TS"
            ],
        ];

       
        foreach ($roles as $item) {
            DB::table('roles')->insert([
                'name' => $item['name'],
                'type' => 'System',
                'is_active' => $item['is_active'],
                'domain' => $item['domain'],
            ]);
        }

        DB::table('departments')->insert([
            'department_name' => "Arts",
            'is_active' => 'yes'
        ]);
        DB::table('designations')->insert([
            'designation_name' => "Teacher",
            'is_active' => 'yes'

        ]);
        /***end code of Wai Yan Soe */
        DB::table('generals')->insert([
            'color'=> 'defaultColor'
        ]);
        DB::table('school_details')->insert([
            'school_name' => 'Private School',
            'school_code' => 'MM-294905',
            'address' => 'Myanmar, Mogok',
            'phone' => '09284958284',
            'email' =>'tastysoft1234@gmail.com',
            'session' => '2019-20',
            'session_month' => 'July',
            'language' => 'English',
            'schoollogo' => 'titleImage.png',
        ]);
    }
}
