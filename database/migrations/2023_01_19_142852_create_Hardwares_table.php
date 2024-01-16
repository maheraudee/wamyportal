<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHardwaresTable extends Migration {

	public function up()
	{
		Schema::create('Hardwares', function(Blueprint $table) {
			$table->id();
			$table->string('HdwBarcode')->unique();
			$table->bigInteger('TphdwId')->unsigned();
			$table->bigInteger('ManfId')->unsigned();
			$table->string('OSystems')->nullable();
			$table->string('HdwModel')->nullable();
			$table->string('img')->nullable();
			$table->boolean('status')->default(true);
			$table->bigInteger('userEntry')->unsigned();
			$table->softDeletes();
			$table->timestamps();


            $table->foreign('TphdwId')->references('id')->on('Typhardwares')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ManfId')->references('id')->on('Manufacturers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('Hardwares');
	}
}
