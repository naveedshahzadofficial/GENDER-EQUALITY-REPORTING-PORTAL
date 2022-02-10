<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTargetIdToAnnualDevelopmentProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_development_projects', function (Blueprint $table) {
            $table->foreignId('target_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('annual_development_projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('target_id');
        });
    }
}
