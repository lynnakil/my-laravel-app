<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 
        'capacity', 
        'location', 
        'status'
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_room');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function userAttendees()
    {
        return $this->hasMany(UserAttendee::class);
    }
}
