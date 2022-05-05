<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Group;
use function view;

class GroupCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');

        return view('groups.edit')->with('group', new Group());
    }
}
