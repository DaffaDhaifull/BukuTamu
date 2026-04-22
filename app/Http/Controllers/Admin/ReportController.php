<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::query();

        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $guests = $query->latest()->get();

        $totalGuests = $guests->count();
        $uniqueSchools = $guests->pluck('school')->unique()->count();

        // Top schools
        $topSchools = $guests->groupBy('school')
            ->map(fn($group) => $group->count())
            ->sortDesc()
            ->take(5);

        return view('Admin.reports.index', compact(
            'guests',
            'totalGuests',
            'uniqueSchools',
            'topSchools',
            'dateFrom',
            'dateTo'
        ));
    }
}
