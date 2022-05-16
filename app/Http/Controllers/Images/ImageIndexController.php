<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Tag;
use function view;

class ImageIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        if($request->user()->hasPermissionTo('edit_images'))
        {

            return view('images.editlist')
                ->with('images',Image::orderBy('name')->get())
                ->with('tags',Tag::orderBy('name')->get());

        }
        else if($request->user()->hasPermissionTo('see_images'))
        {
            $students =$request->user()->students()->orderBy('name')->get();
            $images = array();
            $tags = array();
            foreach ($students as $student )
            {
                foreach($student->images()->get() as $image)
                {
                    if(!isset($images[$image->id]))
                    {
                        $images[$image->id] = $image;
                        foreach ($image->tags()->get() as $tag)
                        {
                            if(!isset($tags[$tag->id]))
                            {
                                $tags[$tag->id] = $tag;
                            }
                        }

                    }
                }
            }
            $images = array_unique($images);

            return view('images.index')
                ->with('images', $images)
                ->with('tags', $tags);

        }
        else
        {
            abort(403, 'You cannot perform this action');
        }

    }

}
