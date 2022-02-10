<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PunjabActionPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'department_id', 'target_id',
        'indicator_id', 'indicator_framework_file',
        'baseline', 'reporting_agency', 'implementation_responsibility',
        'year', 'status',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }

    function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }

    function targetReforms(): HasMany
    {
        return $this->hasMany(TargetReform::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }
}
