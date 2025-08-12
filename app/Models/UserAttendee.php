<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttendee extends Model
{
    protected $fillable = [
        'role',
        'user_id', 
        'room_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
