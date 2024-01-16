<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTable extends Migration {

	public function up()
	{
		Schema::create('Manufacturers', function(Blueprint $table) {
			$table->id();
			$table->string('name');
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
		Schema::drop('Manufacturers');
	}
}
