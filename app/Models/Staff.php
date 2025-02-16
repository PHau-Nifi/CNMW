<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable 
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'birth',
        'gender',
        'code',
        'role_id',
        'theater_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasRole($roleName)
    {
        return $this->role()->where('name', $roleName)->exists();
    }

    public function hasPermission($permissionName)
    {
        return $this->role()->whereHas('permissions', function($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->exists();
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }
}
