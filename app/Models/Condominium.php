<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condominium extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'condominiums';

    protected $fillable = [
        'name',
        'code',
        'address',
        'phone_number',
        'email',
        'line_id',
        'total_floors',
        'total_units',
        'built_year',
    ];

    /**
     * Get all residents in this condominium
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    /**
     * Get all staff in this condominium
     */
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}