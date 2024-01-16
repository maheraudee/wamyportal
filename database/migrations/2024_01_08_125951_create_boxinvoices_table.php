<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boxinvoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boxorders_id');
            $table->string('invoice');
            $table->bigInteger('userEntry')->unsigned();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('boxorders_id')->references('id')->on('Boxorders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxinvoices');
    }
};
