<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuests = Guest::count();
        $todayGuests = Guest::whereDate('created_at', Carbon::today())->count();
        $uniqueSchools = Guest::distinct('school')->count('school');
        $weekGuests = Guest::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $recentGuests = Guest::latest()->take(5)->get();

        // Guest per day for last 7 days (for bar chart)
        $dailyGuests = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyGuests[] = [
                'label' => $date->translatedFormat('D'),
                'date' => $date->format('d M'),
                'count' => Guest::whereDate('created_at', $date)->count(),
            ];
        }

        $maxDaily = max(array_column($dailyGuests, 'count') ?: [1]);
        if ($maxDaily === 0) $maxDaily = 1;

        return view('Admin.dashboard', compact(
            'totalGuests',
            'todayGuests',
            'uniqueSchools',
            'weekGuests',
            'recentGuests',
            'dailyGuests',
            'maxDaily'
        ));
    }
}
