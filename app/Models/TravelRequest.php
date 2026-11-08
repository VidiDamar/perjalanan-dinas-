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

    public function getDestinationAttribute(): string
    {
        return $this->attributes['destination'] ?? $this->attributes['destination_city'] ?? 'Surabaya';
    }

    public function getOriginAttribute(): string
    {
        return $this->attributes['origin'] ?? $this->attributes['departure_city'] ?? 'Jakarta';
    }

    public function getTicketCostAttribute(): float
    {
        return (float) ($this->attributes['actual_ticket_cost'] ?? $this->attributes['estimated_transport'] ?? 0);
    }

    public function getHotelCostAttribute(): float
    {
        return (float) ($this->attributes['actual_hotel_cost'] ?? $this->attributes['estimated_hotel'] ?? 0);
    }

    public function getAllowanceCostAttribute(): float
    {
        return (float) ($this->attributes['estimated_per_diem'] ?? 0);
    }

    public function getOtherCostAttribute(): float
    {
        return (float) ($this->attributes['estimated_other'] ?? 0);
    }

    public function getTotalBudgetAttribute(): float
    {
        return (float) ($this->attributes['total_estimated_budget'] ?? 0);
    }

    public function getCashAdvanceAmountAttribute(): float
    {
        return (float) ($this->attributes['cash_advance_requested'] ?? 0);
    }

    public function getNeedCashAdvanceAttribute(): bool
    {
        return ((float) ($this->attributes['cash_advance_requested'] ?? 0)) > 0;
    }

    public function getCheckedInAtAttribute()
    {
        return $this->checkin_at;
    }

    public function getCashAdvancePaidAtAttribute()
    {
        return $this->cash_advance_disbursed_at;
    }

    public function getIsBookedAttribute(): bool
    {
        return ! empty($this->attributes['pnr_code']);
    }

    public function getDepartureAirlineAttribute(): ?string
    {
        return $this->attributes['operator_name'] ?? null;
    }

    public function getDeparturePnrAttribute(): ?string
    {
        return $this->attributes['pnr_code'] ?? null;
    }

    public function getDepartureFlightCodeAttribute(): ?string
    {
        return $this->attributes['flight_departure_info'] ?? null;
    }

    public function getReturnFlightCodeAttribute(): ?string
    {
        return $this->attributes['flight_return_info'] ?? null;
    }

    public function getReturnPnrAttribute(): ?string
    {
        return $this->attributes['pnr_code'] ?? null;
    }

    public function getHotelBookingCodeAttribute(): ?string
    {
        return $this->attributes['hotel_confirmation_code'] ?? null;
    }

    public function getSupportingDocumentAttribute(): ?string
    {
        return $this->attributes['invitation_file_path'] ?? null;
    }

    public function getSupportingDocumentNameAttribute(): string
    {
        return ! empty($this->attributes['invitation_file_path'])
            ? basename($this->attributes['invitation_file_path'])
            : 'Surat_Tugas_Dinas.pdf';
    }

    public function getApprovalLevelAttribute(): int
    {
        return (int) ($this->attributes['current_approval_level'] ?? 1);
    }

    public function getCurrentApproverIdAttribute(): ?int
    {
        return isset($this->attributes['approver_id']) ? (int) $this->attributes['approver_id'] : null;
    }

    public function getRevisionNoteAttribute(): ?string
    {
        return $this->attributes['revision_notes'] ?? null;
    }

    public function getDisbursementRefAttribute(): ?string
    {
        return $this->attributes['cash_advance_ref'] ?? null;
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
