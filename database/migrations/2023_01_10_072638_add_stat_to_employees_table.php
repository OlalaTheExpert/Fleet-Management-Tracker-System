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
            $table->string('bsalary');
            $table->string('ctgnumber');
            $table->string('unit');
            $table->integer('station_id');
            $table->string('stat');
          
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
            $table->dropColumn('bsalary');
            $table->dropColumn('ctgnumber');
            $table->dropColumn('unit');
            $table->dropColumn('station_id');
            $table->dropColumn('stat');
        });
    }
};
