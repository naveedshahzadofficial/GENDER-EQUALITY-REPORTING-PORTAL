<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Month::create(['month_name'=>'January']);
       Month::create(['month_name'=>'February']);
       Month::create(['month_name'=>'March']);
       Month::create(['month_name'=>'April']);
       Month::create(['month_name'=>'May']);
       Month::create(['month_name'=>'June']);
       Month::create(['month_name'=>'July']);
       Month::create(['month_name'=>'August']);
       Month::create(['month_name'=>'September']);
       Month::create(['month_name'=>'October']);
       Month::create(['month_name'=>'November']);
       Month::create(['month_name'=>'December']);
    }
}
