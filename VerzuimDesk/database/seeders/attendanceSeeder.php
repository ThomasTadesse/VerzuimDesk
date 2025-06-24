<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $group = Group::where('code', 'IO-SD-2408B')->first();
        
        // Get sample data for Ruben van Vliet on 2024-09-03
        $student = Student::where('student_number', '340527')->first();
        $teacher = Teacher::where('name', 'Grift,C.W.')->first();
        $subject = Subject::where('code', 'REK')->first();
        
        Attendance::create([
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'group_id' => $group->id,
            'date' => '2024-09-03',
            'present_percentage' => 1,
            'excused_absence_percentage' => 0,
            'unexcused_absence_percentage' => 0,
            'unregistered_percentage' => 0,
        ]);
        
        // Get sample data for Danny Edelbroek on 2024-09-10 (IT class with partial absence)
        $student = Student::where('student_number', '334855')->first();
        $teacher = Teacher::where('name', 'Neumann,M.H.')->first();
        $subject = Subject::where('code', 'IT')->first();
        
        Attendance::create([
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'group_id' => $group->id,
            'date' => '2024-09-10',
            'present_percentage' => 0.4916666666666666,
            'excused_absence_percentage' => 0,
            'unexcused_absence_percentage' => 0.5083333333333333,
            'unregistered_percentage' => 0,
        ]);
        
        // Add more sample records as needed
    }
}