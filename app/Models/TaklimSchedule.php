<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TaklimSchedule extends Model
{
    protected $fillable = [
        'title',
        'description',
        'ustad_name',
        'mosque_name',
        'mosque_address',
        'mosque_city',
        'schedule_date',
        'start_time',
        'end_time',
        'frequency',
        'category',
        'is_active',
        'contact_person',
        'contact_number',
    ];

    protected $casts = [
        'schedule_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for upcoming schedules
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc');
    }

    /**
     * Scope for active schedules
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Get formatted schedule date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->schedule_date->format('d F Y');
    }

    /**
     * Get formatted time range
     */
    public function getTimeRangeAttribute(): string
    {
        $start = $this->start_time->format('H:i');
        $end = $this->end_time ? ' - ' . $this->end_time->format('H:i') : '';
        return $start . $end;
    }
}
