<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWomenOmbudspersonViolencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('women_ombudsperson_violences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('month_id')->nullable()->constrained();
            $table->unsignedBigInteger('year')->nullable();
            $table->unsignedBigInteger('complaints_proceeding_initiated')->nullable();
            $table->unsignedBigInteger('complaints_disposed_without_proceeding_initiated')->nullable();
            $table->unsignedBigInteger('total_cases_completed')->nullable();
            $table->unsignedBigInteger('total_cases_in_progress')->nullable();
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
        Schema::dropIfExists('women_ombudsperson_violences');
    }
}
