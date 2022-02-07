<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBudget extends Model
{
    use HasFactory;
    protected $fillable = ['annual_development_project_id', 'fiscal_year', 'budget_allocation', 'budget_utilization'];

    public function setAttribute($key, $value)
    {
        switch ($key){
            case 'budget_allocation':
            case 'budget_utilization':
                $this->attributes[$key] = str_replace(',','', $value);
                break;
            default:
                $this->attributes[$key] = $value;
                break;
        }
    }
}
