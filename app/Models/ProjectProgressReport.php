<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProgressReport extends Model
{
    use HasFactory;
    protected $fillable = ['annual_development_project_id', 'progress_report_file'];
}
