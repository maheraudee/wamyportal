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
        Schema::create('boxbalances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empno');
            $table->date('datePremium');
			$table->decimal('premium');
			$table->decimal('balance');
            $table->bigInteger('userEntry')->unsigned();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('boxbalances');
    }
};
