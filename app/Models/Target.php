<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Target extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'icon_name',
        'target_value',
        'target_indicator',
        'target_factor',
        'status'
    ];

    public function indicators(): HasMany
    {
        return $this->hasMany(Indicator::class);
    }
}
