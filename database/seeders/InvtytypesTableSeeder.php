<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvtytypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invtytypes')->delete();

        DB::insert("INSERT INTO invtytypes (`TypeId`, `TypeNameAr`, `TypeNameEn`, `status`, `userEntry`) VALUES
        (100,'عهدة','Property',1,1),
        (200,'جديد','New',1,1),
        (300,'مستودع','Store',1,1),
        (400,'متلف','Destructive',1,1),
        (103,'صيانة','Maintenance',1,1),
        (600,'إعارة','Loan',1,1),
        (101,'نقل عهدة','Transfer custody',1,1)");
    }
}
