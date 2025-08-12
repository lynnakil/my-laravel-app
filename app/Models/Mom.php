<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mom extends Model
{
    protected $fillable = [
        'attachment', 
        'expectations',
        'discussions', 
        'actionItems'
    ];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
