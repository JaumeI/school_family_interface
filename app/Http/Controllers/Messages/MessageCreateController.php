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

        return view('messages.create')
            -> with('users',User::orderBy('name')->get());

    }
}
