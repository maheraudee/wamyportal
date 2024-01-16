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
        Schema::create('boanalyse_guarantee_pivots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analyse_id');
            $table->unsignedBigInteger('guarantee_id');
            $table->timestamps();

            $table->foreign('analyse_id')->references('id')->on('Boxordersanalyses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guarantee_id')->references('id')->on('boxorderguarantees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boanalyse_guarantee_pivots');
    }
};
