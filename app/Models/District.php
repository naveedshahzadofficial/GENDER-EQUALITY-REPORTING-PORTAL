<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'district_name_e', 'district_name_u', 'district_short_name', 'division_id','province_id','fbr_code_id' ,'district_status','district_remark',];
}
