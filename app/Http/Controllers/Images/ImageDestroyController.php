<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use function abort_unless;

class ImageDestroyController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo(''), 403, 'You cannot perform this action');
    }

}
