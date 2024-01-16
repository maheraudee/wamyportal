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
        Schema::create('boxordersanalyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boxorders_id'); /* رقم الطلب الطلب  */
            $table->unsignedBigInteger('empno'); /* صاحب الطلب */
            $table->decimal('purchasingValue');  /* القيمة الشرائية */
            $table->decimal('empsalary');  /* الراتب */
            $table->decimal('empremiumBox'); /* قسط إشراك الصندوق */
            $table->decimal('empendService')->nullable();   /* نهاية الخدمة للموظف */
            $table->decimal('empbalancebox')->nullable();   /* رصيد الصندوق للموظف */
            $table->decimal('emptotalGuarantees')->nullable();  /* إجمالي الضمانات */
            $table->decimal('empdebtFurniture')->nullable(); /* مديونية الأثاث */
            $table->decimal('empdebtCar')->nullable();      /* مديونية السيارات */
            $table->decimal('empanothSponosr')->nullable(); /* كفالة موظف آخر */
            $table->decimal('totalCommitmentEmp')->nullable(); /* إجمالي الإلتزامات */
            $table->decimal('guaranteesAvailableEmp')->nullable();  /* الضمانات المتاحة */

            $table->unsignedBigInteger('sprno')->nullable(); /* الكافل */
            $table->decimal('sprsalary')->nullable(); /* راتب الكافل */
            $table->decimal('sprpremiumBox')->nullable(); /* قسط إشتراك الكافل */
            $table->decimal('sprendService')->nullable();   /* نهاية الخدمة للموظف */
            $table->decimal('sprbalancebox')->nullable();   /* رصيد الصندوق للموظف */
            $table->decimal('totalGuaranteesSpr')->nullable();  /* إجمالي الضمانات */
            $table->decimal('sprdebtFurniture')->nullable();    /* مديونية الأثاث */
            $table->decimal('sprdebtCar')->nullable();      /* مديونية السيارات */
            $table->decimal('spranothSponosr')->nullable(); /* كفالة موظف آخر */
            $table->decimal('totalCommitmentSpr')->nullable();  /* إجمالي الإلتزامات */
            $table->decimal('guaranteesAvailableSpr')->nullable();  /* الضمانات المتاحة */

            $table->decimal('totalGuaranteesAll')->nullable();  /* إجمالي جميع الضمانات */
            $table->decimal('totalCommitmentAll')->nullable();  /* إجمالي جميع الإلتزامات */
            $table->decimal('guaranteesAvailableAll')->nullable();  /* جميع الضمانات المتاحة */
            $table->decimal('purchasingValueGurnt')->nullable();    /* مبلغ الضمان المطلوب */

            $table->integer('evaluation')->nullable(); /* تقييم الوضع المالي لمقدم الطلب   */
            $table->text('reson')->nullable(); /* الضمانات التي يمنح عليها  */
            $table->unsignedBigInteger('userEntry');


            /* توقيع العقد */
            $table->decimal('lastPurchasingValue')->nullable(); /* القيمة الشرائية الفعلية */
            $table->decimal('salesPrice')->nullable(); /* سعر البيع للموظف */
            $table->decimal('monthlyInstallment')->nullable(); /* القسط الشهري */
            $table->date('dateFirstInstallment')->nullable(); /* تاريخ القسط الأول */
            $table->date('dateLastInstallment')->nullable(); /* تاريخ القسط الاخير */
            $table->unsignedBigInteger('lastUser')->nullable();  /* الموظف المسؤول من العقد */




            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();


        $table->foreign('boxorders_id')->references('id')->on('Boxorders')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('empno')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('sprno')->references('empno')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('userEntry')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('lastUser')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxordersanalyses');
    }
};
