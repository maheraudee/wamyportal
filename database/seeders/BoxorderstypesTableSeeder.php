<?php

namespace Database\Seeders;

use App\Models\Saving\Orders\Boxordersts;
use App\Models\Saving\Orders\Boxorderstypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxorderstypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxorderstypes')->delete();
        Boxorderstypes::create(['name'=>'أجهزة وأثاث منزلي','userEntry' =>1]);
        Boxorderstypes::create(['name'=>'سيارة','userEntry' =>1]);
    }
}
