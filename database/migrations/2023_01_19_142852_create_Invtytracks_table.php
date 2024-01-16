<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvtytracksTable extends Migration {

	public function up()
	{
		Schema::create('Invtytracks', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('HdwId')->unsigned();
			$table->string('HdwBarcode');
			$table->bigInteger('InvTypeId')->unsigned();
			$table->bigInteger('StockIN')->unsigned();
			$table->bigInteger('StockOUT')->unsigned();
			$table->string('Note')->nullable();
			$table->boolean('status')->default(true);
			$table->bigInteger('userEntry')->unsigned();
			$table->softDeletes();
			$table->timestamps();

            $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('HdwId')->references('id')->on('Hardwares')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('InvTypeId')->references('TypeId')->on('Invtytypes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('StockIN')->references('StockId')->on('Stores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('StockOUT')->references('StockId')->on('Stores')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('Invtytracks');
	}
}
