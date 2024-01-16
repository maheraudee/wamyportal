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
        Schema::create('boxorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empno');
            $table->unsignedBigInteger('orderTyp'); /* نوع الطلب أجهزة/سيارات  */
            $table->unsignedBigInteger('installmentPeriod'); /*  مدة التقسيط  */
            $table->integer('rate'); /*  مدة التقسيط  */
            $table->decimal('hr'); /*  إستقطاع شؤون الموظفين */
            $table->decimal('box'); /*  إستقطاع صندوق الإدخار */
            $table->decimal('purchasingValue'); /*  القيمة الشرائية */
            $table->string('orderdesc'); /* وصف الاجهزة */
            $table->unsignedBigInteger('sponsor')->nullable();  /* الكافل */
            $table->unsignedBigInteger('aprovalsponsor')->nullable(); /* موافقة الكافل */
            $table->date('aprovalspodate')->nullable(); /* تاريخ الموافقة */
            /* $table->string('signature')->nullable(); */ /* توقيع صاحب الطلب */


            $table->unsignedBigInteger('aprovalacc')->nullable(); /* موافقة المحاسب */
            $table->date('aprovalaccdate')->nullable(); /* تاريخ الموافقة */
            $table->unsignedBigInteger('empacc')->nullable(); /* المحاسب */

            $table->unsignedBigInteger('aprovalmgr')->nullable(); /* موافقة المدير */
            $table->date('aprovalmgrdate')->nullable(); /* تاريخ الموافقة */
            $table->unsignedBigInteger('empmgr')->nullable(); /* المدير */

            $table->unsignedBigInteger('statusid')->default(1); /* حالة الطلب */

            $table->unsignedBigInteger('signemp')->nullable(); /* توقيع الموظف */
            $table->date('signempdate')->nullable(); /* تاريخ التوقيع */
            $table->unsignedBigInteger('emp')->nullable(); /* الموظف */

            $table->bigInteger('userEntry')->unsigned();
            $table->softDeletes();
            $table->timestamps();



            $table->foreign('statusid')->references('id')->on('boxordersts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('orderTyp')->references('id')->on('boxorderstypes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empno')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('installmentPeriod')->references('id')->on('Installmentperiods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sponsor')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empacc')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empmgr')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emp')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aprovalacc')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aprovalmgr')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('signemp')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aprovalsponsor')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('boxorders');
    }
};
