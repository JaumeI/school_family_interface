<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function abort_unless;

class StudentUpdateController extends Controller
{

    public function __invoke(Request $request)
    {
        abort_unless($request->user()->hasPermissionTo('manage_students'), 403, 'You cannot perform this action');

        return redirect(route('students'));
    }

}
