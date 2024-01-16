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
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('empno')->primary();
            $table->string('name');
			$table->string('email')->nullable();
			$table->decimal('salary');
			$table->string('department')->nullable();
			$table->string('section')->nullable();
			$table->date('startdate')->nullable();
			$table->string('qualification')->nullable();
			$table->string('job')->nullable();
			$table->string('mobile')->nullable();
			$table->string('cardid')->nullable();
			$table->string('nationality')->nullable();
			$table->boolean('status')->default(true);
			$table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
};
