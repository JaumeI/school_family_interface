<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\Group;

class GroupEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');
        $group = Group::where('id', $id)->first();

        return view('groups.edit')
            ->with('group', $group)
            ->with('students',Student::whereNotIn('id',$group->students()->pluck('id')->toArray())->orderBy('name')->get())
            ->with('users',User::whereNotIn('id',$group->users()->pluck('id')->toArray())->orderBy('name')->get());;
    }
}
