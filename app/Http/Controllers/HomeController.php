<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\User;
use App\Models\Student;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

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
        $totalusers = User::role('guru')->count();
        $totalstudents = Student::count();
        return view('home', compact('totalclassrooms', 'totalmajors', 'totalusers', 'totalstudents'));
    }

    public function test()
    {
        // $role = Role::create(['name' => 'guru']);
        // $permission = Permission::create(['name' => 'edit students']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        
        // $user = auth()->user();
        // $user->assignRole('admin');

        $user = User::with('roles')->get();

        return $user;
    }
}
