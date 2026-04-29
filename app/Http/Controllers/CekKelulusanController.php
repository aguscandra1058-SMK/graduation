<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class CekKelulusanController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    // proses cek
    public function hasil(Request $request)
    {
        $request->validate([
            'nisn' => 'required|digits_between:8,10'
        ]);

        $students = Student::where('nisn', $request->nisn)->first();

        return view('welcome', compact('students'));
    }
}
