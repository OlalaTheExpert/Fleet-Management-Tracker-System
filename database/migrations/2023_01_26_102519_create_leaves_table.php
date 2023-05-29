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
        Schema::create('leaves', function (Blueprint $table) {
            $table->Increments('id');            
            $table->integer('employee_id')->unsigned();
            $table->integer('days')->default(0);
            $table->date('leave_date')->default(date("Y-m-d"));
            $table->date('return_date')->default(date("Y-m-d"));
            $table->integer('status')->default(1);
            $table->string('type');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
           });
   
           Schema::dropIfExists('leaves');
    }
};
