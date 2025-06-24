<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        $query = Student::query();
        
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
        
        // Get the paginated results
        $students = $query->latest()->paginate(12);
        
        // Append query parameters to pagination links
        if ($request->has('search') || $request->has('age_group')) {
            $students->appends($request->only(['search', 'age_group']));
        }
        
        return view('students.index', compact('students'));
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
     * Display the specified student.
     */
    public function show(Student $student)
    {
        // Get the student's attendance records
        $attendances = $student->attendances()->with(['subject', 'teacher', 'group'])->latest()->paginate(5);
        
        // Get the student's absences if the relationship exists
        $absences = [];
        if (method_exists($student, 'absences')) {
            $absences = $student->absences()->latest()->take(5)->get();
        }
        
        return view('students.show', compact('student', 'attendances', 'absences'));
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
