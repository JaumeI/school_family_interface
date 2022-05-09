<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke(Request $request)
    {
        if (auth()->user()->hasPermissionTo("messages"))
        {

            return view('messages.index');
        }
        else
        {
            return view('dashboard');
        }


    }
}
