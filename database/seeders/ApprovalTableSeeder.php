<?php

namespace Database\Seeders;

use App\Models\Approval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('approvals')->delete();
        Approval::create(['name'=>'رفض','userEntry' =>1]);
        Approval::create(['name'=>'قبول','userEntry' =>1]);
    }
}
