<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'condominium_id',
        'created_by',
        'title',
        'description',
        'image',
        'category',
        'priority',
        'start_date',
        'end_date',
        'send_email',
        'send_push',
        'target_audience',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'send_email' => 'boolean',
        'send_push' => 'boolean',
    ];

    /**
     * Get the condominium this announcement belongs to
     */
    public function condominium()
    {
        return $this->belongsTo(Condominium::class);
    }

    /**
     * Get the user (staff/admin) who created this announcement
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if announcement is currently active
     */
    public function isActive(): bool
    {
        $now = now()->toDateString();
        
        if ($this->end_date) {
            return $this->start_date <= $now && $this->end_date >= $now;
        }
        
        return $this->start_date <= $now;
    }

    /**
     * Get priority badge color classes
     */
    public function getPriorityBadgeColor(): string
    {
        return match($this->priority) {
            'urgent' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            'high' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
            'normal' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            'low' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
        };
    }

    /**
     * Get priority label
     */
    public function getPriorityLabel(): string
    {
        return ucfirst($this->priority);
    }

    /**
     * Get category badge color classes
     */
    public function getCategoryBadgeColor(): string
    {
        return match(strtolower($this->category)) {
            'important' => 'bg-red-500 text-white',
            'event' => 'bg-purple-500 text-white',
            'maintenance' => 'bg-orange-500 text-white',
            'update' => 'bg-blue-500 text-white',
            'new' => 'bg-green-500 text-white',
            'eco' => 'bg-teal-500 text-white',
            'security' => 'bg-red-600 text-white',
            'community' => 'bg-indigo-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    /**
     * Get category label
     */
    public function getCategoryLabel(): string
    {
        return ucfirst($this->category);
    }

    /**
     * Get excerpt from description
     */
    public function getExcerptAttribute(): string
    {
        return \Illuminate\Support\Str::limit($this->description, 150);
    }

    /**
     * Check if announcement is expired
     */
    public function isExpired(): bool
    {
        if (!$this->end_date) {
            return false;
        }
        
        return now()->toDateString() > $this->end_date;
    }

    /**
     * Check if announcement is published
     */
    public function isPublished(): bool
    {
        return $this->start_date <= now()->toDateString();
    }
}