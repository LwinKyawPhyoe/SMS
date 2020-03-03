<?php

use Illuminate\Database\Seeder;

class ExamList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name'=>'Unit Test',
                'session_id'=>'2',
                'remark'=>'no Description',
                'is_active'=>'yes',
                'domain'=>'TS'
            ],
            [
                'name'=>'Final Test',
                'session_id'=>'2',
                'remark'=>'no Description',
                'is_active'=>'yes',
                'domain'=>'TS'
            ],
        ];
        foreach ($items as $item) {
            DB::table('exams')->insert([
                'name' => $item['name'],
                'session_id' => $item['session_id'],
                'remark' => $item['remark'],
                'is_active' => $item['is_active'],
                'domain' => $item['domain']
            ]);
        }

        $marksGradeItem = [
            [
                'session_id'=>'2',
                'domain'=>'TS',
                'is_active'=>'yes',
                'name'=>'A',
                'mark_from'=>'40',
                'marks_upto'=>'100',
                'description'=>'no description'
            ],
            [
                'session_id'=>'2',
                'domain'=>'TS',
                'is_active'=>'yes',
                'name'=>'B',
                'mark_from'=>'0',
                'marks_upto'=>'40',
                'description'=>'no description'
            ]
        ];

        foreach ($marksGradeItem as $marksGradeItem) {
            DB::table('marks_grades')->insert([
                'session_id' => $marksGradeItem['session_id'],
                'domain' => $marksGradeItem['domain'],
                'is_active' => $marksGradeItem['is_active'],
                'name' => $marksGradeItem['name'],
                'mark_from' => $marksGradeItem['mark_from'],
                'marks_upto'=>$marksGradeItem['marks_upto'],
                'description'=>$marksGradeItem['description']
            ]);
        }

    }
}