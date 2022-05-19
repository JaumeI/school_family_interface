<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use function abort_unless;

class ImageDestroyController extends Controller
{

    public function __invoke(Request $request, $id)
    {
        abort_unless(auth()->user()->hasPermissionTo('edit_images'), 403, 'You cannot perform this action');

        Image::find($id)->delete();

        return redirect(route('images'));
    }

}
