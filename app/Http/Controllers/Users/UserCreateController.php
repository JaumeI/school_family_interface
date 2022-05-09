<?php




namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;
use App\Models\User;
use App\Models\Permission;
use function view;

class UserCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_users'), 403, 'You cannot perform this action');

        return view('users.edit')
            ->with('user', new User())
            ->with('permissions', Permission::orderBy('public_name')->get());
    }
}

