<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getAttitudeLevelAttribute()
    // {
    //     $levels = ['Very Low', 'Low', 'Medium', 'High', 'Very High'];
    //     return $levels[$this->attributes['attitude'] - 1] ?? null;
    // }
}
