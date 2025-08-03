<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Laravel will default to 'users' table, so this line is optional
    protected $table = 'users';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phoneNb',
        'password',
        'role_ID',
        'notification_ID',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_ID');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'userID');
    }
}
