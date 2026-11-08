<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPolicy extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'hotel_limit' => 'decimal:2',
            'per_diem_limit' => 'decimal:2',
            'director_threshold' => 'decimal:2',
            'sla_hours' => 'integer',
        ];
    }

    public static function forJobLevel(?string $jobLevel): ?self
    {
        if (! $jobLevel) {
            return null;
        }

        $normalized = match ($jobLevel) {
            'Junior', 'Staff / Junior', 'Staff / Junior Specialist' => 'Staff',
            'Senior', 'Senior Specialist / Officer' => 'Senior Specialist',
            'Lead', 'Supervisor / Lead' => 'Supervisor',
            'Head', 'Division Head', 'Manager / Head', 'Manager / Head of Division' => 'Manager',
            'C-Level', 'Direksi', 'Direksi / C-Level Executives' => 'Direktur',
            default => $jobLevel,
        };

        return self::where('job_level', $normalized)
            ->orWhere('job_level', $jobLevel)
            ->first();
    }
}
