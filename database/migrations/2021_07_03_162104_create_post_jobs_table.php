<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('post_id');
            $table->string('job_title');
            $table->string('job_poster');
            $table->string('company');
            $table->string('location');
            $table->string('skills');
            $table->string('qualification');
            $table->integer('exp_from');
            $table->integer('exp_to');
            $table->integer('employee_type_id');
            $table->string('salary_from');
            $table->string('salary_to');
            $table->string('description', 10000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_jobs');
    }
}
