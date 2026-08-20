<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_package_id',
        'tutor_id',
        'created_by',
        'requested_date',
        'scheduled_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'requested_date' => 'datetime',
            'scheduled_at' => 'datetime',
        ];
    }

    /**
     * Kepesertaan / paket mahasiswa.
     */
    public function studentPackage(): BelongsTo
    {
        return $this->belongsTo(StudentPackage::class);
    }

    /**
     * Tentor yang mengajar.
     *
     * Karena tentor disimpan di users.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'tutor_id'
        );
    }

    /**
     * Admin yang membuat jadwal.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /**
     * Realisasi dari jadwal.
     */
    public function meeting(): HasOne
    {
        return $this->hasOne(Meeting::class);
    }
}