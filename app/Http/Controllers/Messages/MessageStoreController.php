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
        abort_unless(auth()->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');
        $request->validate([
            'content' => ['required', 'string'],
            'otherid' => ['required', 'int']
        ]);

        $otheruser = User::find($request->otherid);

        Message::create([
            'content' => $request->input('content'),
            'user_from' => $request->user()->id,
            'user_to' => $otheruser->id,
        ]);

        return redirect()->route('messages.edit', $otheruser->id);
    }

}
