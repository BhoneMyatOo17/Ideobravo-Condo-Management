<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'condominium_id',
        'resident_id',
        'generated_by',
        'unit_number',
        'bill_number',
        'bill_type',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'paid_date',
        'payment_method',
        'payment_reference',
        'payment_proof',
        'payment_notes',
        'payment_submitted_at',
        'notes',
    ];

    protected $casts = [
        'issue_date' => 'datetime',
        'due_date' => 'datetime',
        'paid_date' => 'datetime',
        'payment_submitted_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * Boot method - register model observers
     */
    protected static function booted()
    {
        // Automatically update overdue bills when retrieved
        static::retrieved(function ($bill) {
            $bill->updateOverdueStatus();
        });
    }

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function generatedByStaff()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Update status to overdue if past due date
     */
    public function updateOverdueStatus()
    {
        if ($this->status === 'pending' && $this->due_date < now()) {
            $this->update(['status' => 'overdue']);
        }
    }

    /**
     * Check if bill is overdue (based on status)
     */
    public function isOverdue(): bool
    {
        return $this->status === 'overdue';
    }

   /**
 * Get number of days overdue (only for overdue bills)
 */
    public function getOverdueDaysAttribute(): int
    {
        if ($this->status === 'overdue' && $this->due_date < now()) {
            return now()->startOfDay()->diffInDays($this->due_date->startOfDay());
        }
        return 0;
    }

    public function hasPendingProof()
    {
        return $this->payment_proof && $this->status === 'pending' && $this->payment_submitted_at;
    }

    /**
     * Mark bill as paid
     */
    public function markAsPaid(string $paymentMethod, ?string $paymentReference = null)
    {
        $this->update([
            'status' => 'paid',
            'paid_date' => now(),
            'payment_method' => $paymentMethod,
            'payment_reference' => $paymentReference,
        ]);
    }

    /**
     * Generate unique bill number
     */
    public static function generateBillNumber(): string
    {
        $year = now()->year;
        $month = now()->format('m');
        $count = self::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
        
        return sprintf('BILL-%d-%s-%04d', $year, $month, $count);
    }

    /**
     * Get formatted amount with currency
     */
    public function getFormattedAmountAttribute(): string
    {
        return '฿' . number_format($this->amount, 2);
    }

    /**
     * Get bill type label
     */
    public function getBillTypeLabel(): string
    {
        return match($this->bill_type) {
            'common_area' => 'Common Area Fee',
            'water' => 'Water Bill',
            'electricity' => 'Electricity Bill',
            'insurance' => 'Insurance',
            'parking' => 'Parking Fee',
            'other' => 'Other',
            default => ucfirst($this->bill_type),
        };
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            'overdue' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            'cancelled' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
        };
    }
}