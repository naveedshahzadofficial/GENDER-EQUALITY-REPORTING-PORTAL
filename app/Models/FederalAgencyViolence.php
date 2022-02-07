<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FederalAgencyViolence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'department_id', 'district_id', 'month_id', 'year', 'total_complaints',
        'complaints_converted_to_fir', 'complaints_disposed_without_fir', 'complaints_in_process', 'case_completed', 'status'
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
        $this->attributes[$key] = !empty($value) || $value=='0'?str_replace(',','', $value):null;
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }
}
