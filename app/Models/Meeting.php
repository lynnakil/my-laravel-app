<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'mom_id',
        'title',
        'agenda',
        'date',
        'startTime',
        'endTime',
    ];

    protected $casts = [
        'date'      => 'date:Y-m-d',     
        'startTime' => 'datetime:H:i',   
        'endTime'   => 'datetime:H:i',  
        'created_at' => 'datetime:Y-m-d H:i', 
        'updated_at' => 'datetime:Y-m-d H:i', 
    ];

  public function room(){ 
    return $this->belongsTo(\App\Models\Room::class); 
}
  public function mom(){ 
    return $this->belongsTo(\App\Models\Mom::class); 
}
}
