<?php

namespace App\Http\Controllers;

use App\Models\TaklimSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the homepage with upcoming taklim schedules
     */
    public function index(): Response
    {
        $upcomingSchedules = TaklimSchedule::upcoming()
            ->limit(6)
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
                ];
            });

        return Inertia::render('Home', [
            'upcomingSchedules' => $upcomingSchedules,
        ]);
    }
}
