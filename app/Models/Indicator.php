<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicator extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['target_id', 'indicator_title', 'status'];

    public function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }
}
