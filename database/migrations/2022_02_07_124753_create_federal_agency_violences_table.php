<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalAgencyViolencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_agency_violences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('month_id')->nullable()->constrained();
            $table->unsignedBigInteger('year')->nullable();
            $table->unsignedBigInteger('total_complaints')->nullable();
            $table->unsignedBigInteger('complaints_converted_to_fir')->nullable();
            $table->unsignedBigInteger('complaints_disposed_without_fir')->nullable();
            $table->unsignedBigInteger('complaints_in_process')->nullable();
            $table->unsignedBigInteger('case_completed')->nullable();
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
        Schema::dropIfExists('federal_agency_violences');
    }
}
