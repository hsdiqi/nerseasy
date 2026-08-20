<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueRule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'package_id',
        'recipient_type',
        'calculation_type',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
        ];
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}