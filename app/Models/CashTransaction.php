<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'payment_category_id',   // ✅ WAJIB
        'amount',
        'date_paid',
        'transaction_note',
        'payment_proof',         // ✅ bukti bayar
        'created_by',
    ];

    /* =========================
     | RELATIONSHIP
     ========================= */

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function paymentCategory(): BelongsTo
    {
        return $this->belongsTo(PaymentCategory::class);
    }

    /* =========================
     | SEARCH SCOPE
     ========================= */

    public function scopeSearch(Builder $query, string $searchQuery): void
    {
        $query
            ->where('amount', 'like', "%{$searchQuery}%")
            ->orWhereHas('student', fn ($q) =>
                $q->where('name', 'like', "%{$searchQuery}%")
            )
            ->orWhereHas('createdBy', fn ($q) =>
                $q->where('name', 'like', "%{$searchQuery}%")
            )
            ->orWhereHas('paymentCategory', fn ($q) =>
                $q->where('name', 'like', "%{$searchQuery}%")
            );
    }
}
