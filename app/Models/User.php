<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'condo_id',
        'user_type',
        'userable_id',
        'userable_type',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Polymorphic relationship to get the specific user type (Resident or Staff)
     */
    public function userable()
    {
        return $this->morphTo();
    }

    /**
     * Helper method to check if user is a resident
     */
    public function isResident(): bool
    {
        return $this->user_type === 'resident' || 
               $this->userable_type === 'App\\Models\\Resident';
    }

    /**
     * Helper method to check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->user_type === 'staff' || 
               $this->userable_type === 'App\\Models\\Staff';
    }

    /**
     * Helper method to check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin' || 
               $this->userable_type === 'App\\Models\\Admin';
    }

    /**
     * Helper method to check if user has any role
     */
    public function hasRole(): bool
    {
        return !is_null($this->user_type);
    }

    /**
     * Helper method to check if registration is complete
     */
    public function hasCompletedRegistration(): bool
    {
        return !is_null($this->condo_id) && !is_null($this->user_type);
    }

    /**
     * Get the condominium this user belongs to
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class, 'condo_id');
    }

    /**
     * Check if user needs to complete resident registration
     */
    public function needsRegistration(): bool
    {
        return is_null($this->condo_id) || is_null($this->user_type);
    }

    /**
     * Get display role name
     */
    public function getRoleName(): string
    {
        if ($this->isAdmin()) {
            return 'Administrator';
        } elseif ($this->isStaff()) {
            return 'Staff';
        } elseif ($this->isResident()) {
            return 'Resident';
        }
        return 'Guest';
    }
}