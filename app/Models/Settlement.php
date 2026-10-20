<?php

namespace App\Models;

use Database\Factories\SettlementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Settlement extends Model
{
    /** @use HasFactory<SettlementFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'cash_advance_amount' => 'decimal:2',
            'total_actual_expense' => 'decimal:2',
            'difference_amount' => 'decimal:2',
            'verified_at' => 'datetime',
        ];
    }

    public function travelRequest(): BelongsTo
    {
        return $this->belongsTo(TravelRequest::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function expenseItems(): HasMany
    {
        return $this->hasMany(SettlementExpenseItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draf Laporan',
            'submitted' => 'Menunggu Audit Keuangan',
            'verified' => 'Terverifikasi',
            'paid' => 'Selesai & Dicairkan',
            'rejected' => 'Ditolak / Perlu Perbaikan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'bg-amber-50 text-amber-800 border-amber-200',
            'submitted' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'verified' => 'bg-sky-50 text-sky-700 border-sky-200',
            'paid' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}
