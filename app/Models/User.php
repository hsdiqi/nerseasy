<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use app\Enums\UserRole;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(UserRole|string $role): bool
    {
        $role = $role instanceof UserRole
            ? $role->value
            : $role;

        return $this->roles()
            ->where('name', $role)
            ->exists();
    }

    public function hasAnyRole(UserRole|string ...$roles): bool
    {
        $roles = collect($roles)
            ->map(
                fn($role) => $role instanceof UserRole
                ? $role->value
                : $role
            );

        return $this->roles()
            ->whereIn('name', $roles)
            ->exists();
    }

    public function createdSchedules(): HasMany
    {
        return $this->hasMany(
            Schedule::class,
            'created_by'
        );
    }

    public function tutorSchedules(): HasMany
    {
        return $this->hasMany(
            Schedule::class,
            'tutor_id'
        );
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(
            Meeting::class,
            'tutor_id'
        );
    }

    public function recordedPayments(): HasMany
    {
        return $this->hasMany(
            Payment::class,
            'recorded_by'
        );
    }

    public function paymentAllocations(): HasMany
    {
        return $this->hasMany(
            PaymentAllocation::class,
            'user_id'
        );
    }

    public function tutorPaymentAllocations(): HasMany
    {
        return $this->hasMany(
            PaymentAllocation::class,
            'tutor_id'
        );
    }
}