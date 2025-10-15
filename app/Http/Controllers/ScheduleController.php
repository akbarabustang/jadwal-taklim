<?php

namespace App\Http\Controllers;

use App\Models\TaklimSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ScheduleController extends Controller
{
    /**
     * Display full schedule table with filtering
     */
    public function index(Request $request): Response
    {
        $query = TaklimSchedule::query()->active();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('mosque_city', $request->city);
        }

        // Search by title, ustad name, or mosque name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('ustad_name', 'like', "%{$search}%")
                  ->orWhere('mosque_name', 'like', "%{$search}%");
            });
        }

        $schedules = $query->orderBy('schedule_date', 'asc')
            ->paginate(10)
            ->through(function ($schedule) {
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

        // Get unique categories and cities for filters
        $categories = TaklimSchedule::active()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        $cities = TaklimSchedule::active()
            ->distinct()
            ->pluck('mosque_city')
            ->filter()
            ->values();

        return Inertia::render('Schedule/Index', [
            'schedules' => $schedules,
            'categories' => $categories,
            'cities' => $cities,
            'filters' => $request->only(['category', 'city', 'search']),
        ]);
    }
}
