<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use function abort_unless;

class UserDestroyController extends Controller
{

    public function __invoke(Request $request, $id )
    {
        abort_unless($request->user()->hasPermissionTo('manage_users'), 403, 'You cannot perform this action');

        User::find($id)->delete();

        return redirect(route('users'));
    }

}
