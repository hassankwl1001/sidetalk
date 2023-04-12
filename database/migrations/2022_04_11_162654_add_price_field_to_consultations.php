<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceFieldToConsultations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->float('session_price', 8,2)->after('is_approved')->default(0);
            $table->float('skilled_talk_percentage', 8,2)->after('session_price')->default(0);
            $table->float('actual_payment_earned', 8,2)->after('skilled_talk_percentage')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('session_price');
            $table->dropColumn('skilled_talk_percentage');
            $table->dropColumn('actual_payment_earned');
        });
    }
}
