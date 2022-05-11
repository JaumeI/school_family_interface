<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use function abort_unless;

class TagStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_tags'), 403, 'You cannot perform this action');



        //Let's check if the tag already exists
        $tag = Tag::whereid($request->id)->first();

        // Data validation
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags'],
        ]);

        //In case of a new tag, we proceed to create it
        if($tag == null)
        {
            $tag = Tag::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        else
        {
            $tag->name = $request->name;
            $tag->description = $request->description;
        }
        $tag->save();
        return view('tags.index')->with('tags',Tag::orderBy('name')->get());
    }

}
