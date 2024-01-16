<?php

namespace Database\Seeders;

use App\Models\Saving\Orders\Boxorderguarantee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxorderguaranteeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxorderguarantees')->delete();
        Boxorderguarantee::create(['name'=>'نهاية خدمة صاحب الطلب','userEntry' =>1]);
        Boxorderguarantee::create(['name'=>'رصيد إشتراك صاحب الطلب','userEntry' =>1]);
        Boxorderguarantee::create(['name'=>'نهاية خدمة الكفيل','userEntry' =>1]);
        Boxorderguarantee::create(['name'=>'رصيد اشتراك الكفيل','userEntry' =>1]);
    }
}
