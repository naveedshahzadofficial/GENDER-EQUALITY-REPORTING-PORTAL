<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliceDepartmentViolence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'department_id', 'district_id', 'month_id', 'year', 'child_abuse', 'child_abuse_murder',
        'child_labour', 'child_marriage', 'women_murder',
        'women_domestic_violence', 'women_rape', 'women_gang_rape',
        'women_kidnapping', 'women_burning', 'women_honour_killing',
        'women_vani', 'women_forced_bonded_labour', 'women_other', 'total', 'status',
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
