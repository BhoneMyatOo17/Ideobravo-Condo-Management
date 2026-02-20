<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condominium_id',
        'unit_number',
        'floor',
        'move_in_date',
        'move_out_date',
        'residency_status',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'number_of_occupants',
        'is_active',
    ];

    protected $casts = [
        'move_in_date' => 'date',
        'move_out_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns this resident profile (polymorphic)
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     * Get the condominium this resident belongs to
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }
}