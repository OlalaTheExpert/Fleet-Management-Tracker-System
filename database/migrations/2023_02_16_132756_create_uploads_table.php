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
        Schema::create('uploads', function (Blueprint $table) {
            $table->Increments('id')->from(111)->unsigned();
            $table->string('uploaded_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('file_name')->nullable();
            $table->string('station_id')->nullable();
            $table->string('Comment')->nullable();
            $table->string('status')->nullable();            
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
        Schema::dropIfExists('uploads');
    }
};
