<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;

class ImageUpdateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('messages'), 403, 'You cannot perform this action');

        return redirect(route('images'));
    }

}
