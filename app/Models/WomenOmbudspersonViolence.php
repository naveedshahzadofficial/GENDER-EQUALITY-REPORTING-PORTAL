<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WomenOmbudspersonViolence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'department_id', 'district_id', 'month_id', 'year', 'complaints_proceeding_initiated',
        'complaints_disposed_without_proceeding_initiated', 'total_cases_completed', 'total_cases_in_progress', 'status'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function month(): BelongsTo
    {
        return $this->belongsTo(Month::class);
    }

    public function setAttribute($key, $value)
    {
        if($key != 'status')
            $this->attributes[$key] = !empty($value) || $value == '0' ?str_replace(',','', $value):null;
        else
            $this->attributes[$key] = $value;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }
}
