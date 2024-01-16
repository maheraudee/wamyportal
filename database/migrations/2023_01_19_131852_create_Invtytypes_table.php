<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvtytypesTable extends Migration {

	public function up()
	{
		Schema::create('Invtytypes', function(Blueprint $table) {
			$table->unsignedBigInteger('TypeId')->primary();
			$table->string('TypeNameAr');
			$table->string('TypeNameEn')->nullable();
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
		Schema::drop('Invtytypes');
	}
}
