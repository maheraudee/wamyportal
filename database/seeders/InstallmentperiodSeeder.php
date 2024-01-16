<?php

namespace Database\Seeders;

use App\Models\Saving\Installmentperiod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallmentperiodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('installmentperiods')->delete();
        Installmentperiod::create(['name'=>'سنة','userEntry' =>1]);
        Installmentperiod::create(['name'=>'سنتان','userEntry' =>1]);
        Installmentperiod::create(['name'=>'ثلاث سنوات','userEntry' =>1]);
        Installmentperiod::create(['name'=>'أربع سنوات','userEntry' =>1]);
        Installmentperiod::create(['name'=>'خمس سنوات ','userEntry' =>1]);
    }
}
