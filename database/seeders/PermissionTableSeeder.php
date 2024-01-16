<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'mm-inventory','desc' => 'قائمة الجرد - الجرد']);
        Permission::create(['name' => 'sm-custody','desc' => 'العهد - الجرد']);
        Permission::create(['name' => 'sm-basicData','desc' => 'البيانات الأساسية - الجرد']);

        Permission::create(['name' => 'acn-addStore','desc' => 'زر إضافة مستودع - الجرد']);
        Permission::create(['name' => 'acn-editStore','desc' => 'زر تعديل مستودع - الجرد']);
        Permission::create(['name' => 'acn-deltStore','desc' => 'زر حذف مستودع - الجرد']);
        Permission::create(['name' => 'acn-actvStore','desc' => 'زر تغيير حالة المستودع - الجرد']);

        Permission::create(['name' => 'acn-addDevice','desc' => 'زر إضافة جهاز - الجرد']);
        Permission::create(['name' => 'acn-editDevice','desc' => 'زر تعديل جهاز - الجرد']);
        Permission::create(['name' => 'acn-deltDevice','desc' => 'زر حذف جهاز - الجرد']);
        Permission::create(['name' => 'acn-actvDevice','desc' => 'زر تغيير حالة جهاز - الجرد']);

        Permission::create(['name' => 'acn-addCompany','desc' => 'زر إضافة شركة - الجرد']);
        Permission::create(['name' => 'acn-editCompany','desc' => 'زر تعديل شركة - الجرد']);
        Permission::create(['name' => 'acn-deltCompany','desc' => 'زر حذف شركة - الجرد']);
        Permission::create(['name' => 'acn-actvCompany','desc' => 'زر تغيير حالة شركة - الجرد']);

        Permission::create(['name' => 'acn-addCustody','desc' => 'زر إضافة عهدة - الجرد']);
        Permission::create(['name' => 'acn-printCustody','desc' => 'زر طباعة عهدة - الجرد']);

        Permission::create(['name' => 'sm-myCustody','desc' => 'عهدتي - الجرد']);




        Permission::create(['name' => 'mm-box','desc' => 'قائمة صندوق الإدخار ']);
        Permission::create(['name' => 'sm-slate','desc' => 'لائحة الصندوق - الصندوق']);
        Permission::create(['name' => 'sm-subscriptions','desc' => 'قائمة الإشتراكات - الصندوق']);
        Permission::create(['name' => 'sm-newRegistration','desc' => 'تسجيل مشترك جديد في صندوق الإدخار']);
        Permission::create(['name' => 'sm-updRegistration','desc' => 'تحديث مشترك سابق في صندوق الإدخار']);
        Permission::create(['name' => 'sm-membData','desc' => 'بيانات المشتركين في صندوق الإدخار']);
        Permission::create(['name' => 'acn-deltsubscription','desc' => 'زر إلغاء الإشتراك من صندوق الإدخار']);
        Permission::create(['name' => 'sm-shholderData','desc' => 'بيانات المساهمين في صندوق الإدخار']);
        Permission::create(['name' => 'acn-updShholder','desc' => 'زر تعديل مبلغ المساهمة في صندوق الإدخار']);
        Permission::create(['name' => 'sm-contracts','desc' => 'قائمة العقود - صندوق الإدخار']);
        Permission::create(['name' => 'sm-myContract','desc' => 'عقد الإشتراك في الصندوق']);
        Permission::create(['name' => 'sm-contract','desc' => 'عقود المشتركين في الصندوق']);

        Permission::create(['name' => 'sm-orders','desc' => 'طلبات صندوق الإدخار']);
        Permission::create(['name' => 'sm-orderServices','desc' => 'طلب خدمة في صندوق الإدخار']);
        Permission::create(['name' => 'sm-withdraws','desc' => 'طلب سحب/إنسحاب من الصندوق']);
        Permission::create(['name' => 'sm-sponsers','desc' => 'طلبات الكفالة من الصندوق']);
        Permission::create(['name' => 'sm-myorders','desc' => 'طلباتي - صندوق الإدخار']);

        Permission::create(['name' => 'sm-mangtBox','desc' => 'قائمة إدارة صندوق الإدخار']);
        Permission::create(['name' => 'sm-analysMenu','desc' => 'قائمة التحليل المالي']);
        Permission::create(['name' => 'sm-analysorder','desc' => 'الخدمات - التحليل المالي']);
        Permission::create(['name' => 'sm-analyswithdraws','desc' => 'سحب رصيد - التحليل المالي']);
        Permission::create(['name' => 'acn-analyService','desc' => 'زر التحليل المالي لخدمات صندوق الإدخار']);
        Permission::create(['name' => 'acn-comitService','desc' => 'زر إعتماد اللجنة لخدمات صندوق الإدخار']);
        Permission::create(['name' => 'acn-mangService','desc' => 'زر إعتماد المدير لخدمات صندوق الإدخار']);
        Permission::create(['name' => 'acn-accntService','desc' => 'زر إعتماد المحاسب لخدمات صندوق الإدخار']);
        Permission::create(['name' => 'acn-printcontract','desc' => 'طباعة عقد خدمات - صندوق الإدخار']);
        /*

        Permission::create(['name' => 'acn-analyWithdraws','desc' => 'زر التحليل المالي لسحوبات صندوق الإدخار']);
        Permission::create(['name' => 'acn-mangWithdraws','desc' => 'زر إعتماد الإدارة لسحوبات صندوق الإدخار']); */
        Permission::create(['name' => 'sm-mangtAppBox','desc' => 'اللجنة صندوق الإدخار']);
        Permission::create(['name' => 'sm-signContract','desc' => 'قائمة توقيع العقد صندوق الإدخار']);

        Permission::create(['name' => 'sm-blances','desc' => 'قائمة أرصدة صندوق الإدخار']);
        Permission::create(['name' => 'sm-opblances','desc' => 'قائمة الأرصدة الافتتاحية صندوق الإدخار']);
        Permission::create(['name' => 'acn-showopblances','desc' => 'الإطلاع علي أرصدة المشتركين - صندوق الإدخار']);
        Permission::create(['name' => 'acn-editopblances','desc' => 'التعديل علي أرصدة المشتركين - صندوق الإدخار']);

        Permission::create(['name' => 'acn-premium','desc' => 'زر إضافة قسط للرصيد صندوق الإدخار']);
        Permission::create(['name' => 'acn-allPremium','desc' => 'زر إضافة قسط لرصيد الكل صندوق الإدخار']);



        Permission::create(['name' => 'mm-setting','desc' => 'قائمة الإعدادات']);
        Permission::create(['name' => 'sm-tranData','desc' => 'قائمة نقل البيانات']);
        Permission::create(['name' => 'sm-permissions','desc' => 'قائمة الصلاحيات']);








        /* DB::table('permissions')->insert([
            'name' => 'mm-inventory',
            'desc' => 'قائمة الجرد'
        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-box',
            'desc' => 'قائمة صندوق الإدخار'
        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-setting',
            'desc' => 'قائمة الإعدادات'
        ]); */
    }
}
