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
        Schema::create('savingstrans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('savingid');
            $table->unsignedBigInteger('empno');
            $table->decimal('premium')->nullable();
			$table->decimal('contribute')->nullable();
            $table->string('typetran');
            $table->bigInteger('userEntry')->unsigned();
            $table->timestamps();


            $table->foreign('empno')->references('empno')->on('Savings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('savingid')->references('id')->on('Savings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('savingstrans');
    }
};
