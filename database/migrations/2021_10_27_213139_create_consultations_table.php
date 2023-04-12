<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->uuid('consult_from');
            $table->uuid('consult_with');
            $table->string('consult_type');
            $table->string('desc');
            $table->string('attachment')->nullable();
            $table->string('date');
            $table->string('time');
            $table->boolean('is_accepted')->default(0);
            $table->string('meeting_id');
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
        Schema::dropIfExists('consultations');
    }
}
