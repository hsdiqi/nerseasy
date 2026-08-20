<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_package_id',
        'schedule_id',
        'tutor_id',
        'meeting_no',

        'allocated_minutes',
        'actual_minutes',
        'remaining_minutes',

        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'meeting_no' => 'integer',
            'allocated_minutes' => 'integer',
            'actual_minutes' => 'integer',
            'remaining_minutes' => 'integer',
        ];
    }

    public function studentPackage(): BelongsTo
    {
        return $this->belongsTo(StudentPackage::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Tentor yang menangani pertemuan.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'tutor_id'
        );
    }
}