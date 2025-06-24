<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        $query = Student::with('group');
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%");
            });
        }
        
        // Apply age group filter if provided
        if ($request->has('age_group') && !empty($request->age_group)) {
            $query->where('age_group', $request->age_group);
        }
        
        // Apply group filter if provided
        if ($request->has('group_code') && !empty($request->group_code)) {
            // Find the group by code
            $group = Group::where('code', $request->group_code)->first();
            
            if ($group) {
                // Get all student IDs from attendances that have the requested group
                $studentIds = Attendance::where('group_id', $group->id)
                                      ->distinct()
                                      ->pluck('student_id')
                                      ->toArray();
                                      
                $query->whereIn('id', $studentIds);
            }
        }
        
        // Get the paginated results
        $students = $query->latest()->paginate(12);
        
        // We need to make sure each student has group information available
        $students->map(function ($student) {
            // If student doesn't have a group relationship, get it from the latest attendance
            if (!$student->group) {
                $latestAttendance = Attendance::where('student_id', $student->id)
                    ->with('group')
                    ->latest('date')
                    ->first();
                
                // Set the group code property directly on the student object
                $student->group_code = $latestAttendance && $latestAttendance->group 
                    ? $latestAttendance->group->code 
                    : null;
            }
            return $student;
        });
        
        // Get all unique group codes for the filter dropdown
        $groupCodes = Group::orderBy('code')->pluck('code')->unique();
        
        // Append query parameters to pagination links
        if ($request->has('search') || $request->has('age_group') || $request->has('group_code')) {
            $students->appends($request->only(['search', 'age_group', 'group_code']));
        }
        
        return view('students.index', compact('students', 'groupCodes'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:255|unique:students,student_number',
            'name' => 'required|string|max:255',
            'age_group' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        // Get attendance data for the chart - last 6 months
        $attendanceData = $this->getStudentAttendanceData($student);
        
        // Get absence records for the list display
        $absences = $this->getStudentAbsenceRecords($student);

        // Try to get group information from the student's most recent attendance
        $latestAttendance = Attendance::where('student_id', $student->id)
            ->with('group')  // Ensure we have the group relation
            ->latest('date')
            ->first();
            
        $groupCode = $latestAttendance && $latestAttendance->group ? $latestAttendance->group->code : null;

        return view('students.show', compact('student', 'absences', 'attendanceData', 'groupCode'));
    }
    
    /**
     * Get formatted attendance data for charts
     */
    private function getStudentAttendanceData(Student $student)
    {
        // Get last 6 months of data
        $sixMonthsAgo = Carbon::now()->subMonths(6)->toDateString();
        
        // Use SQLite compatible date functions
        $attendanceData = DB::table('attendances')
            ->select(
                DB::raw("strftime('%m', date) as month_num"),
                DB::raw("strftime('%m-%Y', date) as month_year"),
                DB::raw('SUM(excused_absence_percentage) as excused_absence'),
                DB::raw('SUM(unexcused_absence_percentage) as unexcused_absence')
            )
            ->where('student_id', $student->id)
            ->where('date', '>=', $sixMonthsAgo)
            ->groupBy('month_num', 'month_year')
            ->orderBy('month_year')
            ->get();
        
        // Convert month numbers to month names
        $monthNames = [
            '01' => 'January', '02' => 'February', '03' => 'March', 
            '04' => 'April', '05' => 'May', '06' => 'June',
            '07' => 'July', '08' => 'August', '09' => 'September',
            '10' => 'October', '11' => 'November', '12' => 'December'
        ];
        
        foreach ($attendanceData as $item) {
            // Extract the month part from month_year
            $monthPart = substr($item->month_num, 0, 2);
            $item->month = $monthNames[$monthPart] ?? $monthPart;
            
            // Round the values for better display
            $item->excused_absence = round($item->excused_absence, 2);
            $item->unexcused_absence = round($item->unexcused_absence, 2);
        }
        
        return $attendanceData;
    }
    
    /**
     * Get individual absence records for the student
     */
    private function getStudentAbsenceRecords(Student $student)
    {
        // Get records for display in the absence list
        // This would be used for the existing absences section in the view
        return Attendance::where('student_id', $student->id)
            ->whereRaw('(unexcused_absence_percentage > 0 OR excused_absence_percentage > 0)')
            ->with('subject')
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get()
            ->map(function($attendance) {
                return (object)[
                    'date' => Carbon::parse($attendance->date),
                    'type' => $attendance->subject->name ?? 'Unknown subject',
                    'is_authorized' => $attendance->excused_absence_percentage > 0 && $attendance->unexcused_absence_percentage == 0
                ];
            });
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:255|unique:students,student_number,' . $student->id,
            'name' => 'required|string|max:255',
            'age_group' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        // Check if student has related attendances before deleting
        if ($student->attendances()->count() > 0) {
            return redirect()->route('students.index')->with('error', 'Cannot delete student with attendance records.');
        }
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
