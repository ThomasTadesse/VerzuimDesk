<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Group;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendances.
     */
    public function index()
    {
        $attendances = Attendance::with(['student', 'teacher', 'subject', 'group'])->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance.
     */
    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $groups = Group::all();
        
        return view('attendances.create', compact('students', 'teachers', 'subjects', 'groups'));
    }

    /**
     * Store a newly created attendance in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'group_id' => 'required|exists:groups,id',
            'date' => 'required|date',
            'present_percentage' => 'required|numeric|min:0|max:100',
            'excused_absence_percentage' => 'required|numeric|min:0|max:100',
            'unexcused_absence_percentage' => 'required|numeric|min:0|max:100',
            'unregistered_percentage' => 'required|numeric|min:0|max:100',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendances.index')->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified attendance.
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified attendance.
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $groups = Group::all();
        
        return view('attendances.edit', compact('attendance', 'students', 'teachers', 'subjects', 'groups'));
    }

    /**
     * Update the specified attendance in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'group_id' => 'required|exists:groups,id',
            'date' => 'required|date',
            'present_percentage' => 'required|numeric|min:0|max:100',
            'excused_absence_percentage' => 'required|numeric|min:0|max:100',
            'unexcused_absence_percentage' => 'required|numeric|min:0|max:100',
            'unregistered_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified attendance from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance record deleted successfully.');
    }
}
