<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliceDepartmentViolencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_department_violences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('month_id')->nullable()->constrained();
            $table->unsignedBigInteger('year')->nullable();
            $table->unsignedBigInteger('child_abuse')->nullable();
            $table->unsignedBigInteger('child_abuse_murder')->nullable();
            $table->unsignedBigInteger('child_labour')->nullable();
            $table->unsignedBigInteger('child_marriage')->nullable();
            $table->unsignedBigInteger('women_murder')->nullable();
            $table->unsignedBigInteger('women_domestic_violence')->nullable();
            $table->unsignedBigInteger('women_rape')->nullable();
            $table->unsignedBigInteger('women_gang_rape')->nullable();
            $table->unsignedBigInteger('women_kidnapping')->nullable();
            $table->unsignedBigInteger('women_burning')->nullable();
            $table->unsignedBigInteger('women_honour_killing')->nullable();
            $table->unsignedBigInteger('women_vani')->nullable();
            $table->unsignedBigInteger('women_forced_bonded_labour')->nullable();
            $table->unsignedBigInteger('women_other')->nullable();
            $table->unsignedBigInteger('total')->nullable();
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
        Schema::dropIfExists('police_department_violences');
    }
}
