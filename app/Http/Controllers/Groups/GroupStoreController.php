<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function abort_unless;

class GroupStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_groups'), 403, 'You cannot perform this action');
        //Let's check if the group already exists
        $group = Group::whereid($request->id)->first();

        // Data validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        //In case of a new group, we proceed to create one
        if($group == null)
        {
            $group = Group::create([
                'name' =>  $request->name,
            ]);
        }
        else
        {
            $group->name = $request->name;
            $group->students()->detach();
            $group->users()->detach();

        }
        $group->students()->attach($request->destination_students);
        $group->users()->attach($request->destination_users);

        $group->save();

        return view('groups.index')->with('groups', Group::orderBy('name')->get());
    }

}
