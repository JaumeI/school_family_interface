<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use function abort_unless;

class StudentIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_students'), 403, 'You cannot perform this action');
        return view('students.index')->with('students', Student::orderBy('name')->get());
    }

}
