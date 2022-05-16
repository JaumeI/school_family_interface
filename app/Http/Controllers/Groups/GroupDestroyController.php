<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use function abort_unless;

class GroupDestroyController extends Controller
{

    public function __invoke(Request $request,$id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');

        Group::find($id)->delete();

        return redirect (route('groups'));
    }

}
