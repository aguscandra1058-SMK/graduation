<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\User;
use App\Models\Student;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalclassrooms = Classroom::count();
        $totalmajors = Major::count();
        $totalusers = User::count();
        $totalstudents = Student::count();
        return view('home', compact('totalclassrooms', 'totalmajors', 'totalusers', 'totalstudents'));
    }
}
