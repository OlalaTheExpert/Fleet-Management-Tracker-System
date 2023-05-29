<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('station_name')->default('Not set');
            $table->string('phone_number')->default('Set-up phone number');
            $table->string('gender')->default('Edit your gender');
            $table->string('reports_to')->default('Not Assigned');
            $table->string('account_stat')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('station_name');
            $table->dropColumn('gender');
            $table->dropColumn('phone_number');
            $table->dropColumn('reports_to');
            $table->dropColumn('account_stat');
        });
    }
};
