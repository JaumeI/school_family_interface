<?php

namespace App\Http\Controllers\Images;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;

class ImageEditController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless($request->user()->hasPermissionTo('upload_images'), 403, 'You cannot perform this action');
        redirect(route('images'));

    }
}
