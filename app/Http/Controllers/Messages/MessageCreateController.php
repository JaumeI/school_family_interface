<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use function abort_unless;
use App\Models\User;
use function view;

class MessageCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');

        // Let's filter all users we are already messaging, or ourselves
        $messages =$request->user()->messages();
        $ids[]=$request->user()->id;
        foreach ($messages as $message)
        {
            // Is the sender ourselves? Is it already in the array?
            if( $message->user_from != $request->user()->id && !in_array($message->user_from, $ids))
            {
                $ids[] = $message->user_from;
            }
            // Is the receiver ourselves? Is it already in the array?
            else if($message->user_to != $request->user()->id && !in_array($message->user_to, $ids)){
                $ids[] = $message->user_to;
            }
        }

        // We get all the users we are NOT already messaging
        $users = User::whereNotIn('id',$ids)->get();

        return view('messages.create')
            -> with('users',$users);

    }
}
