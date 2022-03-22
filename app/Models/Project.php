<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'project_type_id',
        'project_title',
        'project_start_date',
        'project_end_date',
        'project_description',
        'project_is_all_punjab',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(District::class);
    }

    public function isHasLocation($district_id): bool
    {
        return $this->locations->where('id', $district_id)->count()>0;
    }
}
