<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Later: load saved bills and notification preferences for the authenticated user.
        return view('dashboard.index', [
            'user' => $request->user(),
        ]);
    }
}


