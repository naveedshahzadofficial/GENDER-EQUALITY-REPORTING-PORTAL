<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'department_id',
        'mobile_no',
        'cnic_no',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->role_id == 1) {
            return true;
        }
        return false;
    }

    public function isDepartment()
    {
        if ($this->role_id == 2) {
            return true;
        }
        return false;
    }

    function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    function isTable1(): bool
    {
        return in_array($this->department_id, [34,6,16]);
    }
    function isTable2(): bool
    {
        return in_array($this->department_id, [40]);
    }
    function isTable3(): bool
    {
        return ! in_array($this->department_id, [34]);
    }
    function isTable4(): bool
    {
        return ! in_array($this->department_id, [34]);
    }

    function isPoliceDepartment(): bool
    {
        return $this->department_id == 16;
    }

    function isFiaDepartment(): bool
    {
        return $this->department_id == 34;
    }

    function isOmbudspersonDepartment(): bool
    {
        return $this->department_id == 6;
    }

    function isPAPDepartment(): bool
    {
        return $this->department_id == 40;
    }

}
