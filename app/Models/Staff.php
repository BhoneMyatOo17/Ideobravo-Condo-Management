<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condominium_id',
        'position',
        'department',
        'employee_id',
        'hire_date',
        'employment_type',
        'work_phone',
        'work_email',
        'is_active',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns this staff profile (polymorphic)
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     * Get the condominium this staff member works at
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }
}