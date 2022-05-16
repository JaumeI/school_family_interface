<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Image;


class ImageEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('edit_images'), 403, 'You cannot perform this action');
        $image = Image::find($id);
        $available_groups = $request->user()->groups()->get();
        $available_students = array();
        $existing_students = $image->students()->get();

        foreach ($available_groups as $group)
        {
            foreach($group->students()->orderBy('name')->get() as $student)
            {
                if(!$existing_students->contains($student) && !isset($available_students[$student->id]))
                {
                    $available_students[$student->id] = $student;
                }
            }
        }
        //order the students
        ksort($available_students);
        return view('images.edit')
            ->with('image', $image)
            ->with('tags',Tag::whereNotIn('id', $image->tags()->pluck('id')->toArray())->orderBy('name')->get())
            ->with('students', $available_students);

    }
}
