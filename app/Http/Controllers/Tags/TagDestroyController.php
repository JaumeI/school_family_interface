<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use function abort_unless;

class TagDestroyController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_tags'), 403, 'You cannot perform this action');

        Tag::find($id)->delete();

        return redirect(route('tags'));
    }

}
