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
        Schema::create('employeefinancials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empno')->unsigned();
            $table->string('type');
            $table->decimal('amnt');
            $table->boolean('status')->default(true);
            $table->bigInteger('userEntry')->unsigned();
            $table->softDeletes();
            $table->timestamps();



            $table->foreign('empno')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('employeefinancials');
    }
};
