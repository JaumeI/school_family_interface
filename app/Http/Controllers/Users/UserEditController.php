<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Student;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\User;
use App\Models\Group;
class UserEditController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('manage_users'), 403, 'You cannot perform this action');
        $user = User::where('id', $id)->first();
        return view('users.edit')
            ->with('user', $user)
            ->with('permissions', Permission::whereNotIn('id',$user->permissions()->pluck('id')->toArray())->orderBy('name')->get())
            ->with('groups', Group::whereNotIn('id',$user->groups()->pluck('id')->toArray())->orderBy('name')->get())
            ->with('students', Student::whereNotIn('id',$user->students()->pluck('id')->toArray())->orderBy('name')->get());
    }
}

