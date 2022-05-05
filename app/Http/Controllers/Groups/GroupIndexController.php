<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use function abort_unless;
use function view;

class GroupIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');
        return view('groups.index')->with('groups', Group::orderBy('name')->get());
    }

}
