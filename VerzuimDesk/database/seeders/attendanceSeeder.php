<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    // Constants for attendance percentages
    private const PRESENT_PERCENTAGE = 0.684;      // 68.4% present
    private const EXCUSED_ABSENCE_PERCENTAGE = 0.227;   // 22.7% excused absence
    private const UNEXCUSED_ABSENCE_PERCENTAGE = 0.077;  // 7.7% unexcused absence
    private const UNREGISTERED_PERCENTAGE = 0.012;  // 1.2% unregistered

    public function run()
    {
        $groups = Group::all();
        $students = Student::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        
        // Generate attendance records for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }
            
            // For each day, create 3-5 subject sessions
            $dailySubjects = $subjects->random(rand(3, 5));
            
            foreach ($dailySubjects as $subject) {
                // Assign a random teacher for this subject
                $teacher = $teachers->random();
                
                // Create attendance for all students
                foreach ($students as $student) {
                    // Get a random group for this attendance record
                    $group = $groups->random();
                    
                    // Use the defined constant percentages
                    $presentPercentage = self::PRESENT_PERCENTAGE;
                    $excusedAbsencePercentage = self::EXCUSED_ABSENCE_PERCENTAGE;
                    $unexcusedAbsencePercentage = self::UNEXCUSED_ABSENCE_PERCENTAGE;
                    $unregisteredPercentage = self::UNREGISTERED_PERCENTAGE;
                    
                    // Sometimes make students fully present or fully absent
                    $specialCase = rand(0, 10);
                    if ($specialCase >= 8) {
                        // Fully present
                        $presentPercentage = 1;
                        $excusedAbsencePercentage = 0;
                        $unexcusedAbsencePercentage = 0;
                        $unregisteredPercentage = 0;
                    } elseif ($specialCase <= 1) {
                        // Fully unexcused absent
                        $presentPercentage = 0;
                        $excusedAbsencePercentage = 0;
                        $unexcusedAbsencePercentage = 1;
                        $unregisteredPercentage = 0;
                    }
                    
                    Attendance::create([
                        'student_id' => $student->id,
                        'teacher_id' => $teacher->id,
                        'subject_id' => $subject->id,
                        'group_id' => $group->id,
                        'date' => $date->format('Y-m-d'),
                        'present_percentage' => $presentPercentage,
                        'excused_absence_percentage' => $excusedAbsencePercentage,
                        'unexcused_absence_percentage' => $unexcusedAbsencePercentage,
                        'unregistered_percentage' => $unregisteredPercentage,
                    ]);
                }
            }
        }
    }
    
    /**
     * Generate a random percentage between 0 and the maximum value
     * 
     * @param float $max Maximum possible value (default: 1)
     * @return float
     */
    private function generateRandomPercentage($max = 1)
    {
        return round(mt_rand(0, $max * 100) / 100, 4);
    }
}