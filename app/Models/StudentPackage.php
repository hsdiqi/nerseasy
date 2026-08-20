<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentPackage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_id',
        'package_id',

        'package_name',
        'package_price',
        'duration_per_meeting',
        'total_meetings',

        'start_date',
        'end_date',

        'used_meetings',
        'remaining_minutes',

        'status',
    ];

    protected function casts(): array
    {
        return [
            'package_price' => 'decimal:2',

            'duration_per_meeting' => 'integer',
            'total_meetings' => 'integer',
            'used_meetings' => 'integer',
            'remaining_minutes' => 'integer',

            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Mahasiswa pemilik paket.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Master paket asal.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Jadwal untuk kepesertaan ini.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Riwayat pertemuan.
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    /**
     * Riwayat pembayaran.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}