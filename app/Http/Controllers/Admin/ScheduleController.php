<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaklimSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ScheduleController extends Controller
{
    /**
     * Get formatted time range
     */
    private function getTimeRange($schedule): string
    {
        if (!$schedule->start_time) {
            return '-';
        }
        
        $start = $schedule->start_time->format('H:i');
        $end = $schedule->end_time ? ' - ' . $schedule->end_time->format('H:i') : '';
        return $start . $end;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $query = TaklimSchedule::query();

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('ustad_name', 'like', "%{$search}%")
                  ->orWhere('mosque_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $schedules = $query->orderBy('schedule_date', 'desc')
            ->paginate(15)
            ->through(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->title,
                    'ustad_name' => $schedule->ustad_name,
                    'mosque_name' => $schedule->mosque_name,
                    'mosque_city' => $schedule->mosque_city ?? '-',
                    'schedule_date' => $schedule->schedule_date ? $schedule->schedule_date->format('Y-m-d') : null,
                    'formatted_date' => $schedule->schedule_date ? $schedule->schedule_date->format('d M Y') : '-',
                    'time_range' => $this->getTimeRange($schedule),
                    'category' => $schedule->category ?? 'Umum',
                    'frequency' => $schedule->frequency,
                    'is_active' => $schedule->is_active,
                ];
            });

        return Inertia::render('Admin/Schedules/Index', [
            'schedules' => $schedules,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Schedules/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ustad_name' => 'required|string|max:255',
            'mosque_name' => 'required|string|max:255',
            'mosque_address' => 'required|string',
            'mosque_city' => 'nullable|string|max:255',
            'schedule_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'frequency' => 'required|in:once,daily,weekly,monthly',
            'category' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        TaklimSchedule::create($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaklimSchedule $schedule): Response
    {
        return Inertia::render('Admin/Schedules/Edit', [
            'schedule' => [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'description' => $schedule->description,
                'ustad_name' => $schedule->ustad_name,
                'mosque_name' => $schedule->mosque_name,
                'mosque_address' => $schedule->mosque_address,
                'mosque_city' => $schedule->mosque_city,
                'schedule_date' => $schedule->schedule_date->format('Y-m-d'),
                'start_time' => $schedule->start_time->format('H:i'),
                'end_time' => $schedule->end_time?->format('H:i'),
                'frequency' => $schedule->frequency,
                'category' => $schedule->category,
                'contact_person' => $schedule->contact_person,
                'contact_number' => $schedule->contact_number,
                'is_active' => $schedule->is_active,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaklimSchedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ustad_name' => 'required|string|max:255',
            'mosque_name' => 'required|string|max:255',
            'mosque_address' => 'required|string',
            'mosque_city' => 'nullable|string|max:255',
            'schedule_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'frequency' => 'required|in:once,daily,weekly,monthly',
            'category' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaklimSchedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
