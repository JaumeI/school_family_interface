<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;

use Illuminate\Http\Request;
use function abort_unless;
use function view;

class TagIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_tags'), 403, 'You cannot perform this action');

        return view('tags.index')->with('tags',Tag::orderBy('name')->get());
    }

}
