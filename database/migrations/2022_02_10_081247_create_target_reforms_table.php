<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetReformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_reforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('punjab_action_plan_id')->nullable()->constrained();
            $table->string('defining_action')->nullable();
            $table->string('defining_date')->nullable();
            $table->string('progress_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_reforms');
    }
}
