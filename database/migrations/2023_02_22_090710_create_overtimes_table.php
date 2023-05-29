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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('emp_id')->nullable();
            $table->string('overtime_category')->nullable();
            $table->integer('duration')->nullable();
            $table->date('overtime_date')->nullable();
            $table->date('time_in')->nullable();
            $table->date('time_out')->nullable();
            // $table->string('overtime_amount')->nullable();
            // $table->string('accumulated_amount')->nullable();

            //$table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');

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
        // Schema::table('overtimes', function (Blueprint $table) {
        //     $table->dropForeign(['emp_id']);
        //    });
   

        Schema::dropIfExists('overtimes');
    }
};
