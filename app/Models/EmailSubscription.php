<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSubscription extends Model
{
    protected $table = 'newsletter';
    protected $fillable = ['name', 'email'];
}