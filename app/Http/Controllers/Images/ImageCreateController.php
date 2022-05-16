<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Tag;
use function view;

class ImageCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('upload_images'), 403, 'You cannot perform this action');
        $available_groups = $request->user()->groups()->get();
        $available_students = array();
        $appearing_students = array();
        $applied_tags = array();
        foreach ($available_groups as $group)
        {
            foreach($group->students()->orderBy('name')->get() as $student)
            {
                if(!isset($available_students[$student->id]))
                {
                    $available_students[$student->id] = $student;
                }
            }
        }
        //order the students
        ksort($available_students);


        return view('images.create')
            ->with('tags',Tag::orderBY('name')->get())
            ->with('students', $available_students)
            ->with('appearing_students', $appearing_students)
            ->with('applied_tags', $applied_tags);

    }
}
