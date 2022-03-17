<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoluntaryNationalReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'target_id',
        'project_id',
        'project_type_id',
        'year_wise_policies_interventions',
        'start_date',
        'achievements',
        'challenges',
        'action_taken',
        'partnership',
        'way_forward',
        'end_date',
        'attachment',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }

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
    function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }
}
