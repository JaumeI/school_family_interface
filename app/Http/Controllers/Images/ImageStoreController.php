<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;
use function abort_unless;

class ImageStoreController extends Controller
{

    public function __invoke(Request $request)
    {

        $image = Image::find($request->id);
        // if we are editing an existing image
        if($image!=null)
        {
            abort_unless($request->user()->hasPermissionTo('edit_images'), 403, 'You cannot perform this action');
            $image->tags()->detach();
            $image->students()->detach();
        }
        else
        {

            abort_unless($request->user()->hasPermissionTo('upload_images'), 403, 'You cannot perform this action');
            //if it's a new image
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ]);

            $folder = env('IMAGE_FOLDER', 'images/studentimages').'/'.Carbon::now()->format('Ym') . '/';
            $name = Carbon::now()->getPreciseTimestamp(3).$request->user()->id.'.'.$request->image->extension();
            $path =  $request->image->move($folder,$name);

            $image = Image::create([
                'name' => $name,
                'path' => $folder,
                'uploader_id' => $request->user()->id,
            ]);
        }

        $image->tags()->attach($request->destination_tags);

        $image->students()->attach($request->destination_students);

        return(redirect(route('images')));
    }
}
