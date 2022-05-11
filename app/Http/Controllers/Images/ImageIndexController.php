<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use function abort_unless;
use function view;

class ImageIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('see_images'), 403, 'You cannot perform this action');


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

}
