<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentDeletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resident_id',
        'deleted_by',
        'condominium_id',
        'resident_name',
        'resident_email',
        'unit_number',
        'floor',
        'deletion_reason',
        'email_sent',
        'email_sent_at',
    ];

    protected $casts = [
        'email_sent' => 'boolean',
        'email_sent_at' => 'datetime',
    ];

    /**
     * Get the user account (still exists)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin/staff who deleted this resident
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Get the condominium
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }
}