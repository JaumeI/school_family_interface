<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use function abort_unless;

class MessageDestroyController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');
    }

}
