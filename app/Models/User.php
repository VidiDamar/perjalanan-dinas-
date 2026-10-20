<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_checkin_at' => 'datetime',
        ];
    }

    /**
     * Relationships
     */
    public function travelRequests(): HasMany
    {
        return $this->hasMany(TravelRequest::class);
    }

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(self::class, 'manager_id');
    }

    /**
     * Role checking helper methods
     */
    public function isApprover(): bool
    {
        return in_array($this->role, ['atasan', 'approver', 'admin'], true);
    }

    public function isTravelAdmin(): bool
    {
        return in_array($this->role, ['travel_admin', 'admin'], true);
    }

    public function isFinance(): bool
    {
        return in_array($this->role, ['finance', 'admin'], true);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get human-readable role label
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'atasan', 'approver' => 'Atasan / Approver',
            'travel_admin' => 'Admin Travel Desk',
            'finance' => 'Tim Keuangan',
            'admin' => 'Super Administrator',
            default => 'Karyawan / Traveler',
        };
    }

    /**
     * Get role badge styling classes
     */
    public function getRoleBadgeClassAttribute(): string
    {
        return match ($this->role) {
            'atasan', 'approver' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'travel_admin' => 'bg-sky-50 text-sky-700 border-sky-200',
            'finance' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'admin' => 'bg-purple-50 text-purple-700 border-purple-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }

    /**
     * Get daily per diem policy limit based on job level
     */
    public function getDailyPerDiemLimit(): float
    {
        return match ($this->job_level) {
            'Staff', 'Junior' => 250000,
            'Senior Specialist', 'Senior' => 300000,
            'Supervisor', 'Lead' => 350000,
            'Manager', 'Head' => 450000,
            'Direktur', 'C-Level' => 800000,
            default => 300000,
        };
    }

    /**
     * Get daily hotel cost ceiling based on job level
     */
    public function getHotelLimit(): float
    {
        return match ($this->job_level) {
            'Staff', 'Junior' => 500000,
            'Senior Specialist', 'Senior' => 750000,
            'Supervisor', 'Lead' => 900000,
            'Manager', 'Head' => 1200000,
            'Direktur', 'C-Level' => 2500000,
            default => 750000,
        };
    }
}
