<?php

namespace Database\Seeders;

use App\Models\Saving\Orders\Boxordersts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxorderstsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxordersts')->delete();

        Boxordersts::create(['name'=>'جديد','userEntry' =>1]);
        Boxordersts::create(['name'=>'موافقة الكافل','userEntry' =>1]);
        Boxordersts::create(['name'=>'رفض الكافل','userEntry' =>1]);
        Boxordersts::create(['name'=>'معتمد مالياً','userEntry' =>1]);
        Boxordersts::create(['name'=>'رفض الطلب مالياً','userEntry' =>1]);
        /* Boxordersts::create(['name'=>'اللجنة','userEntry' =>1]); */
        Boxordersts::create(['name'=>'الموظف','userEntry' =>1]);
        Boxordersts::create(['name'=>'المحاسب','userEntry' =>1]);
        Boxordersts::create(['name'=>'لرئيس','userEntry' =>1]);
        Boxordersts::create(['name'=>'طباعة العقد','userEntry' =>1]);
        Boxordersts::create(['name'=>'رفض الطلب','userEntry' =>1]);
        Boxordersts::create(['name'=>'ملغي','userEntry' =>1]);
        /* Boxordersts::create(['name'=>'معتمد','userEntry' =>1]); */
    }
}
