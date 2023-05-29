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
        Schema::create('payments', function (Blueprint $table) {
            $table->Increments('id')->from(111)->unsigned();
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->string('ctgnumber');
            $table->decimal('bsalary', 5,2);
            $table->integer('daysworked');
            $table->integer('inland');
            $table->integer('overland');
            $table->integer('sickleave');
            $table->integer('annualleave');
            $table->integer('ot15');
            $table->integer('ot175');
            $table->integer('ot2');
            $table->integer('ot25');
            $table->integer('dsainland');
            $table->integer('dsaoverland');
            $table->decimal('dsaamount', 8,2);
            $table->decimal('ttsalary', 8,2);

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
        Schema::dropIfExists('payments');
    }
};
