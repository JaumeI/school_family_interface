<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;

class GroupUpdateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');

        //return view('users.index')->with('users', User::orderBy('name')->get());
    }

}
