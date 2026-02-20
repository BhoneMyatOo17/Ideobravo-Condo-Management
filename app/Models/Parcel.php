<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'condominium_id',
        'resident_id',
        'received_by',
        'picked_up_by',
        'tracking_number',
        'recipient_name',
        'unit_number',
        'courier_service',
        'parcel_size',
        'status',
        'received_date',
        'picked_up_date',
        'notes',
        'image',
    ];

    protected $casts = [
        'received_date' => 'datetime',
        'picked_up_date' => 'datetime',
    ];

    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function receivedByStaff()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function pickedUpByResident()
    {
        return $this->belongsTo(Resident::class, 'picked_up_by');
    }

    /**
     * Check if parcel is ready for pickup
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Mark parcel as picked up
     */
    public function markAsPickedUp(int $residentId)
    {
        $this->update([
            'status' => 'picked_up',
            'picked_up_by' => $residentId,
            'picked_up_date' => now(),
        ]);
    }
    public function getStatusBadgeColor()
{
    return match($this->status) {
        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
        'notified' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400',
        'picked_up' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400',
    };
}

public function getStatusLabel()
{
    return match($this->status) {
        'pending' => 'Pending',
        'notified' => 'Notified',
        'picked_up' => 'Picked Up',
        default => ucfirst($this->status),
    };
}
}