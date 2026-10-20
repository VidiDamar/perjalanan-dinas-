<?php

namespace App\Models;

use Database\Factories\TravelRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TravelRequest extends Model
{
    /** @use HasFactory<TravelRequestFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'approval_date' => 'datetime',
            'cash_advance_disbursed_at' => 'datetime',
            'checkin_at' => 'datetime',
            'checked_in' => 'boolean',
            'estimated_transport' => 'decimal:2',
            'estimated_hotel' => 'decimal:2',
            'estimated_per_diem' => 'decimal:2',
            'estimated_other' => 'decimal:2',
            'total_estimated_budget' => 'decimal:2',
            'cash_advance_requested' => 'decimal:2',
            'actual_ticket_cost' => 'decimal:2',
            'actual_hotel_cost' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function settlement(): HasOne
    {
        return $this->hasOne(Settlement::class);
    }

    /**
     * Human readable status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draf Pengajuan',
            'pending_approval' => 'Menunggu Review Atasan',
            'approved' => 'Disetujui',
            'revision_required' => 'Perlu Revisi',
            'rejected' => 'Ditolak',
            'ticket_issued' => 'Tiket & Voucher Terbit',
            'completed' => 'Selesai',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    /**
     * Status badge styling classes
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'bg-slate-100 text-slate-700 border-slate-200',
            'pending_approval' => 'bg-amber-50 text-amber-700 border-amber-200',
            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'revision_required' => 'bg-sky-50 text-sky-700 border-sky-200',
            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            'ticket_issued' => 'bg-teal-50 text-teal-800 border-teal-200',
            'completed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}
