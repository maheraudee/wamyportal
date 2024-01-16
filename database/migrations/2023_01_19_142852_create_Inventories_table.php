<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration {

	public function up()
	{
		Schema::create('Inventories', function(Blueprint $table) {
			$table->id();
			$table->integer('InvId');
			$table->bigInteger('HdwId')->unsigned()->unique();
			$table->string('HdwBarcode')->unique();
			$table->bigInteger('InvTypeId')->unsigned();
			$table->bigInteger('StockIN')->unsigned();
			$table->string('Note')->nullable();
			$table->boolean('status')->default(true);
			$table->bigInteger('userEntry')->unsigned();
			$table->softDeletes();
			$table->timestamps();


            $table->foreign('HdwId')->references('id')->on('Hardwares')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('StockIN')->references('StockId')->on('Stores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('InvTypeId')->references('TypeId')->on('Invtytypes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('Inventories');
	}
}
