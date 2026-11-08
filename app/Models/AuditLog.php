<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function record(
        string $action,
        string $description,
        ?string $targetRef = null,
        ?User $actor = null,
        string $status = 'Success'
    ): self {
        $actor = $actor ?? auth()->user();

        return self::create([
            'user_id' => $actor?->id,
            'actor_name' => $actor?->name ?? 'System Automation',
            'actor_role' => $actor?->job_level ?? ($actor?->role_label ?? 'System'),
            'action' => $action,
            'target_ref' => $targetRef,
            'description' => $description,
            'ip_address' => request()?->ip() ?? '127.0.0.1',
            'user_agent' => substr((string) (request()?->userAgent() ?? 'CTMS Web Client'), 0, 120),
            'status' => $status,
        ]);
    }
}
