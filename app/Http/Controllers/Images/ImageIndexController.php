<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use function abort_unless;
use function view;

class ImageIndexController extends Controller
{

    public function __invoke(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("messages"))
        {
            return view('dashboard');
        }

        $messages =$request->user()->messages();
        $ids=Array();
        foreach ($messages as $message )
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

        $users = User::whereIn('id',$ids)->get();

        return view('messages.index')->with('users',$users);
    }

}
