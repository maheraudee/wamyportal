<?php

namespace Database\Seeders;

use App\Models\Saving\Orders\Withdrawtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithdrawtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('withdrawtypes')->delete();
        Withdrawtype::create(['name'=>'سحب جزء من الرصيد','userEntry' =>1]);
        Withdrawtype::create(['name'=>'كامل الرصيد مع بقاء الإشتراك','userEntry' =>1]);
        Withdrawtype::create(['name'=>'إنسحاب نهائي','userEntry' =>1]);
        
    }
}
