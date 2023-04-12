<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('experience', 3, 1)->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('banner')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->string('headline')->nullable();
            $table->string('current_position')->nullable();
            $table->string('education')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('work_location')->nullable();
            $table->string('industry')->nullable();
            $table->string('sub_industry')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('employee_type_id')->nullable();
            $table->string('recent_company')->nullable();
            $table->integer('otp')->nullable();
            $table->boolean('is_student')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
