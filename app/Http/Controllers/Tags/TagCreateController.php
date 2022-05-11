<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Tag;
use function view;

class TagCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_tags'), 403, 'You cannot perform this action');

        return view('tags.edit')->with('tag',new Tag());
    }
}
