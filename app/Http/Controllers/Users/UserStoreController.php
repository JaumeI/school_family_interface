<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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
        //Let's check if the user (email) already exists
        $user = User::whereEmail($request->email)->first();

        //In case of a new user, we proceed to create one
        if($user == null)
        {
            // New data validation
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user = User::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'active' => !($request->active == null),
            ]);
        }
        else //otherwise, we get the new data and update it, except the email
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $user->name = $request->name;
            // No need to update email, we use it as key
            // If no new password, we keep the old. Otherwise we update the password.
            if(strlen($user->password)>0)
            {
                $user->password = Hash::make($request->password);
            }
            $user->remember_token =  Str::random(10);
            $user->active = !($request->active == null);
            // We erase all permissions, on the next block we add the news.
            // This is more efficient than checking one by one if the user already has them.
            $user->permissions()->detach();
            $user->groups()->detach();
            $user->students()->detach();
        }

        $user->permissions()->attach($request->destination_permissions);
        $user->groups()->attach($request->destination_groups);
        $user->students()->attach($request->destination_students);

        if(!($request->sendcredentials==null))
        {
            //TODO: send credentials to the mail
        }

        $user->save();

        return redirect(route('users'));
    }

}
