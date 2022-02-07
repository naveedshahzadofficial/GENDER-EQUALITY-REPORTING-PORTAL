<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualDevelopmentProject extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'department_id', 'project_id', 'project_type_id',
        'project_document_file', 'total_approved_budget', 'project_start_date',
        'project_end_date', 'total_expenditure', 'beneficiary_male',
        'beneficiary_female', 'beneficiary_trans_gender', 'beneficiary_total',
        'minority', 'disability', 'status',
    ];

    protected $casts = [
        'project_start_date' => 'date:d-m-Y',
        'project_end_date' => 'date:d-m-Y',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function projectBudgets(): HasMany
    {
        return $this->hasMany(ProjectBudget::class);
    }

    public function projectProgressReport(): HasMany
    {
        return $this->hasMany(ProjectProgressReport::class);
    }

    public function getProjectStartDateAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function getProjectEndDateAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setAttribute($key, $value)
    {
        switch ($key){
            case 'project_start_date':
            case 'project_end_date':
                $this->attributes[$key] = Carbon::parse($value)->format('Y-m-d');
                    break;
            case 'total_approved_budget':
            case 'total_expenditure':
            case 'beneficiary_male':
            case 'beneficiary_female':
            case 'beneficiary_trans_gender':
            case 'beneficiary_total':
            case 'minority':
            case 'disability':
                $this->attributes[$key] = !empty($value)?str_replace(',','', $value):null;
                    break;
            default:
                $this->attributes[$key] = !empty($value)?$value:null;
                break;
        }
    }


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }

}
