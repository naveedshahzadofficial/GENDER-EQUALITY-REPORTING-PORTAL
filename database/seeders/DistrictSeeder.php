<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        District::truncate();
        DB::statement("SET foreign_key_checks=1");

        $path = base_path("database/data/districts__2021-05-27.sql");
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
