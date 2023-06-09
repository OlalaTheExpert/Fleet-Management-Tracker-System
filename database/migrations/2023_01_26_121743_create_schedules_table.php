<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->Increments('id')->unsigned();
            $table->string('employee_id');
            $table->time('time_in');
            $table->time('time_out');
            
            $table->integer('nodays')->default(0);

            $table->timestamps();
        });

        Schema::create('schedule_employees', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned();
            $table->integer('schedule_id')->unsigned();         

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('schedule_employees', function (Blueprint $table) {
            
            $table->dropForeign(['schedule_id']);
            $table->dropForeign(['employee_id']);
           });
     
        Schema::dropIfExists('schedule_employees');
        Schema::dropIfExists('schedules');
    }
}
