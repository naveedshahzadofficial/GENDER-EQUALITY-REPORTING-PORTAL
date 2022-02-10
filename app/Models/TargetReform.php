<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetReform extends Model
{
    use HasFactory;

    protected $fillable = ['punjab_action_plan_id', 'defining_action', 'defining_date', 'progress_status'];
}
