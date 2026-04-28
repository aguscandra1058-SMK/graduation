<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Major;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classroom = Classroom::all();
        $major = Major::all();
        $students = Student::with('classroom', 'major')->get();
        return view('student.index', compact('students', 'classroom', 'major'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('student.create', compact('classrooms', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
            'nisn' => 'required|unique:students,nisn',
            'name' => 'required',
            'gender' => 'required',
            'id_classroom' => 'required',
            'id_major' => 'required',
            'status' => 'required'
        ]);

        Student::create($request->all());

        return redirect('students');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('student.edit', compact('student', 'classrooms', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis,' . $student->id,
            'nisn' => 'required|unique:students,nisn,' . $student->id,
            'name' => 'required',
            'gender' => 'required',
            'id_classroom' => 'required',
            'id_major' => 'required',
            'status' => 'required'
        ]);

        $student->update($request->all());
        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('students');
    }
}
