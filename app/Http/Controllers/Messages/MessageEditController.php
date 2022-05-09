<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use function abort_unless;

class MessageEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');
        $request->user()->messagesWith($id);

        $user = User::where('id','=', $request->id)->first();

        return view('messages.edit')->with('messages',$request->user()->messagesWith($id))
            ->with('otherUser',$user)
            ->with('myUser',$request->user());
    }
}
