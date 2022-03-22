<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_project', function (Blueprint $table) {
            $table->foreignId('district_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->index()->constrained()->onDelete('cascade');
            $table->primary(['district_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_project');
    }
}
