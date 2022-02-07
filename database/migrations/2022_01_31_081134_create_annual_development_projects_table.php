<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualDevelopmentProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_development_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('project_type_id')->nullable()->constrained();
            $table->string('project_document_file')->nullable();
            $table->decimal('total_approved_budget', 11, 2)->nullable();
            $table->date('project_start_date')->nullable();
            $table->date('project_end_date')->nullable();
            $table->decimal('total_expenditure',11, 2)->nullable();
            $table->unsignedInteger('beneficiary_male')->nullable();
            $table->unsignedInteger('beneficiary_female')->nullable();
            $table->unsignedInteger('beneficiary_trans_gender')->nullable();
            $table->unsignedInteger('beneficiary_total')->nullable();
            $table->unsignedInteger('minority')->nullable();
            $table->unsignedInteger('disability')->nullable();
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
        Schema::dropIfExists('annual_development_projects');
    }
}
