<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('Stores', function(Blueprint $table) {
			$table->unsignedBigInteger('StockId')->primary();
			$table->string('StockNameAr');
			$table->string('StockNameEn')->nullable();
			$table->string('StockTyp');
			$table->boolean('status')->default(true);
			$table->bigInteger('userEntry')->unsigned();
			$table->softDeletes();
			$table->timestamps();

            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('Stores');
	}
}
