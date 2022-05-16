<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Tag;
use function view;

class ImageCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('upload_images'), 403, 'You cannot perform this action');

       $available_students = array();
        foreach ($request->user()->groups()->get() as $group)
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


        return view('images.edit')
            ->with('image', new Image())
            ->with('tags',Tag::orderBY('name')->get())
            ->with('students', $available_students);
    }
}
