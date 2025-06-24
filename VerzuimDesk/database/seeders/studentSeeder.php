<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['student_number' => '340527', 'name' => 'Vliet, Ruben van', 'age_group' => '<18'],
            ['student_number' => '334855', 'name' => 'Edelbroek, Danny', 'age_group' => '18-22'],
            ['student_number' => '325602', 'name' => 'Veenstra, Nicky', 'age_group' => '18-22'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}