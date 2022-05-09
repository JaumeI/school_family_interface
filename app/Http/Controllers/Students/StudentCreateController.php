<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Group;
use App\Models\Student;
use function view;

class StudentCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_students'), 403, 'You cannot perform this action');

        return view('students.edit')
            ->with('student', new Student())
            ->with('groups',Group::orderBy('name')->get());


    }
}
