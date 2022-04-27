<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function abort_unless;

class UserStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_users'), 403, 'You cannot perform this action');
        $user = User::whereEmail($request->email)->first();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if($user == null)
        {
            $user = User::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'active' => !($request->active == null),
            ]);
        }
        else
        {
            $user->name = $request->name;
            $user->email = $request->email;
            if(strlen($user->password)>0)
            {
                $user->password = Hash::make($request->password);
            }
            $user->remember_token =  Str::random(10);
            $user->active = !($request->active == null);
            $user->permissions()->detach();
        }

        $permissions = array();
        if($request->permissions == 'admin')
        {
            $permissions[] = Permission::where('name', 'manage_users')->first()->id;
            $permissions[] = Permission::where('name', 'manage_students')->first()->id;
            $permissions[] = Permission::where('name', 'manage_groups')->first()->id;
            $permissions[] = Permission::where('name', 'manage_permissions')->first()->id;
        }
        else if($request->permissions == 'tutor')
        {
            $permissions[] = Permission::where('name', 'see_images')->first()->id;
            $permissions[] = Permission::where('name', 'start_thread')->first()->id;
            $permissions[] = Permission::where('name', 'messages')->first()->id;
            $permissions[] = Permission::where('name', 'manage_tags')->first()->id;
            $permissions[] = Permission::where('name', 'upload_images')->first()->id;

        }
        else if ($request->permissions == 'family')
        {
            $permissions[] = Permission::where('name', 'see_images')->first()->id;
            $permissions[] = Permission::where('name', 'start_thread')->first()->id;
            $permissions[] = Permission::where('name', 'messages')->first()->id;
        }


        $user->permissions()->attach($permissions);

        if(!($request->sendcredentials==null))
        {
            //TODO: send credentials to the mail
        }

        $user->save();

        return view('users.index')->with('users', User::orderBy('name')->get());
    }

}
