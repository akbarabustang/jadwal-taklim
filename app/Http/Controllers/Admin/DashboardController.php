<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaklimSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index(): Response
    {
        $stats = [
            'total_schedules' => TaklimSchedule::count(),
            'active_schedules' => TaklimSchedule::where('is_active', true)->count(),
            'upcoming_schedules' => TaklimSchedule::upcoming()->count(),
            'categories_count' => TaklimSchedule::distinct('category')->count('category'),
        ];

        $recentSchedules = TaklimSchedule::latest()
            ->limit(5)
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->title,
                    'ustad_name' => $schedule->ustad_name,
                    'mosque_name' => $schedule->mosque_name,
                    'schedule_date' => $schedule->schedule_date->format('d M Y'),
                    'is_active' => $schedule->is_active,
                ];
            });

        $categoryStats = TaklimSchedule::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentSchedules' => $recentSchedules,
            'categoryStats' => $categoryStats,
        ]);
    }
}
