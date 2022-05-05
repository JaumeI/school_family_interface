<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Group;

class StudentEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_students'), 403, 'You cannot perform this action');
        //$group = Group::where('id', $id)->first();
        $student  = student::where('id', $id)->first();
        return view('students.edit')
            ->with('student', $student)
            ->with('groups',Group::whereNotIn('id',$student->groups()->pluck('id')->toArray())->orderBy('name')->get());
    }
}
