<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'content', 
        'creationDate',
        'meeting_id'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
