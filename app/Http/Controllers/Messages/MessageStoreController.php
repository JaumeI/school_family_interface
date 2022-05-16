<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use function abort_unless;

class MessageStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');
        $request->validate([
            'content' => ['required', 'string'],

        ]);

        $otheruser = User::where('id','=', $request->otherid)->first();

        Message::create([
            'content' => $request->message,
            'user_from' => $request->user()->id,
            'user_to' => $otheruser->id,
        ]);

        return view('messages.edit')->with('messages',$request->user()->messagesWith($otheruser->id))
            ->with('otherUser',$otheruser)
            ->with('myUser',$request->user());
    }

}
