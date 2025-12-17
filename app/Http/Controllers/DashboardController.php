<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedBill;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $savedBills = SavedBill::where('user_id', $user->id)
            ->orderByDesc('last_checked_at')
            ->orderBy('created_at')
            ->get();

        return view('dashboard.index', [
            'user' => $user,
            'savedBills' => $savedBills,
        ]);
    }
}


