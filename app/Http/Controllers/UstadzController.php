<?php

namespace App\Http\Controllers;

use App\Models\TaklimSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;

class UstadzController extends Controller
{
    /**
     * Display ustadz profile with their schedules
     */
    public function show(string $slug): Response
    {
        // Get ustadz name from slug
        $ustadzName = str_replace('-', ' ', $slug);
        $ustadzName = ucwords($ustadzName);

        // Find schedules by this ustadz
        $schedules = TaklimSchedule::where('ustad_name', 'like', "%{$ustadzName}%")
            ->active()
            ->orderBy('schedule_date', 'asc')
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->title,
                    'description' => $schedule->description,
                    'ustad_name' => $schedule->ustad_name,
                    'mosque_name' => $schedule->mosque_name,
                    'mosque_address' => $schedule->mosque_address,
                    'mosque_city' => $schedule->mosque_city,
                    'schedule_date' => $schedule->schedule_date->format('Y-m-d'),
                    'formatted_date' => $schedule->schedule_date->format('d F Y'),
                    'day_name' => $schedule->schedule_date->format('l'),
                    'start_time' => $schedule->start_time->format('H:i'),
                    'end_time' => $schedule->end_time?->format('H:i'),
                    'time_range' => $schedule->time_range,
                    'category' => $schedule->category,
                    'frequency' => $schedule->frequency,
                    'contact_person' => $schedule->contact_person,
                    'contact_number' => $schedule->contact_number,
                ];
            });

        // Get actual ustadz name from first schedule if found
        $actualUstadzName = $schedules->first()['ustad_name'] ?? $ustadzName;

        // Get statistics
        $stats = [
            'total_schedules' => $schedules->count(),
            'upcoming_schedules' => $schedules->filter(fn($s) => strtotime($s['schedule_date']) >= strtotime('today'))->count(),
            'categories' => $schedules->pluck('category')->unique()->filter()->values(),
            'cities' => $schedules->pluck('mosque_city')->unique()->filter()->values(),
        ];

        return Inertia::render('Ustadz/Show', [
            'ustadzName' => $actualUstadzName,
            'schedules' => $schedules,
            'stats' => $stats,
        ]);
    }
}
