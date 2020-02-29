<?php

use Illuminate\Database\Seeder;

class AcademicsMenuSeeder extends Seeder
{
    public function run()
    {
        $SessionList = [
            [ 
                'session' => '2018-19',
                'is_active' => 'no',
                'domain' => 'TS'
            ],
            [ 
                'session' => '2019-20',
                'is_active' => 'yes',
                'domain' => 'TS'
            ],
            [ 
                'session' => '2020-21',
                'is_active' => 'no',
                'domain' => 'TS'
            ],
            [ 
                'session' => '2021-22',
                'is_active' => 'no',
                'domain' => 'TS'
            ],
            [ 
                'session' => '2023-24',
                'is_active' => 'no',
                'domain' => 'TS'
            ]
        ];
        foreach ($SessionList as $session) {
            DB::table('academic_years')->insert([
                'session' => $session['session'],                
                'is_active' => $session['is_active'],
                'domain' => $session['domain']
            ]);
        }

        $SectionList = [
            [
                'section' => 'A',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'section' => 'B',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'section' => 'C',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ]
        ];
        foreach ($SectionList as $section) {
            DB::table('sections')->insert([
                'section' => $section['section'],                
                'is_active' => $section['is_active'],
                'domain' => $section['domain'],
                'session_id' => $section['session_id'],
            ]);
        }

        $ClassList = [
            [
                'class' => 'class 1',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'class' => 'class 2',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ]
        ];
        foreach ($ClassList as $class) {
            DB::table('classes')->insert([
                'class' => $class['class'],                
                'is_active' => $class['is_active'],
                'domain' => $class['domain'],
                'session_id' => $class['session_id'],
            ]);
        }

        $ClassSectionList = [
            [
                'class_id' => 1,
                'section_id' => 1,
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'class_id' => 1,
                'section_id' => 2,
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'class_id' => 2,
                'section_id' => 1,
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'class_id' => 2,
                'section_id' => 2,
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'class_id' => 2,
                'section_id' => 3,
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ]            
        ];
        foreach ($ClassSectionList as $classsection) {
            DB::table('class_sections')->insert([
                'class_id' => $classsection['class_id'],
                'section_id' => $classsection['section_id'],
                'is_active' => $classsection['is_active'],
                'domain' => $classsection['domain'],
                'session_id' => $classsection['session_id'],
            ]);
        }

        $SubjectList = [
            [
                'name' => 'Myanmar',
                'type' => 'theory',
                'code' => '101',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'name' => 'English',
                'type' => 'theory',
                'code' => '102',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'name' => 'Math',
                'type' => 'theory',
                'code' => '103',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ],
            [
                'name' => 'Drawing',
                'type' => 'practical',
                'code' => '104',
                'is_active' => 'yes',
                'domain' => 'TS',
                'session_id' => 2
            ]
        ];
        foreach ($SubjectList as $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'type' => $subject['type'],
                'code' => $subject['code'],
                'is_active' => $subject['is_active'],
                'domain' => $subject['domain'],
                'session_id' => $subject['session_id'],
            ]);
        }
    }
}
