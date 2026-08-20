<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'status',
        'registered_at',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'date',
        ];
    }

    /**
     * Seluruh paket yang pernah dibeli mahasiswa.
     */
    public function studentPackages(): HasMany
    {
        return $this->hasMany(StudentPackage::class);
    }
}