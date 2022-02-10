<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunjabActionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punjab_action_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('target_id')->nullable()->constrained();
            $table->foreignId('indicator_id')->nullable()->constrained();
            $table->string('indicator_framework_file')->nullable();
            $table->string('baseline')->nullable();
            $table->string('reporting_agency')->nullable();
            $table->string('implementation_responsibility')->nullable();
            $table->unsignedBigInteger('year')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('punjab_action_plans');
    }
}
