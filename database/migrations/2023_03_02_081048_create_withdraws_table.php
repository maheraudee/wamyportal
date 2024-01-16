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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empno');
            $table->unsignedBigInteger('witype'); /* نوع السحب */
            $table->decimal('amnt')->nullable(); /* المبلغ */
            $table->decimal('hr')->nullable();   /* إستقطاعات شؤون الموظفين */
            $table->decimal('box')->nullable();      /* إستقطاعات الصندوق */
            $table->decimal('endService');   /* نهاية الخدمة */
            $table->decimal('debtFurniture');    /*  مديونية أجهزة واثاث  */
            $table->decimal('debtCar');      /*  مديونية سيارات  */
            $table->decimal('anothSponosr');     /*  مبلغ كفالة موظف آخر  */
            $table->decimal('comitbankamt')->nullable();     /* إلتزام بنك */
            $table->decimal('comitanthoramt')->nullable();   /* إلتزام آخر */
            $table->boolean('agree')->default(true);     /* إقرار */
            $table->boolean('status')->default(true);    /* حالة الطلب */
            $table->bigInteger('userEntry')->unsigned();     /* مدخل الطلب */
            $table->string('acctext')->nullable();   /* تقرير المحاسب */

            $table->unsignedBigInteger('aprovalacct')->nullable(); /* موافقة المحاسب */
            $table->date('aprovalaccdate')->nullable(); /* تاريخ الموافقة */
            $table->unsignedBigInteger('empacc')->nullable(); /* المحاسب */

            $table->unsignedBigInteger('aprovalmgr')->nullable(); /* موافقة المدير */
            $table->date('aprovalmgrdate')->nullable(); /* تاريخ الموافقة */
            $table->unsignedBigInteger('empmgr')->nullable(); /* المدير */

            $table->softDeletes();
            $table->timestamps();


            $table->foreign('witype')->references('id')->on('Withdrawtypes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empno')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empacc')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empmgr')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aprovalacct')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aprovalmgr')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('withdraws');
    }
};
