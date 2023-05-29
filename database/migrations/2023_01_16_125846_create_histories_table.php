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
        Schema::create('histories', function (Blueprint $table) {
            $table->Increments('id')->from(111)->unsigned();
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->string('ctgnumber');
            $table->decimal('bsalary', 5,2)->default(0);
            $table->integer('daysworked')->default(0);
            $table->integer('inland')->default(0);
            $table->integer('overland')->default(0);
            $table->integer('sickleave')->default(0);
            $table->integer('annualleave')->default(0);
            $table->integer('ot15')->default(0);
            $table->integer('ot175')->default(0);
            $table->integer('ot2')->default(0);
            $table->integer('ot25')->default(0);
            $table->integer('dsainland')->default(0);
            $table->integer('dsaoverland')->default(0);
            $table->decimal('dsaamount', 8,2)->default(0);
            $table->decimal('ttsalary', 8,2)->default(0);

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
        Schema::dropIfExists('histories');
    }
};
