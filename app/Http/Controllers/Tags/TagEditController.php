<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;

use Illuminate\Http\Request;
use function abort_unless;

class TagEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_tags'), 403, 'You cannot perform this action');


        $tag = Tag::where('id','=', $request->id)->first();

        return view('tags.edit')->with('tag',$tag);
    }
}
