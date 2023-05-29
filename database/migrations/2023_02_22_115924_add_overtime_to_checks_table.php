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
        Schema::table('checks', function (Blueprint $table) {
            $table->string('overtime15')->default(0);
            $table->string('overtime75')->default(0);
            $table->string('overtime2')->default(0);
            $table->string('overtime25')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checks', function (Blueprint $table) {
            $table->dropColumn('overtime15');
            $table->dropColumn('overtime75');
            $table->dropColumn('overtime2');
            $table->dropColumn('overtime25');
        });
    }
};
