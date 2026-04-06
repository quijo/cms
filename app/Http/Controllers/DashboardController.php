<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Giving;
use App\Models\Church;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('is_active', true)->count();
        $totalChurches = Church::count();
        $totalGiving = Giving::sum('amount');
        $givingsByType = Giving::selectRaw('type, SUM(amount) as total')
                               ->groupBy('type')
                               ->get();

        return view('dashboard', compact(
            'totalMembers',
            'activeMembers',
            'totalChurches',
            'totalGiving',
            'givingsByType'
        ));
    }
}