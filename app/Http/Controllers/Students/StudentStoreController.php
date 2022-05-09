<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function abort_unless;

class StudentStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_students'), 403, 'You cannot perform this action');
        //Let's check if the student already exists
        $student = Student::whereid($request->id)->first();

        // Data validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        //In case of a new student, we proceed to create one
        if($student == null)
        {
            $student = Student::create([
                'name' =>  $request->name,
            ]);
        }
        else
        {
            $student->name = $request->name;
            $student->groups()->detach();
            $student->users()->detach();

        }
        $student->groups()->attach($request->destination_groups);
        $student->users()->attach($request->destination_users);

        $student->save();

        return view('students.index')->with('students', Student::orderBy('name')->get());
    }

}
